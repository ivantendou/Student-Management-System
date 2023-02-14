<?php 

/* start the session */
session_start();

/* prevent one user session from access by another user, example admin page will not be accessed by usertype student, vice versa */
if (!isset($_SESSION['username'])) {
	header("location:login.php");
} elseif ($_SESSION['usertype']=='student') {
	header("location:login.php");
}

$host="localhost";
$user="root";
$password="";
$db="schoolproject";

$data=mysqli_connect($host, $user, $password, $db);

/* The isset() function checks whether a variable is set, which means that it has to be declared and is not NULL. */
if (isset($_POST['add-student'])){
	$username=$_POST['name'];
	$user_email=$_POST['email'];
	$user_phone=$_POST['phone'];
	$user_password=$_POST['password'];
	$usertype="student";

	/* check if data already exist in the database */
	$check="SELECT * FROM user WHERE username='$username'";

	$check_user=mysqli_query($data,$check);

	$row_count=mysqli_num_rows($check_user);

	if ($row_count==1) {
		echo "<script type='text/javascript'>
		alert('Username Already Exist. Try Another One');
		</script>";
	} else {

	$sql="INSERT INTO user(username,email,phone,usertype,password) VALUES ('$username','$user_email','$user_phone','$usertype','$user_password')";

	$result=mysqli_query($data,$sql);

	if ($result) {
		echo "<script type='text/javascript'>
		alert('Data Upload Success');
		</script>";
	} else {
		echo "Upload Failed";
	}
}
}

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Admin Dashboard</title>

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
			 width: 400px;
			 padding-top: 70px;
			 padding-bottom: 70px;
		}
	</style>

	<?php 
	// include css for this page
	include 'admin-css.php';
	?>

</head>
<body>

	<?php 
	// include sidebar html for this page
	include 'admin-sidebar.php';
	?>

	<div class="content">
		<center>
		<h1>Add Student</h1>

		<div class="div-deg">
			<form action="#" method="POST">
				<div>
					<label>Username</label>
					<input type="text" name="name">
				</div>
				<div>
					<label>Email</label>
					<input type="email" name="email">
				</div>
				<div>
					<label>Phone</label>
					<input type="number" name="phone">
				</div>
				<div>
					<label>Password</label>
					<input type="text" name="password">
				</div>
				<div>
					<input type="submit" class="btn btn-primary" name="add-student" value="Add Student">
				</div>
			</form>
		</div>
		</center>
	</div>
</body>
</html>