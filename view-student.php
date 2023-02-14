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

/* connect to the database */
$host="localhost";
$user="root";
$password="";
$db="schoolproject";

$data=mysqli_connect($host, $user, $password, $db);

$sql="SELECT * FROM user WHERE usertype='student' ";

$result=mysqli_query($data, $sql);

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
		<h1>Student Data</h1>

		<?php 
		if($_SESSION['message']) {
			echo $_SESSION['message'];
		}

		unset($_SESSION['message']);
		?>

		<br><br>

		<table border="1px">
			<tr>
				<th class="table-th">Username</th>
				<th class="table-th">Phone</th>
				<th class="table-th">Email</th>
				<th class="table-th">Password</th>
				<th class="table-th">Delete</th>
				<th class="table-th">Update</th>
			</tr>

			<?php
			// loop
			// The fetch_assoc() / mysqli_fetch_assoc() function fetches a result row as an associative array
			// assigned to variable info
			while($info=$result->fetch_assoc()) {
			?>

			<tr>
				<td class="table-td">
					<?php echo "{$info['username']}"; ?>
				</td>
				<td class="table-td">
					<?php echo "{$info['email']}"; ?>
				</td>
				<td class="table-td">
					<?php echo "{$info['phone']}"; ?>
				</td>
				<td class="table-td">
					<?php echo "{$info['password']}"; ?>
				</td>
				<td class="table-td">
					<?php echo "<a onClick=\" javascript:return confirm('Are you sure to delete this data?')\" class='btn btn-danger'href='delete.php?student-id={$info['id']}'>Delete</a>"; ?>
				</td>
				<td class="table-td">
					<?php echo "<a class='btn btn-primary' href='update-student.php?student-id={$info['id']}'>Update</a>"; ?>
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