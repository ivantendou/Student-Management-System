<?php 

/* start the session */
session_start();

/* prevent one user session from access by another user, example admin page will not be accessed by usertype student, vice versa */
if (!isset($_SESSION['username'])) {
	header("location:login.php");
} elseif ($_SESSION['usertype']=='admin') {
	header("location:login.php");
}

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Admin Dashboard</title>

	<?php  
	include 'student-css.php';
	?>

</head>
<body>
	
	<?php 
	include 'student-sidebar.php';
	?>

	<div class="content">
		teks
	</div>
</body>
</html>