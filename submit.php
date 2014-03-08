<?php 
	include 'php/functions.php';
	global $connection;
	
	if(isUserLoggedIn() != 1)
	{
		header("Location:login.php");
	}
	if(isset($_POST['submit']))
	{
		if(!$_POST['title'] | !$_POST['description'] | !$_POST['genre'] | !$_POST['imdblink'] | !$_POST['rating'])
		{
			die('You did not fill in a required field.');
		}
		if(connectToFilmsForJoyDB() == 1)
		{
			$userId = getUserId();
			mysql_query("INSERT INTO film_information 
			(film_title, film_description, film_genre, film_IMDB_link, film_contributer_user_Id, film_contributer_rating)
			values
			('".$_POST['title']."', '".$_POST['description']."', ".$_POST['genre'].", '".$_POST['imdblink']."', $userId, ".$_POST['rating'].")");
			disconnectFromFilmsForJoyDB();
			header("Location:index.php");
		}
	}
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="description" content="">
		<meta name="keywords" content="">
		<link type="text/css" rel="stylesheet" href="styles/style.css">
		<title>Films For Joy - Submit</title>
	</head>
	<body>
	<center>
		<img src="images/FilmsForJoyHeader2.jpg" alt="">
		<div id="maindiv">
			<form action="<?php echo $_SERVER['PHP_SELF']?>" method="post">
				<table border="0" align="left">
					<tr align="left"><td colspan=2><h1>Submit Film</h1></td></tr>
					<tr align="left"><td>Title:</td><td>
					<input type="text" name="title" maxlength="80">
					</td></tr>
					<tr align="left"><td>Description:</td><td>
					<input type="text" name="description" maxlength="500" size="100">
					</td></tr>
					<tr align="left">
						<td>Genre:</td>
						<td><select name="genre">
							<option value=1>Horror</option>
							<option value=2>Fantasy</option>
							<option value=3>Action</option>
							<option value=4>Comedy</option>
							<option value=5>Drama</option>
							<option value=6>SciFi</option>
							<option value=7>Other</option>
						</select></td>
					</tr>
					<!--<tr>
						<td>Picture:</td>
						<td><input type="text" name="picture" maxlength="50"></td>
					</tr>-->
					<tr align="left">
						<td>IMDB Link:</td>
						<td><input type="text" name="imdblink" maxlength="100"></td>
					</tr>
					<tr align="left">
						<td>Rating:</td>
						<td><select name="rating">
							<option value=1>It's OK</option>
							<option value=2>Quite Good</option>
							<option value=3>Really Good</option>
							<option value=4>Excellent</option>
							<option value=5>Watch This Now</option>
						</select></td>
					</tr>
					<tr align="left"><td colspan="2">
					<input type="submit" name="submit" value="Submit">
					</td></tr>
				</table>
			</form>
		</div>
		<center>
	</body>
</html>