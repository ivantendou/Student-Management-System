<?php 

/* start the session */
session_start();

/* connect to the database */
$host="localhost";
$user="root";
$password="";
$db="schoolproject";

$data=mysqli_connect($host, $user, $password, $db);

/* check the connection */
if ($data===false) {
	die("connection error");
}

/* insert admission data to the database */

/* The isset() function checks whether a variable is set, which means that it has to be declared and is not NULL. */
if (isset($_POST['apply'])) {
	$data_name = $_POST['name'];
	$data_email = $_POST['email'];
	$data_phone = $_POST['phone'];
	$data_message = $_POST['message'];

	$sql="INSERT INTO admission(name, email, phone, message) VALUES ('$data_name','$data_email','$data_phone','$data_message')";

	/* querying the admission data */
	$result=mysqli_query($data, $sql);

	/* return to index.php page and pass the message to index.php */
	if ($result) {
		$_SESSION['message'] = "your application sent successful";
		header("location:index.php");
	} else {
		echo "Apply Failed";
	}
}

?>