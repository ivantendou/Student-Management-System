<?php 

session_start();

$host="localhost";
$user="root";
$password="";
$db="schoolproject";

$data=mysqli_connect($host, $user, $password, $db);

if ($_GET['student-id']) {
	$user_id=$_GET['student-id'];

	$sql="DELETE FROM user WHERE id='$user_id' ";

	$result=mysqli_query($data,$sql);

	if($result) {
		$_SESSION['message']='Delete Student is Successful';
		header("location:view-student.php");
	}
}

?>