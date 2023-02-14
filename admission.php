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

$sql="SELECT * from admission";

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

</head>
<body>

	<?php 
	// include sidebar html for this page
	include 'admin-sidebar.php';
	?>

	<div class="content">
		<center>
		<h1>Applied for Admission</h1>

		<br><br>

		<table border="1px">
			<tr>
				<th style="padding: 20px; font-size: 15px;">Name</th>
				<th style="padding: 20px; font-size: 15px;">Email</th>
				<th style="padding: 20px; font-size: 15px;">Phone</th>
				<th style="padding: 20px; font-size: 15px;">Message</th>
			</tr>

			<?php 
			while ($info=$result->fetch_assoc()) {
			?>

			<tr>
				<td style="padding: 20px"><?php echo "{$info['name']}"; ?></td>
				<td style="padding: 20px"></td>
				<td style="padding: 20px"></td>
				<td style="padding: 20px"></td>
			</tr>

			<?php 
			}
			?>
		</table>
		</center>
	</div>
</body>
</html>