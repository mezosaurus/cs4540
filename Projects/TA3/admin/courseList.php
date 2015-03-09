<?php
require '../utils/functions.php';
require '../utils/db.php';
session_start();
verifyRole('admin');
?>
<!DOCTYPE html>
<html>
<head>
	<title>Course Overview</title>
	<link rel="stylesheet" href="../css/app.css">
	<link rel="stylesheet" href="../css/administrator.css">
	<script src="../js/app.js"></script>
	<meta name="description" content="Page for admins to view course list">
	<meta name="author" content="Ethan Hayes">
	<meta charset="UTF-8">
	<meta name="keywords" content="University, Utah, TA, Teaching, Assistant, Application">
</head>
<body>
	<?php require '../navmenu/adminNavMenu.php';?>

	<section class="content">
		<div class="description">
			<h1>Course Overview</h1>
			<p class="summary">
				On this page an administrator can see a list of all the courses
			</p>
		</div>
	</section>
	<div id="courseList" class="course-list-show" >
		<ul>
			<li>
				<h3>CS 2100 - Discrete Structures</h3>
				<ul>
					<li>TAs required: 2</li>
					<li>TAs found: 0</li>
				</ul>
			</li>
			<li>
				<h3>CS 3500 - Software Practice I</h3>
				<ul>
					<li>TAs required: 4</li>
					<li>TAs found: 2</li>
				</ul>
			</li>
		</ul>
	</div>
</body>
</html>