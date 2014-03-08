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
		if(!$_POST['joy_comment'] | !$_POST['joy_rating'])
		{
			die('You did not fill in a required field.');
		}
		if(connectToFilmsForJoyDB() == 1)
		{
			mysql_query("update film_information 
			set film_seen_by_joy=1, 
			film_joy_comment='".$_POST['joy_comment']."',
			film_joy_rating=".$_POST['joy_rating']."
			where film_information_Id=".$_POST['film_information_id']);
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
		<title>Films For Joy - Review</title>
	</head>
	<body>
	<center>
		<img src="images/FilmsForJoyHeader2.jpg" alt="">
		<div id="maindiv">
			<?php
				global $film_information_id;
				if(isset($_GET['film_information_id']) && $_GET['film_information_id'] != "")
				{
					$film_information_id = $_GET['film_information_id'];
					if(connectToFilmsForJoyDB() == 1)
					{
						$sql = "SELECT * FROM film_information where film_information_Id = " . $film_information_id;
						$result = mysql_query($sql, $connection);
						while($row = mysql_fetch_array($result))
						{
							echo "<h1>" . $row['film_title'] . "</h1><br>";   
						}
					}
				}
			?>
			<form action="<?php echo $_SERVER['PHP_SELF']?>" method="post">
				<table border="0" align="left">
					<tr align="left"><td>Joy Comment:</td><td>
					<input type="text" name="joy_comment" maxlength="500" size="100">
					</td></tr>
					<tr align="left"><td>Joy Rating:</td><td>
					<select name="joy_rating">
						<option value=1>Awful</option>
						<option value=2>Acceptable</option>
						<option value=3>Good</option>
						<option value=4>Fab</option>
						<option value=5>Outstanding</option>
					</select></td></tr>
					<tr><td></td><td><input type="hidden" name="film_information_id" value="<?php global $film_information_id; echo $film_information_id ?>"></td></tr>
					<tr align="left"><td colspan="2">
					<input type="submit" name="submit" value="Submit">
					</td></tr>
				</table>
			</form>
		</div>
		</center>
	</body>
</html>