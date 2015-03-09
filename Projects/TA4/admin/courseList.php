<?php
	require '../models/user.php';
	require '../models/course.php';
	require '../models/application.php';
	require '../utils/db.php';
	require '../utils/functions.php';
	session_start();
	verifyRole('admin');
	$courses = getCourses();
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
	<div id="courseList" class="course-list" >
		<ul>
			<?php 
				foreach ($courses as $course) {
					echo "<li>";
					echo $course;
					echo "</li>";
				}
			?>
		</ul>
	</div>
</body>
</html>