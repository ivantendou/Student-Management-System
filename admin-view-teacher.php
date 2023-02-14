<?php 

/* start the session */
error_reporting(0);
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

$sql="SELECT * FROM teacher";

$result=mysqli_query($data, $sql);

if ($_GET['teacher-id']) {
	$t_id=$_GET['teacher-id'];

	$sql2="DELETE FROM teacher WHERE id='$t_id' ";

	$result2=mysqli_query($data, $sql2);

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
		.table-th {
			padding: 20px;
			font-size: 20px;
		}
		.table-td {
			padding: 20px;
			background-color: skyblue;
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
		<h1>View All Teacher</h1>

		<table border="1px">
			<tr>
				<th class="table-th">Teacher Name</th>
				<th class="table-th">About Teacher</th>
				<th class="table-th">Image</th>
				<th class="table-th">Delete</th>
				<th class="table-th">Update</th>
			</tr>

			<?php  
			while ($info=$result->fetch_assoc()) {
			?>

			<tr>
				<td class="table-td"><?php echo "{$info['name']}" ?></td>
				<td class="table-td"><?php echo "{$info['description']}" ?></td>
				<td class="table-td"><img height="100px" width="100px" src="<?php echo "{$info['image']}" ?>"></td>
				<td class="table-td">

					<?php 

					echo "
					<a onClick=\"javascript:return confirm('Are you sure to delete this?');\" class='btn btn-danger' href='admin-view-teacher.php?teacher-id={$info['id']}'>
						Delete
					</a>";
					?>
				</td>

				<td class="table-td">

					<?php  

					echo "
					<a class='btn btn-primary' href='admin-update-teacher.php?teacher-id={$info['id']}'>Update</a>";
					
					?>
				</td>
			</tr>

			<?php  
			}
			?>
		</table>
		</center>
	</div>
</body>
</html>