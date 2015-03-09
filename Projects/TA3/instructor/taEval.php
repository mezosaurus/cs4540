<?php
require '../utils/functions.php';
require '../utils/db.php';

session_start();
verifyRole('instructor');
?>
<!DOCTYPE html>
<html>
<head>
	<title>TA Evaluation</title>
	<link rel="stylesheet" href="../css/app.css">
	<link rel="stylesheet" href="../css/instructor.css">
	<script src="../js/app.js"></script>
	<meta name="description" content="Page for instructors to evaluate TAs">
	<meta name="author" content="Ethan Hayes">
	<meta charset="UTF-8">
	<meta name="keywords" content="University, Utah, TA, Teaching, Assistant, Application">
</head>
<body>
	<?php require '../navmenu/instructorNavMenu.php';?>

	<section class="content">
		<div class="description">
			<h1>TA Evaluation</h1>
			<p class="summary">
				On this page an instructor can see a list of possible TAs and their evaluations
			</p>
		</div>
	</section>
	<div id="instructorCourseList" class="course-list">
		<ul>
			<li>
				<h2>TA 1</h2>
				<h3>Evaluation:</h3>
				<p>Not a good candidate</p>
			</li>
			<li>
				<h2>TA 2</h2>
				<h3>Evaluation:</h3>
				<p>Good candidate</p>
			</li>
			<li>
				<h2>TA 3</h2>
				<h3>Evaluation:</h3>
				<p>Possible candidate</p>
			</li>
			<li>
				<h2>TA 4</h2>
				<h3>Evaluation:</h3>
				<p>Immediate selection</p>
			</li>
		</ul>
	</div>
</body>
</html>