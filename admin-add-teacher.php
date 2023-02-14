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


/* input data to the database */
if (isset($_POST['add-teacher'])) {
	$t_name=$_POST['name'];

	$t_description=$_POST['description'];

	/* for image (file) */
	$file=$_FILES['image']['name'];

	$dst="./images/".$file;

	$dst_db="images/".$file;

	move_uploaded_file($_FILES['image']['tmp_name'],$dst); 

	$sql="INSERT INTO teacher (name,description,image) VALUES ('$t_name','$t_description','$dst_db')";

	$result=mysqli_query($data,$sql);

	if ($result) {
		header('location:admin-add-teacher.php');
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
		.div-deg {
			background-color: skyblue;
			padding-top: 70px;
			padding-bottom: 70px;
			width: 500px;
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
		<h1>Add Teacher</h1>

		<br><br>

		<div class="div-deg">
			<form action="#" method="POST" enctype="multipart/form-data">
				<div>
					<label>Teacher Name :</label>
					<input type="text" name="name">
				</div>

				<br>

				<div>
					<label>Description :</label>
					<textarea name="description"></textarea>
				</div>

				<br>

				<div>
					<label>Image :</label>
					<input type="file" name="image">
				</div>

				<br>

				<div>
					<input class="btn btn-primary" type="submit" name="add-teacher" value="Add Teacher">
				</div>
			</form>
		</div>
		</center>
	</div>
</body>
</html>