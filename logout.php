<?php
	$past = time() - 100;
	setcookie(ID_films_for_joy, gone, $past);
	setcookie(Key_films_for_joy, gone, $past);
	header("Location:film_list.php");
?>
<html>
  <head>
	<link type="text/css" rel="stylesheet" href="styles/style.css">
    <title>Films For Joy - Logout</title>
  </head>
  <body>
  </body>
</html>