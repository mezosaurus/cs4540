<?php
	ini_set('display_errors',1);
	ini_set('display_startup_errors',1);
	error_reporting(-1);
	require '../models/user.php';
	require '../models/applicant.php';
	require '../utils/db.php';
	require '../utils/functions.php';
	session_start();
	verifyRole('admin');
	$applicants = getApplicants();
?>
<!DOCTYPE html>
<html>
<head>
	<title>Applicant Overview</title>
	<link rel="stylesheet" href="../css/app.css">
	<link rel="stylesheet" href="../css/administrator.css">
	<script src="../js/app.js"></script>
	<meta name="description" content="Page for admins to see a list of applicants">
	<meta name="author" content="Ethan Hayes">
	<meta charset="UTF-8">
	<meta name="keywords" content="University, Utah, TA, Teaching, Assistant, Application">
</head>
<body>
	<?php require '../navmenu/adminNavMenu.php';?>

	<section class="content">
		<div class="description">
			<h1>Applicant Overview</h1>
			<p class="summary">
				This page is for admins to see the list of applicants
			</p>
		</div>
	</section>
	<div>
		<ul>
			<?php 
				foreach ($applicants as $applicant) {
					echo $applicant;
				}
			?>
		</ul>
	</div>
</body>
</html>