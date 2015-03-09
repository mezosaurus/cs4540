 <!DOCTYPE html>
<html>
	<head>
		<title>DB Error</title>
		<link rel="stylesheet" href="css/app.css">
		<script src="js/app.js"></script>
		<meta name="description" content="Error page if there was an error with the database">
		<meta name="author" content="Ethan Hayes">
		<meta charset="UTF-8">
		<meta name="keywords" content="University, Utah, TA, Teaching, Assistant, Application">
	</head>
	<body>
	<section class="content">
		<div class="description">
		      <h2>DB Error</h2>
		      <p>There was an issue when trying to use the database. The detail of the error is as follows:</p>
		      <p><?php echo $exception->getMessage(); ?></p>
		      <p><a style="color:rgb(200, 0, 0);" href="index.php">Go Back</a></p>
		</div>
	</section>
	</body>
</html>