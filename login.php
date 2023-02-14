<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
	<link rel="stylesheet" type="text/css" href="style.css">
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	<!-- Optional theme -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
	<!-- Latest compiled and minified JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
</head>
<body background="images/school2.jpg" class="body-deg">
	<center> 
		<div class="form-deg">
			<center class="title-deg">
				Login Form

				<h4>
					<!-- will showing loginMessage if user input the wrong password or username -->
					<?php
					error_reporting(0);
					session_start();
					session_destroy();
					echo $_SESSION['loginMessage'];
					?>
				</h4>
			</center>
			<form action="login-check.php" method="POST" class="login-form">
				<div>
					<label class="label-deg">Username</label>
					<input type="text" name="username">
				</div>
				<div>
					<label class="label-deg">Password</label>
					<input type="text" name="password">
				</div>
				<div>
					<input class="btn btn-primary" type="submit" name="submit" value="login">  
				</div>
			</form>
		</div>
	</center>
</body>
</html>