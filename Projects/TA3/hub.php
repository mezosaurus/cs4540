<?php
	require 'utils/functions.php';
	require 'utils/db.php';

	session_start();
	verifyAuthenticated();
?>
<!DOCTYPE html>
<html>
<head>
	<title>Teaching Assistant Hub</title>
	<link rel="stylesheet" href="css/app.css">
	<script src="js/app.js"></script>
	<meta name="description" content="A Teaching Assistant resource for students and instructors">
	<meta name="author" content="Ethan Hayes">
	<meta charset="UTF-8">
	<meta name="keywords" content="University, Utah, TA, Teaching, Assistant, Application">
</head>
<body>
	<?php
		$roles = $_SESSION['roles'];
		if (in_array('admin', $roles)) {
			require 'navmenu/adminNavMenu.php';
		}
		else if (in_array('instructor', $roles)) {
			require 'navmenu/instructorNavMenu.php';
		}
		else if (in_array('applicant', $roles)) {
			require 'navmenu/applicantNavMenu.php';
		}
	?>

	<section class="content">
		<div class="description">
			<h1>Welcome, <?php echo $_SESSION['name']?></h1>
			<p class="summary">
				Please use the navigation menu to find your way around the site.
			</p>
		</div>
	</section>

</body>
</html>