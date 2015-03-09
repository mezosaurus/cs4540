<?php
	/*
	* Author: Ethan Hayes
	* Date: 2015
	*/

	require '../models/user.php';
	require '../models/course.php';
	require '../models/application.php';
	require '../utils/db.php';
	require '../utils/functions.php';
	session_start();
	verifyRole('applicant');

	try {
		//
		// The main content of the page will be in this variable
		//
		$output = "";

		//
		// Connect to the database and select it.
		//
		/*$db = new PDO("mysql:host=$server_name;dbname=$db_name;charset=utf8", $db_user_name, $db_password);
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);et.
		$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

		// role
		$role = 'applicant';

		// Build variables for form data
		// Semester, year
		$semester = $_POST['semester'];
		$year = $_POST['year'];
		// personal info
		$unid = $_POST['unid'];
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
		

		// Application table insert
		$appInsert = "
			INSERT INTO Applications
			(userId, submitDate, unid, semester, year, major, gpa, educationLevel, available, availableHours, transcriptPermission, additionalInfo, graduateFinancialAid)
		 	VALUES ( (SELECT userId FROM Users WHERE email='$email'), now(), '$unid', '$semester', '$year', '$major', '$gpa', '$educationLevel', '$available', '$availableHours', '$transcriptPermission', '$additionalInfo', '$graduateFinancialAid')";

	 	$appInsertStmt = $db->prepare( $appInsert );
 	 	$appInsertStmt->execute();
		
	 	// Get data for display
		$dataQuery = "
			SELECT * FROM Users u, Applications a WHERE u.userId = a.userId ORDER BY a.submitDate DESC LIMIT 1
		";
		// Prepare and execute the query
		$resultStmt = $db->prepare( $dataQuery );
		$resultStmt->execute();

		// Fetch all the results
		$result = $resultStmt->fetchAll(PDO::FETCH_ASSOC);*/

		// Build the web page for the results

		if ( empty( $result ) ) {
			$output .= "<h2> No Info </h2>";
		}
		else {
			foreach ($result as $row) {
				
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


?>