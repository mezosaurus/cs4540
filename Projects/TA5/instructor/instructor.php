<?php
require '../utils/functions.php';
require '../utils/db.php';

session_start();
verifyRole('instructor');
?>
<!DOCTYPE html>
<html>
<head>
	<title>Instructor Home</title>
	<link rel="stylesheet" href="../css/app.css">
	<link rel="stylesheet" href="../css/instructor.css">
	<script src="../js/app.js"></script>
	<meta name="description" content="Page for instructors to view courses and course info">
	<meta name="author" content="Ethan Hayes">
	<meta charset="UTF-8">
	<meta name="keywords" content="University, Utah, TA, Teaching, Assistant, Application">
</head>
<body>
	<?php require '../navmenu/instructorNavMenu.php';?>

	<section class="content">
		<div class="description">
			<h1>Instructor Home</h1>
			<p class="summary">
				On this page an instructor can see an overview of all the courses they are teaching.
			</p>
		</div>
	</section>
	<div id="instructorCourseList" class="course-list">
		<ul>
			<li>
				<h2>Course 1</h2>
			</li>
			<li>
				<h2>Course 	2</h2>
			</li>
			<li>
				<h2>Course 3</h2>
			</li>
			<li>
				<h2>Course 4</h2>
			</li>
		</ul>
	</div>
</body>
</html>