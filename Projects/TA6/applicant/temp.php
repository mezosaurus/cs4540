<?php
	/*
	* Author: Ethan Hayes
	* Date: 2015
	*/

	require '../models/user.php';
	require '../models/course.php';
	require '../models/application.php';
	require '../utils/db.php';
	require '../utils/functions.php';
	session_start();
	verifyRole('applicant');
	$application = 
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Application Display</title>
		<link rel="stylesheet" href="../css/app.css">
		<link rel="stylesheet" href="../css/formResult.css">
		<meta name="description" content="Page to display application">
		<meta name="author" content="Ethan Hayes">
		<meta charset="UTF-8">
		<meta name="keywords" content="University, Utah, TA, Teaching, Assistant, Application">
	</head>
	<body>
		<?php include('../navmenu/applicantNavMenu.php'); ?>
		<section class="content">
		
		</section>
	</body>
</html>