<?php 
	include 'php/functions.php';
	global $connection;
	global $film_information_id;
	
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
			mysql_query("UPDATE film_information 
			SET film_title = '".$_POST['title']."', 
			film_description = '".$_POST['description']."', 
			film_genre = ".$_POST['genre'].", 
			film_IMDB_link = '".$_POST['imdblink']."', 
			film_contributer_rating = ".$_POST['rating']."
			where film_information_Id = ".$_POST['film_information_id']);
			disconnectFromFilmsForJoyDB();
			header("Location:film_details.php?film_information_id=".$_POST['film_information_id']);
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
			<?php
				global $film_information_id;
				global $film_title;
				global $film_description;
				global $film_genre;
				global $film_imdblink;
				global $film_rating;
				if(isset($_GET['film_information_id']) && $_GET['film_information_id'] != "")
				{
					$film_information_id = $_GET['film_information_id'];
					if(connectToFilmsForJoyDB() == 1)
					{
						$sql = "SELECT * FROM film_information where film_information_Id = " . $film_information_id;
						$result = mysql_query($sql, $connection);
						while($row = mysql_fetch_array($result))
						{
							$film_title = $row['film_title'];
							$film_description = $row['film_description'];
							$film_genre = $row['film_genre'];
							$film_imdblink = $row['film_IMDB_link'];
							$film_rating = $row['film_contributer_rating'];
						}
					}
				}
			?>
			<form action="<?php echo $_SERVER['PHP_SELF']?>" method="post">
				<table border="0" align="left">
					<tr align="left"><td colspan=2><h1>Edit Film Details</h1></td></tr>
					<tr align="left"><td>Title:</td><td>
					<input type="text" name="title" maxlength="80" value="<?php global $film_title; echo $film_title ?>">
					</td></tr>
					<tr align="left"><td>Description:</td><td>
					<input type="text" name="description" maxlength="500" size="100" value="<?php global $film_description; echo $film_description ?>">
					</td></tr>
					<tr align="left">
						<td>Genre:</td>
						<td><select name="genre">
							<option value=1 <?php global $film_genre; if($film_genre == 1){echo "selected=\"selected\"";} ?>>Horror</option>
							<option value=2 <?php global $film_genre; if($film_genre == 2){echo "selected=\"selected\"";} ?>>Fantasy</option>
							<option value=3 <?php global $film_genre; if($film_genre == 3){echo "selected=\"selected\"";} ?>>Action</option>
							<option value=4 <?php global $film_genre; if($film_genre == 4){echo "selected=\"selected\"";} ?>>Comedy</option>
							<option value=5 <?php global $film_genre; if($film_genre == 5){echo "selected=\"selected\"";} ?>>Drama</option>
							<option value=6 <?php global $film_genre; if($film_genre == 6){echo "selected=\"selected\"";} ?>>SciFi</option>
							<option value=7 <?php global $film_genre; if($film_genre == 7){echo "selected=\"selected\"";} ?>>Other</option>
						</select></td>
					</tr>
					<tr align="left">
						<td>IMDB Link:</td>
						<td><input type="text" name="imdblink" maxlength="100" value="<?php global $film_imdblink; echo $film_imdblink ?>"></td>
					</tr>
					<tr align="left">
						<td>Rating:</td>
						<td><select name="rating" value="<?php global $film_rating; echo $film_rating ?>">
							<option value=1 <?php global $film_rating; if($film_rating == 1){echo "selected=\"selected\"";} ?>>It's OK</option>
							<option value=2 <?php global $film_rating; if($film_rating == 2){echo "selected=\"selected\"";} ?>>Quite Good</option>
							<option value=3 <?php global $film_rating; if($film_rating == 3){echo "selected=\"selected\"";} ?>>Really Good</option>
							<option value=4 <?php global $film_rating; if($film_rating == 4){echo "selected=\"selected\"";} ?>>Excellent</option>
							<option value=5 <?php global $film_rating; if($film_rating == 5){echo "selected=\"selected\"";} ?>>Watch This Now</option>
						</select></td>
					</tr>
					<tr>
						<td>
							<input type="hidden" name="film_information_id" value="<?php global $film_information_id; echo $film_information_id ?>">
						</td>
					</tr>
					<tr align="left"><td colspan="2">
					<input type="submit" name="submit" value="Submit">
					</td></tr>
				</table>
			</form>
		</div>
		</center>
	</body>
</html>