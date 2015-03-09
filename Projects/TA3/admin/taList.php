<?php
require '../utils/functions.php';
require '../utils/db.php';
session_start();
verifyRole('admin');
?>
<!DOCTYPE html>
<html>
<head>
	<title>TA Overview</title>
	<link rel="stylesheet" href="../css/app.css">
	<link rel="stylesheet" href="../css/administrator.css">
	<script src="../js/app.js"></script>
	<meta name="description" content="Page for admins to see TAs and their evaluations">
	<meta name="author" content="Ethan Hayes">
	<meta charset="UTF-8">
	<meta name="keywords" content="University, Utah, TA, Teaching, Assistant, Application">
</head>
<body>
	<?php require '../navmenu/adminNavMenu.php';?>

	<section class="content">
		<div class="description">
			<h1>TA Overview</h1>
			<p class="summary">
				On this page an administrator can see a list of all the TAs and their evaluations
			</p>
		</div>
		<div>
		<ul>
			<li>
				<h3>TA Name</h3>
				<a href="#">Evaluate</a>
			</li>
			<li>
				<h3>TA Name</h3>
				<a href="#">Evaluate</a>
			</li>
		</ul>
	</div>
	</section>
</body>
</html>