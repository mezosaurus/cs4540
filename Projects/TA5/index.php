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
	$email = "";
	$passord = "";

	session_start();
	verifyAuthenticated();

	// Make sure the register login button has been clicked
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		// Validate email
		if (empty($_POST['email'])) {
			$emailError = 'Email is required.';
		}
		else {
			$email = validateInput($_POST['email']);
			// Make sure email follows valid format
			if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
				$emailError = "Please enter a valid email.";
			}
		}
		// Validate password
		if (empty($_POST['password'])) {
			$pwError = 'Password is required.';
		}
		else {
			$password = validateInput($_POST['password']);
		}

		// After validation, ensure the error messages are blank so we know it's good to try login
		if (empty($emailError) && empty($pwError)) {
			$message = verifyLogin($email, $password);
			if ($message == "success") {
				header("Location: hub.php");
				exit();
			}
		}
	}
?>


<!DOCTYPE html>
<html>
<head>
	<title>Teaching Assistant Hub</title>
	<link rel="stylesheet" href="css/app.css">
	<link rel="stylesheet" href="css/form.css">
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
		      <p>
				Use these logins for testing:
				<br/>
				admin@test.com - testpass1
				<br/>
				applicant@test.com - testpass1
				<br/>
				instructor@test.com - testpass1
		      </p>
		      <h3 style="color: rgb(200, 0, 0)"><?php echo $message ?></h3>
		      <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" name="loginForm">
		        <p>
		        	<span style="color:red"><?php echo $emailError?></span>
		        	<br/>
		        	<input type="email" name="email" value="<?php echoValue('email')?>" placeholder="Email" required>
		        </p>
		        <p>
		        	<span style="color:red"><?php echo $pwError?></span>
		        	<br/>
		        	<input type="password" name="password" placeholder="Password" required>
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