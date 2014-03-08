<?php
	include 'php/functions.php';
	global $connection;
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="generator" content="CoffeeCup HTML Editor (www.coffeecup.com)">
    <meta name="created" content="Tue, 05 Apr 2011 14:09:13 GMT">
    <meta name="description" content="">
    <meta name="keywords" content="">
	
    <link type="text/css" rel="stylesheet" href="styles/style.css">
    <title>Films For Joy - Film Details</title>
  </head>
  <body>
  <center>
    <img src="images/FilmsForJoyHeader2.jpg" alt="">
	<div id="menudiv">
		<a href=film_list.php>Main Page</a>
		<?php
			if(isUserLoggedIn() == 1)
			{
				if(isset($_GET['film_information_id']) && $_GET['film_information_id'] != "")
				{
					$film_information_id = $_GET['film_information_id'];
					$user_id = GetUserId();
					$contributer_id = -1;
					if(connectToFilmsForJoyDB() == 1)
					{
						$sql = "SELECT film_contributer_user_Id FROM film_information where film_information_Id = " . $film_information_id;
						$result = mysql_query($sql, $connection);
						while($row = mysql_fetch_array($result))
						{
							$contributer_id = $row['film_contributer_user_Id'];
						}
					}
					if($user_id == $contributer_id)
					{
						echo "  ||  ";
						echo "<a href=edit_film_details.php?film_information_id=".$film_information_id.">Edit Details</a>";
					}
				}
			}
		?>
	</div>
	<div id="maindiv">
	  <?php 
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
				echo $row['film_description'] . "<br><br>";
				switch($row['film_genre'])
				{
				  case 1:
					echo "Genre - Horror";
					break;
				  case 2:
					echo "Genre - Fantasy";
					break;
				  case 3:
					echo "Genre - Action";
					break;
				  case 4:
					echo "Genre - Comedy";
					break;
				  case 5:
					echo "Genre - Drama";
					break;
				case 6:
					echo "Genre - SciFi";
					break;
				case 7:
					echo "Genre - Other";
					break;
				}
				echo "<br><br>";
				echo "<a href=" . $row['film_IMDB_link'] . ">IMDB Details</a><br><br>";
				echo "Contributer Rating = ";
				switch($row['film_contributer_rating'])
				{
					case 1:
						echo "It's OK";
						break;
					case 2:
						echo "Quite Good";
						break;
					case 3:
						echo "Really Good";
						break;
					case 4:
						echo "Excellent";
						break;
					case 5:
						echo "Watch This Now";
						break;
				}
				echo "<br><br>";
				if(isset($row['film_joy_rating']) && $row['film_joy_rating'] != 0)
				{
					echo "Joy has seen this film<br><br>";
					echo "Joy says... " . $row['film_joy_comment'] . "<br><br>";
					echo "Joy rates this film as ";
					switch($row['film_joy_rating'])
					{
						case 1:
							echo "Awful";
							break;
							case 2:
							echo "Acceptable";
							break;
						case 3:
							echo "Good";
							break;
						case 4:
							echo "Fab";
							break;
						case 5:
							echo "Outstanding";
							break;
					}
					echo "<br><br>";
				}
				else
				{
					echo "Joy has not yet seen this film<br><br>";
					$usertype  = getUserType();
					if($usertype < 3)
					{
						echo "<a href=review.php?film_information_id=".$film_information_id.">Review This Film</a><br><br>";
					}
				}
				$sql2 = "SELECT * FROM user where user_Id = " . $row['film_contributer_user_Id'];
				$result2 = mysql_query($sql2, $connection);
				while($row2 = mysql_fetch_array($result2))
				{
				  echo "Film added by " . $row2['user_name'] . "<br><br>";
				}
			  }
			  disconnectFromFilmsForJoyDB();
		  }
		}
		else
		{
		  echo "No film id specified";
		}
	  ?>
	</div>
    <br>
    <br>
    <br>
	</center>
  </body>
</html>