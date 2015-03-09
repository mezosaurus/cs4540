<?php 

require 'utils/functions.php';
require 'utils/db.php';

// Log out
session_start();
unset($_SESSION['user']);
session_destroy();

?>

<!DOCTYPE html>
<html>
<head>
	<title>Logout</title>
	<link rel="stylesheet" href="css/app.css">
	<script src="js/app.js"></script>
	<meta name="description" content="Page to indicate user has logged out and provide options">
	<meta name="author" content="Ethan Hayes">
	<meta charset="UTF-8">
	<meta name="keywords" content="University, Utah, TA, Teaching, Assistant, Application">
</head>
<body>

	<section class="content">
		<div class="description">
			<h1>You have been logged out</h1>
			<p class="summary">
				<a style="color: white;" href="/Projects/TA5/index.php">Return to main page</a>
			</p>
		</div>
	</section>

</body>
</html>