<?php 

/* error_reporting(0) -> remove error message from page*/
error_reporting(0);

/* session_start() -> with session_start() function the web server know who you are, by default session will ended if the user closes the browser. */
session_start();

/* session_destroy() -> this function ends the session that have started before */
session_destroy();


/* the message for success admission input. */
if($_SESSION['message']) {
	$message=$_SESSION['message'];

	echo "<script type='text/javascript'>
	alert('$message');
	</script>"; 
}

/* connect to the database */
$host="localhost";
$user="root";
$password="";
$db="schoolproject";

$data=mysqli_connect($host, $user, $password, $db);

$sql="SELECT * FROM teacher";

$result=mysqli_query($data, $sql);

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Student Management System</title>
	<link rel="stylesheet" type="text/css" href="style.css">
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	<!-- Optional theme -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
	<!-- Latest compiled and minified JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
</head>
<body>
	<nav>
		<label class="logo">Q-School</label>
		<ul>
			<li><a href="">Home</a></li>
			<li><a href="">Contact</a></li>
			<li><a href="">Admission</a></li>
			<li><a href="login.php" class="btn btn-success">Login</a></li>
		</ul>
	</nav>

	<div class="section1">
		<label class="img-text">We Teach Students With Care</label>
		<img class="main-img" src="images/school_management.jpg">
	</div>

	<div class="container">
		<div class="row">
			<div class="col-md-4">
				<img class="welcome-img" src="images/school2.jpg">
			</div>
			<div class="col-md-8">
				<h1>Welcome to Q-School</h1>
				<p>MEMS has been committed to global learning long before it became an indispensable feature of contemporary education. Established in 1997, we proudly stand as the 1st English medium school in Bangladesh to adopt both Pearson Edexcel and Cambridge curriculum (in O and A levels), drawing together students in a vibrant, academically challenging, and encouraging environment where manifold viewpoints are prized and celebrated.MEMS has been committed to global learning long before it became an indispensable feature of contemporary education. Established in 1997, we proudly stand as the 1st English medium school in Bangladesh to adopt both Pearson Edexcel and Cambridge curriculum (in O and A levels), drawing together students in a vibrant, academically challenging, and encouraging environment where manifold viewpoints are prized and celebrated.</p>
			</div>
		</div>
	</div>

	<center>
		<h1 class="title">Our Teacher</h1>
	</center>

	<div class="container">
		<div class="row">

			<?php 
			while ($info=$result->fetch_assoc()) {

			?>

			<div class="col-md-4">
				<img class="teacher" src="<?php echo "{$info['image']}" ?>">
				<h3><?php echo "{$info['name']}" ?></h3>
				<h5><?php echo "{$info['description']}" ?></h5>
			</div>

			<?php  
			}
			?>

		</div>
	</div>

		<center>
		<h1 class="title">Our Course</h1>
	</center>

	<div class="container">
		<div class="row">
			<div class="col-md-4">
				<img class="teacher" src="images/web.jpg">
				<h3>Web Developer</h3>
			</div>
			<div class="col-md-4">
				<img class="teacher" src="images/graphic.jpg">
				<h3>Graphics Design</h3>
			</div>
			<div class="col-md-4">
				<img class="teacher" src="images/marketing.png">
				<h3>Marketing</h3> 
			</div>
		</div>
	</div>

	<center>
		<h1 class="title">Admission Form</h1>
	</center>

	<div align="center" class="admissionForm">
		<form action="data-check.php" method="POST">
			<div class="adm-int">
				<label class="label-text">Name</label>
				<input class="input-deg" type="text" name="name">
			</div>
			<div class="adm-int">
				<label class="label-text">Email</label>
				<input class="input-deg" type="text" name="email">
			</div>
			<div class="adm-int">
				<label class="label-text">Phone</label>
				<input class="input-deg" type="text" name="phone">
			</div>
			<div class="adm-int">
				<label class="label-text">Message</label>
				<textarea class="input-txt" name="message"></textarea>
			</div>
			<div class="adm-int">
				<input class="btn btn-primary"  id="submit" type="submit" value="apply" name="apply">
			</div>
		</form>
	</div>

	<footer>
		<h3 class="footer-text ">All @copyright reserved by ivantendou</h3>
	</footer>
</body>
</html>