<?php 
	include 'php/functions.php';
	global $connection;
	
	if(isUserLoggedIn() != 1)
	{
		header("Location:login.php");
	}
	if(isset($_POST['submit']))
	{
		if(!$_POST['user_name'] | !$_POST['password'])
		{
			die('You did not fill in a required field.');
		}
		if(connectToFilmsForJoyDB() == 1)
		{
			mysql_query("INSERT INTO user (user_name, user_password, user_type) VALUES	('".$_POST['user_name']."', '".$_POST['password']."', 3)");
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
		<title>Films For Joy - Create Account</title>
	</head>
	<body>
	<center>
		<img src="images/FilmsForJoyHeader2.jpg" alt="">
		<div id="maindiv">
			
			<form action="<?php echo $_SERVER['PHP_SELF']?>" method="post">
				<table border="0" align="left">
					<tr align="left">
						<td colspan=2>
							<h1>Create Account</h1>
						</td>
					</tr>
					<tr align="left">
						<td>
							Name:
						</td>
						<td>
							<input type="text" name="user_name" maxlength="80">
						</td>
					</tr>
					<tr align="left">
						<td>Password:</td>
						<td>
							<input type="text" name="password" maxlength="20">
						</td>
					</tr>
					<tr align="left">
						<td colspan="2">
							<input type="submit" name="submit" value="Create">
						</td>
					</tr>
				</table>
			</form>
		</div>
		</center>
	</body>
</html>