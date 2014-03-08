<?php 
	include 'php/functions.php';
	global $connection;
	
	if(isUserLoggedIn() == 1)
	{
		header("Location:film_list.php");
	}
	if(isset($_POST['submit']))
	{
		if(!$_POST['username'] | !$_POST['pass'])
		{
			die('You did not fill in a required field.');
		}
		if(connectToFilmsForJoyDB() == 1)
		{
			$check = mysql_query("SELECT * FROM user WHERE user_name = '".$_POST['username']."'"); //or die(mysql_error());
			$check2 = mysql_num_rows($check);
			if($check2 == 0)
			{
				die('That user does not exist in our database.');
			}
			while($info = mysql_fetch_array($check))
			{
				$_POST['pass'] = stripslashes($_POST['pass']);
				$info['user_password'] = stripslashes($info['user_password']);
				if($_POST['pass'] != $info['user_password'])
				{
					die('Incorrect password, please try again.');
				}
				else
				{
					$_POST['username'] = stripslashes($_POST['username']);
					$hour = time() + 3600;
					setcookie(ID_films_for_joy, $_POST['username'], $hour);
					setcookie(Key_films_for_joy, $_POST['pass'], $hour);
					header("Location:film_list.php");
				}
			}
			disconnectFromFilmsForJoyDB();
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
		<title>Films For Joy - Login</title>
	</head>
	<body>
	<center>
		<img src="images/FilmsForJoyHeader2.jpg" alt="">
		<div id="maindiv">
			<form action="<?php echo $_SERVER['PHP_SELF']?>" method="post">
				<table border="0">
					<tr><td colspan=2><h1>Login</h1></td></tr>
					<tr><td>Username:</td><td>
					<input type="text" name="username" maxlength="40">
					</td></tr>
					<tr><td>Password:</td><td>
					<input type="password" name="pass" maxlength="50">
					</td></tr>
					<tr><td colspan="2" align="right">
					<input type="submit" name="submit" value="Login">
					</td></tr>
				</table>
			</form>
		</div>
		<center>
	</body>
</html>