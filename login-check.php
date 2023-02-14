<?php

/* hide error reports */
error_reporting(0);
	
/* connect to the database */
$host="localhost";
$user="root";
$password="";
$db="schoolproject";

$data=mysqli_connect($host, $user, $password,$db);

/* check the connection */
if($data===false) {
	die("Connection error");
}

/* condition for user login */
if ($_SERVER["REQUEST_METHOD"]=="POST") {
	$name = $_POST['username'];
	$pass = $_POST['password'];

	$sql = "select * from user where username = '".$name."' and password='".$pass."' ";
	$result = mysqli_query($data, $sql);
	$row = mysqli_fetch_array($result);

	if($row["usertype"] == "student") {
		session_start();
		$_SESSION['username']=$name;
		$_SESSION['usertype']="student";
		header("location:studenthome.php");
	}
	elseif ($row["usertype"] == "admin") {
		session_start();
		$_SESSION['username']=$name;
		$_SESSION['usertype']="admin";
		header("location:adminhome.php");
	}
	else {
		$message = "username or password do not match";
		$_SESSION['loginMessage'] = $message;
		header("location:login.php");
	}
}

?>