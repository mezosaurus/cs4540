<?php
	/*
	* Author: Ethan Hayes
	* Date: 2015
	*/

	include 'dbConfig.php';

	try {
		//
		// The main content of the page will be in this variable
		//
		$output = "";

		//
		// Connect to the database and select it.
		//
		$db = new PDO("mysql:host=$server_name;dbname=$db_name;charset=utf8", $db_user_name, $db_password);
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);et.
		$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

		// role
		$role = 'applicant';

		// Build variables for form data
		// Semester, year
		$semester = $_POST['semester'];
		$year = $_POST['year'];
		// personal and contact info
		$firstName = $_POST['firstName'];
		$lastName = $_POST['lastName'];
		$unid = $_POST['unid'];
		$email = $_POST['email'];
		$phone = $_POST['phone'];
		$address = $_POST['address'];
		$city = $_POST['city'];
		$state = $_POST['state'];
		$zip = $_POST['zip'];
		$major = $_POST['major'];
		// education info
		$educationLevel = $_POST['educationLevel'];
		$gpa = $_POST['gpa'];
		// employment info
		$employed = $_POST['employed'];
		$hours = $_POST['hours'];
		$description = $_POST['description'];
		// availability
		$available = $_POST['available'];
		$availableHours = $_POST['availableHours'];
		// additional info
		$transcriptPermission = $_POST['transcriptPermission'];
		$additionalInfo = $_POST['additionalInfo'];
		// graduate info
		$graduateFinancialAid = $_POST['graduateFinancialAid'];
		$country = $_POST['country'];
		$previousUniversity = $_POST['previousUniversity'];
		$toflTotal = $_POST['toflTotal'];
		$toflSpoken = $_POST['toflSpoken'];
		$ieltsTotal = $_POST['ieltsTotal'];
		$ieltsSpoken = $_POST['ieltsSpoken'];
		$itaStatus = $_POST['itaStatus'];

		// User table insert
		$userInsert = "
			INSERT INTO Users
			(email, password, firstName, lastName, address, city, state, zip, phone)
			VALUES ('$email', 'testpass', '$firstName', '$lastName', '$address', '$city', '$state', '$zip', '$phone')
		";
		$userInsertStmt = $db->prepare( $userInsert );
 	 	$userInsertStmt->execute();

		// Insert to role table
		$roleInsert = "
			INSERT INTO Roles (userId, role)
			VALUES ( (SELECT userId FROM Users WHERE email='$email'), '$role')
		";

		$roleInsertStmt = $db->prepare( $roleInsert );
 	 	$roleInsertStmt->execute();

		// Application table insert
		$appInsert = "
			INSERT INTO Applications
			(userId, submitDate, unid, semester, year, major, gpa, educationLevel, available, availableHours, transcriptPermission, additionalInfo, graduateFinancialAid)
		 	VALUES ( (SELECT userId FROM Users WHERE email='$email'), now(), '$unid', '$semester', '$year', '$major', '$gpa', '$educationLevel', '$available', '$availableHours', '$transcriptPermission', '$additionalInfo', '$graduateFinancialAid')";

	 	$appInsertStmt = $db->prepare( $appInsert );
 	 	$appInsertStmt->execute();
		
	 	// Get data for display
		$dataQuery = "
			SELECT * FROM Users u, Applications a WHERE u.userId = a.userId
		";
		// Prepare and execute the query
		$resultStmt = $db->prepare( $dataQuery );
		$resultStmt->execute();

		// Fetch all the results
		$result = $resultStmt->fetchAll(PDO::FETCH_ASSOC);

		// Build the web page for the results

		if ( empty( $result ) ) {
			$output .= "<h2> No Info </h2>";
		}
		else {
			foreach ($result as $row) {
				$output .= "<h3>Application submitted for: " . $row['semester'] . $row['year'] . "</h3><br/><br/>"
				. "<div class='section'>"
				. "<div class='header'>Personal and Contact Information</div>"
				. "<p>First Name: " . $row['firstName'] . "</p>"
				. "<p>Last Name: " . $row['lastName'] . "</p>"
				. "<p>University ID: " . $row['unid'] . "</p>"
				. "<p>Email: " . $row['email'] . "</p>"
				. "<p>Phone: " . $row['phone'] . "</p>"
				. "<p>Address: " . $row['address'] . "</p>"
				. "<p>City: " . $row['city'] . "</p>"
				. "<p>State: " . $row['state'] . "</p>"
				. "<p>Zip: " . $row['zip'] . "</p>"
				. "</div>"
				. "<div class='section'>"
				. "<div class='header'>School Information</div>"
				. "<p>Major: " . $row['major'] . "</p>"
				. "<p>Education Level: " . $row['educationLevel'] . "</p>"
				. "<p>GPA: " . $row['gpa'] . "</p>"
				. "</div>"
				. "<div class='section'>"
				. "<div class='header'>Employment Information</div>";
				if ($row['employed'] == '0') {
					$output .= "<p>Employed: No</p>";
				}
				else {
					$output .= "<p>Employed: Yes</p>"
					. "<p>Hours at other employment: " . $row['hours'] . "</p>"
					. "<p>Description of other employment: " . $row['description'] . "</p>";
				}
				$output .= "</div>"
				. "<div class='section'>"
				. "<div class='header'>Availability</div>";
				if ($row['available'] == '0') {
					$output .= "<p>Available the week before school starts: No</p>";
				}
				else {
					$output .= "<p>Available the week before school starts: Yes</p>";
				}
				$output .= "<p>Hours available to work weekly: " . $row['availableHours'] . "</p>"
				. "</div>"
				. "<div class='section'>"
				. "<div class='header'>Additional Information</div>";
				if ($row['transcriptPermission'] == '0') {
					$output .= "<p>Permission denied for School of Computing to review grades and transcript.</p>";
				}
				else {
					$output .= "<p>Permission granted for School of Computing to review grades and transcript.</p>";
				}
				$output .= "<p>Additional application information:" . $row['additionalInfo'] . "</p>"
				. "</div>";
			}
		}
	}
	catch (PDOException $ex) {
		$output .= "<p>oops</p>";
		$output .= "<p> Code: {$ex->getCode()} </p>";
		$output .=" <p> See: dev.mysql.com/doc/refman/5.0/en/error-messages-server.html#error_er_dup_key";
		$output .= "<pre>$ex</pre>";

		if ($ex->getCode() == 23000) {
			$output .= "<h2> Duplicate Entries not allowed </h2>";
		}
	}
//
// Below is the HTML content
//

echo <<<END

<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">

<html>
	<head>
		<title>Application Results</title>
		<link rel="stylesheet" href="css/app.css">
		<link rel="stylesheet" href="css/formResult.css">
		<meta name="description" content="A Teaching Assistant resource for students and instructors">
		<meta name="author" content="Ethan Hayes">
		<meta charset="UTF-8">
		<meta name="keywords" content="University, Utah, TA, Teaching, Assistant, Application">
	</head>

	<body>
END;
include 'navmenu.html';
echo <<<END
		$output
	</body>
</html>
END;

?>