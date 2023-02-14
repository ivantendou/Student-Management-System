<?php 

/* start the session */
session_start();

/* prevent one user session from access by another user, example admin page will not be accessed by usertype student, vice versa */
if (!isset($_SESSION['username'])) {
	header("location:login.php");
} elseif ($_SESSION['usertype']=='admin') {
	header("location:login.php");
}

/* connect to the database */
$host="localhost";
$user="root";
$password="";
$db="schoolproject";

$data=mysqli_connect($host, $user, $password,$db);

$name=$_SESSION['username'];

$sql="SELECT * FROM user WHERE username='$name' ";

$result=mysqli_query($data, $sql);

/* fetch the data */
$info=mysqli_fetch_assoc($result);

/* update the data */
if (isset($_POST['update-profile'])) {
	$email=$_POST['email'];
	$phone=$_POST['phone'];
	$password=$_POST['password'];

	$sql2="UPDATE user SET email='$email', phone='$phone', password='$password' WHERE username='$name' ";

	$result2=mysqli_query($data, $sql2);

	if ($result2) {
		header('location:student-profile.php');
	}
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

	<style type="text/css">
		label {
			display: inline-block;
			text-align: right;
			width: 100px;
			padding-top: 10px;
			padding-bottom: 10px;
		}
		.div-deg {
			background-color: skyblue;
			width: 500px;
			padding-top: 70px;
			padding-bottom: 70px;
		}
	</style>

</head>
<body>
	
	<?php 
	include 'student-sidebar.php';
	?>

	<div class="content">
		<center>
			<h1>Update Profile</h1>

			<br><br>
		<form action="#" method="POST">
			<div class="div-deg">
			<div>
				<label>Email</label>
				<input type="email" name="email" value="<?php echo "{$info['email']}" ?>">
			</div>
			<div>
				<label>Phone</label>
				<input type="number" name="phone" value="<?php echo "{$info['phone']}" ?>">
			</div>
			<div>
				<label>Password</label>
				<input type="text" name="password" value="<?php echo "{$info['password']}" ?>">
			</div>
			<div>
				<input class="btn btn-primary" type="submit" name="update-profile" value="Update">
			</div>
			</div>
		</form>
		</center>
	</div>
</body>
</html>