<html>
	<head>
		<title>TA Hub README</title>
		<link rel="stylesheet" href="css/app.css">
		<script src="js/app.js"></script>
		<meta name="description" content="A Teaching Assistant resource for students and instructors">
		<meta name="author" content="Ethan Hayes">
		<meta charset="UTF-8">
		<meta name="keywords" content="University, Utah, TA, Teaching, Assistant, Application">
	</head>
	<body>
		<?php include("navmenu.html");?>
		<section class="content">
			<div class="description">
				<h1> README TA5 - Input validation on Front End and Back End </h1>
				<p class="summary">
					For TA5 I have added input validation on the front end and back end for every form. This includes Login, Registration, and the Application.
					<br/><br/>
					For the front end validation I have used the 'required' tag for each form input so that the browser ensures content is in the required field.
					<br/>
					Additionally, I have used the 'pattern' tag to establish regex for certain fields so that only certain inputs are allowed. I have added Javascript event listeners to change
					the validation message appropriately so they can fix their errors. These event listeners can be found in 'js/registration.js' and 'js/app.js'.
					<br/><br/>
					For the back end validation I have used a function in 'utils/functions.php' called validateInput() that uses a few PHP functions to clean the input.
					<br/>
					First, validateInput() will trim the input to remove any extra spaces.
					<br/>
					Second, validateInput() will use stripslashes() to unquote a quoted string.
					<br/>
					Third, validateInput() will use htmlspecialchars() which will convert any special chars found in the input to HTML entities.
					<br/>
					Additional validation on the back end makes use of Regex patterns to make sure certain inputs follow a particular pattern.
					<br/><br/><br/>
					My main area of focus for TA5 was fixing most of my application form, and overhauling the back end php for inserting the information.
				</p>
			</div>
		</section>
	</body>
</html>