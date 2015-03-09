<?php
require '../utils/functions.php';
require '../utils/db.php';
session_start();
verifyRole('admin');
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
			<li>
				<h3> Fake Name </h3>
				<p> Status: Review </p>
			</li>
			<li>
				<h3> John Doe </h3>
				<p> Status: Confirmed </p>
			</li>
			<li>
				<h3> Bill Bob </h3>
				<p> Status: Pending </p>
			</li>
		</ul>
	</div>
</body>
</html>