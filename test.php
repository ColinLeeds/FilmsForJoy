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
    <div id="headerdiv">
      <img src="images/FilmsForJoyHeader2.jpg" alt="">
    </div>

	<div id="maindiv">
		<?php
		if(isset($_COOKIE['ID_films_for_joy']))
		{
			echo "<a href=logout.php>Logout</a>";
		}
		?>
	  <h1>Films</h1>
	  <?php 
  	    $con = mysql_connect("localhost", "filmsfor_cbeeby", "Gothic69");
  	    if(!$con)
  	    {
   	      die('Could not connect: ' . mysql_error());
  	    }
  	    mysql_select_db("filmsfor_films_for_joy", $con);
  	    $sql = "SELECT * FROM film_information";
  	    $result = mysql_query($sql, $con);
  	    while($row = mysql_fetch_array($result))
  	    {
          echo "<h2><a href=film_details.php?film_information_id=" . $row['film_information_Id'] . ">" . $row['film_title'] . "</a></h2>";
		  echo "<img src=\"images/FilmSeperater.jpg\"><img src=\"images/FilmSeperater.jpg\"><img src=\"images/FilmSeperater.jpg\">";
  	    }
  	    mysql_close($con);
	  ?>
	</div>
    <br>
    <br>
    <br>
  </body>
</html>