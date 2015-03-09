<?php
	ini_set('display_errors', 1);
	require '../models/user.php';
	require '../models/application.php';
	require '../utils/db.php';
	require '../utils/functions.php';
	session_start();
	verifyRole('applicant');
?>
<!DOCTYPE html>
<html>
<head>
	<title>Applicant Main</title>
	<link rel="stylesheet" href="../css/app.css">
	<script src="../js/app.js"></script>
	<meta name="description" content="Home page for applicants to view status of apps and list of applications">
	<meta name="author" content="Ethan Hayes">
	<meta charset="UTF-8">
	<meta name="keywords" content="University, Utah, TA, Teaching, Assistant, Application">
</head>
<body>
	<?php require '../navmenu/applicantNavMenu.php'; ?>

	<section class="content">
		<div class="description">
			<h1>Applicant Home</h1>
			<p class="summary">
				On this page an applicant can see a list of applications and their respective statuses
			</p>
		</div>
	</section>
</body>
</html>