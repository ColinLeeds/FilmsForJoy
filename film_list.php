<?php
	include 'php/functions.php';
	global $connection;
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="generator" content="CoffeeCup HTML Editor (www.coffeecup.com)">
    <meta name="created" content="Mon, 24 Jan 2011 22:02:22 GMT">
    <meta name="description" content="">
    <meta name="keywords" content="">
	<link type="text/css" rel="stylesheet" href="styles/style.css">
    <title>Films For Joy</title>
  </head>
  <body>
  <center>
    <img src="images/FilmsForJoyHeader2.jpg" alt="">
	<div id="menudiv">
		<?php
		if(isUserLoggedIn() == 1)
		{
			//Need to check that the cookie details are correct here
			echo "<a href=logout.php>Logout</a>";
			$usertype  = getUserType();
			if($usertype < 4)
			{
				echo "  ||  ";
				echo "<a href=submit.php>Submit A Film</a>";
			}
			if($usertype < 3)
			{
				echo "  ||  ";
				echo "<a href=create_account.php>Create An Account</a>";
			}
			if($usertype < 2)
			{
				echo "  ||  ";
				echo "<a href=delete.php>Delete A Film</a>";
			}
		}
		else
		{
			echo "<a href=login.php>Login</a>";
		}
		?>
	</div>
	<div id="maindiv">
	  <h1>Films</h1>
	  <?php 
		if(connectToFilmsForJoyDB() == 1)
		{
			$sql = "SELECT * FROM film_information ORDER BY film_information_timestamp_created DESC";
			$result = mysql_query($sql, $connection);
			while($row = mysql_fetch_array($result))
			{
				echo "<h2><a href=film_details.php?film_information_id=" . $row['film_information_Id'] . ">" . $row['film_title'] . "</a></h2>";
				echo "<img src=\"images/FilmSeperater.jpg\"><img src=\"images/FilmSeperater.jpg\"><img src=\"images/FilmSeperater.jpg\">";
			}
			disconnectFromFilmsForJoyDB();
		}
	  ?>
	</div>
    <br>
    <br>
    <br>
	</center>
  </body>
</html>