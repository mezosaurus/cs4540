<?php
	ini_set('display_errors',1);
	ini_set('display_startup_errors',1);
	error_reporting(-1);
	require 'models/user.php';
	require 'models/course.php';
	require 'models/application.php';
	require 'utils/db.php';
	require 'utils/functions.php';

	// Setup error var
	$message = '';
	$emailError = '';
	$pwError = '';

	session_start();
	verifyAuthenticated();

	// Make sure the register login button has been clicked
	if (count($_POST)) {
		$email = $_POST['email'];
		$password = $_POST['password'];
		if ($email != '' && $password != '') {
			$message = verifyLogin($email, $password);
			if ($message == "success") {
				header("Location: hub.php");
				exit();
			}
		}

		if ($email == '') {
			$emailError = 'Please enter a valid email.';
		}
		if ($password == '') {
			$pwError = 'Please enter a password.';
		}
	}
?>


<!DOCTYPE html>
<html>
<head>
	<title>Teaching Assistant Hub</title>
	<link rel="stylesheet" href="css/app.css">
	<script src="js/app.js"></script>
	<meta name="description" content="A Teaching Assistant resource for students and instructors">
	<meta name="author" content="Ethan Hayes">
	<meta charset="UTF-8">
	<meta name="keywords" content="University, Utah, TA, Teaching, Assistant, Application">
</head>
<body>
	<?php include("navmenu.html");?>

	<section class="content">
		<div class="description">
			<h1>Teaching Assistant Hub</h1>
			<p class="summary">
				This website serves as a hub for students to apply to be Teaching Assistants, and for instructors to select Teaching Assistants for their classes from the pool of applicants.
			</p>
			<br/><br/>
			<div class="login" id="login">
		      <h2>Please Login</h2>
		      <h3 style="color: rgb(200, 0, 0)"><?php echo $message ?></h3>
		      <form method="post" action="">
		        <p>
		        	<span style="color:red"><?php echo $emailError?></span>
		        	<br/>
		        	<input type="email" name="email" placeholder="Email">
		        </p>
		        <p>
		        	<span style="color:red"><?php echo $pwError?></span>
		        	<br/>
		        	<input type="password" name="password" placeholder="Password">
		        </p>
		        <p class="submit"><input type="submit" name="login" value="Login"></p>
		      </form>
		    </div>
		    <div class="register">
		      <p>Don't have an account? <a class="register-a" href="registration.php">Click here to register.</a></p>
		    </div>
		</div>
	</section>

</body>
</html>