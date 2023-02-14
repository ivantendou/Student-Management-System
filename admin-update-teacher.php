<?php 

/* start the session */
session_start();
error_reporting(0);

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

if ($_GET['teacher-id']) {
	$t_id=$_GET['teacher-id'];
	$sql="SELECT * FROM teacher WHERE id='$t_id' ";
	$result=mysqli_query($data,$sql);

	$info=$result->fetch_assoc();
}

/* update input */
if (isset($_POST['update-teacher'])) {
	$id=$_POST['id'];
	$t_name=$_POST['name'];
	$t_desc=$_POST['description'];
	$file=$_FILES['image']['name'];

	$dst="./images/".$file;
	$dst_db="images/".$file;

	move_uploaded_file($_FILES['image']['tmp_name'],$dst);

	if ($file) {
		$sql2="UPDATE teacher SET name='$t_name', description='$t_desc', image='$dst_db' WHERE id='$id' ";
	} else {
		$sql2="UPDATE teacher SET name='$t_name', description='$t_desc' WHERE id='$id' ";
	}

	$result2=mysqli_query($data,$sql2);

	if ($result2) {
		header('location:admin-view-teacher.php');
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
			width: 150px;
			text-align: right;
			padding-top: 10px;
			padding-bottom: 10px;
		}

		.form-deg {
			background-color: skyblue;
			width: 600px;
			padding-top: 70px;
			padding-bottom: 70px;
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
		<h1>Update Teacher Data</h1>

		<form class="form-deg" action="#" method="POST" enctype="multipart/form-data">

			<input type="text" name="id" value="<?php echo "{$info['id']}" ?>" hidden>

			<div>
				<label>Teacher Name</label>
				<input type="text" name="name" value="<?php echo "{$info['name']}" ?>">
			</div>
			<div>
				<label>About Teacher</label>
				<textarea name="description" rows="4">
					<?php echo "{$info['description']}" ?>"
				</textarea>
			</div>
			<div>
				<label>Teacher Old Image</label>
				<img width="100px" height="100px" src="<?php echo "{$info['image']}" ?>">
			</div>
			<div>
				<label> Choose Teacher New Image</label>
				<input type="file" name="image">
			</div>
			<div>
				<input class="btn btn-success" type="submit" name="update-teacher">
			</div>
		</form>
		</center>
	</div>
</body>
</html>