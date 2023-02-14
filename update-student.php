<?php 

/* start the session */
session_start();

/* prevent one user session from access by another user, example admin page will not be accessed by usertype student, vice versa */
if (!isset($_SESSION['username'])) {
	header("location:login.php");
} elseif ($_SESSION['usertype']=='student') {
	header("location:login.php");
} 

/* connect to the database */
$host="localhost";
$user="root";
$password="";
$db="schoolproject";

$data=mysqli_connect($host, $user, $password, $db);

$id=$_GET['student-id'];

$sql="SELECT * FROM user WHERE id='$id' ";

$result=mysqli_query($data, $sql);

$info=$result->fetch_assoc();

/* update the data */
if (isset($_POST['update'])) {
	$name=$_POST['name'];
	$email=$_POST['email'];
	$phone=$_POST['phone'];
	$password=$_POST['password'];

	$query="UPDATE user SET username='$name',email='$email',phone='$phone',password='$password' WHERE id='$id' ";

	$result2=mysqli_query($data, $query);

	if ($result2) {
		header("location:view-student.php");
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
	// include css for this page
	include 'admin-css.php';
	?>

	<style type="text/css">
		label {
			display: inline-block;
			width: 100px;
			text-align: right;
			padding-top: 10px;
			padding-bottom: 10px;
		}

		.div-deg {
			background-color: skyblue;
			width: 400px;
			padding-bottom: 70px;
			padding-top: 70px;
		}
	</style>
</head>
<body>

	<?php 
	// include sidebar html for this page
	include 'admin-sidebar.php';
	?>

	<div class="content">
		<center>
		<h1>Update Student</h1>

		<div class="div-deg">
			<form action="#" method="POST">
				<div>
					<label>Username</label>
					<input type="text" name="name" value="<?php echo "{$info['username']}"; ?>">
				</div>
				<div>
					<label>Email</label>
					<input type="email" name="email" value="<?php echo "{$info['email']}"; ?>">
				</div>
				<div>
					<label>Phone</label>
					<input type="number" name="phone" value="<?php echo "{$info['phone']}"; ?>">
				</div>
				<div>
					<label>Password</label>
					<input type="text" name="password" value="<?php echo "{$info['password']}"; ?>">
				</div>
				<div>
					<input class="btn btn-success" type="submit" name="update" value="Update">
				</div>
			</form>
		</div>
		</center>
	</div>
</body>
</html>