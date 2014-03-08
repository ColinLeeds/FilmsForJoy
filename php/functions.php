<?php
	$connection = 0;
	
	function connectToFilmsForJoyDB()
	{
		global $connection;
		$return = 0;
		$connection = mysql_connect("localhost", "filmsfor_cbeeby", "Gothic69");
		if($connection)
		{
			mysql_select_db("filmsfor_films_for_joy", $connection);
			$return = 1;
		}
		return $return;
	}
	
	function disconnectFromFilmsForJoyDB()
	{
		global $connection;
		mysql_close($connection);
	}
	
	function isUserLoggedIn()
	{
		$return = 0;
		if(isset($_COOKIE['ID_films_for_joy']))
		{
		    if(connectToFilmsForJoyDB() == 1)
			{
				$username = $_COOKIE['ID_films_for_joy'];
				$pass = $_COOKIE['Key_films_for_joy'];
				$check = mysql_query("SELECT * FROM user WHERE user_name = '$username'"); //or die(mysql_error());
				while($info = mysql_fetch_array($check))
				{
					if($pass == $info['user_password'])
					{
						//Password correct
						$return = 1;
					}
				}
				disconnectFromFilmsForJoyDB();
			}
		}
		return $return;
	}
	
	function getUserType()
	{
		$return = 0;
		if(isset($_COOKIE['ID_films_for_joy']))
		{
			if(connectToFilmsForJoyDB() == 1)
			{
				$username = $_COOKIE['ID_films_for_joy'];
				$query = mysql_query("SELECT * FROM user WHERE user_name = '$username'");
				while($info = mysql_fetch_array($query))
				{
					$return = $info['user_type'];
				}
			}
		}
		return $return;
	}
	
	function getUserId()
	{
		$return = 0;
		if(isset($_COOKIE['ID_films_for_joy']))
		{
			if(connectToFilmsForJoyDB() == 1)
			{
				$username = $_COOKIE['ID_films_for_joy'];
				$query = mysql_query("SELECT user_Id FROM user WHERE user_name = '$username'");
				while($info = mysql_fetch_array($query))
				{
					$return = $info['user_Id'];
				}
			}
		}
		return $return;
	}
?>