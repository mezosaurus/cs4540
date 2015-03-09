<?php
	ini_set('display_errors',1);
	ini_set('display_startup_errors',1);
	error_reporting(-1);
	require '../models/user.php';
	require '../models/application.php';
	require '../utils/db.php';
	require '../utils/functions.php';
	session_start();
	verifyRole('applicant');

	// Setup error vars
	$semesterError = $yearError = $unidError = $majorError = $edLevelError = $gpaError =  '';
	$empError = $empNameError = $empHoursError = $empDescError = '';
	$availError = $availHoursError = $transPermError = $gradFinancialError = '';
	// Setup value vars
	$semester = $year = $unid = $major = $educationLevel = $gpa = '';
	$employed = $employerName = $employmentHours = $employmentDescription = '';
	$available = $availableHours = $transcriptPermission = $graduateFinancialAid = '';
	$additionalInfo = '';
	$application = '';

	// Setup regex patterns
	// Year pattern
	$yearRegex = "/^[0-9]{4}$/";
	// UNID pattern
	$unidRegex = "/^00[0-9]{6}$/";
	// Text and white space pattern

	// Check for a POST
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		// Get additional info, it is not required, but validate it
		$additionalInfo = validateInput($_POST['additionalInfo']);
		// SEMESTER VALIDATION
		if (empty($_POST['semester'])) {
			$semesterError = 'Semester is required.';
		}
		else {
			$semester = validateInput($_POST['semester']);
			// Semester can only be spring, fall, or summer
			if ($semester != "spring" && $semester != "summer" && $semester != "fall") {
				$semesterError = 'Invalid semester input.';
			}
		}
		// YEAR VALIDATION
		if (empty($_POST['year'])) {
			$yearError = 'Year is required.';
		}
		else {
			$year = validateInput($_POST['year']);
			if (!preg_match($yearRegex, $year)) {
				$yearError = 'Year must be four digits.';
			}
		}
		// UNID VALIDATION
		if (empty($_POST['unid'])) {
			$unidError = 'UNID is required.';
		}
		else {
			$unid = $_POST['unid'];
			if (!preg_match($unidRegex, $unid)) {
				$unidError = 'UNID must be properly formatted.';
			}
		}
		// MAJOR VALIDATION
		if (empty($_POST['major'])) {
			$majorError = 'Major is required.';
		}
		else {
			$major = validateInput($_POST['major']);
		}
		// EDUCATION LEVEL VALIDATION
		if (empty($_POST['educationLevel'])) {
			$edLevelError = 'Education level required.';
		}
		else {
			$educationLevel = validateInput($_POST['educationLevel']);
		}
		// GPA VALIDATION
		if (empty($_POST['gpa'])) {
			$gpaError = 'GPA required.';
		}
		else {
			$gpa = validateInput($_POST['gpa']);
		}
		// AVAILABLE VALIDATION
		if (empty($_POST['available'])) {
			$availError = 'Availability acknowledgment for the week before school required.';
		}
		else {
			$available = validateInput($_POST['available']);
			// Only allowed values are 0 for no and 1 for yes
			if ($available != '0' && $available != '1') {
				$availError = 'Invalid value for acknowledgment of availability.';
			}
		}
		// AVAILABLE HOURS VALIDATION
		if (empty($_POST['availableHours'])) {
			$availHoursError = 'Hours available for TA position required.';
		}
		else {
			$availableHours = validateInput($_POST['availableHours']);
		}
		// TRANSCRIPT PERMISSION VALIDATION
		if (empty($_POST['transcriptPermission'])) {
			$transPermError = 'Transcript permission selection is required.';
		}
		else {
			$transcriptPermission = validateInput($_POST['transcriptPermission']);
			// Only allowed values are 0 for no, 1 for yes
			if ($transcriptPermission != '0' && $transcriptPermission != '1') {
				$transPermError = 'Invalid value for transcript permission.';
			}
		}
		// GRADUATE FINANCIAL AID VALIDATION
		if (empty($_POST['graduateFinancialAid'])) {
			$gradFinancialError = 'Acknowledgment of graduate financial aid is required.';
		}
		else {
			$graduateFinancialAid = validateInput($_POST['graduateFinancialAid']);
			// Only allowed values are 0 for no, 1 for yes
			if ($gradFinancialError != '0' && $gradFinancialError != '1') {
				$gradFinancialError = 'Invalid value for indication of graduate financial aid.';
			}
		}
		// EMPLOYED VALIDATION
		if (empty($_POST['employed'])) {
			$empError = 'Acknowledgment of other employment required.';
		}
		else {
			$employed = validateInput($_POST['employed']);
			// Check to see if they selected yes or no
			if ($employed == '1') {
				// Selected yes, validate other employment info
				// EWPLOYER NAME VALIDATION
				if (empty($_POST['employerName'])) {
					$empNameError = 'Employer name required.';
				}
				else {
					$employerName = validateInput($_POST['employerName']);
				}
				// EMPLOYMENT HOURS VALIDATION
				if (empty($_POST['hours'])) {
					$empHoursError = 'Other employment hours required.';
				}
				else {
					$employmentHours = validateInput($_POST['hours']);
				}
				// EMPLOYMENT DESCRIPTION VALIDATION
				if (empty($_POST['description'])) {
					$empDescError = 'Other employment description required.';
				}
				else {
					$employmentDescription = validateInput($_POST['description']);
				}
			}
		}

		// Make sure there are no errors before proceeding
		if (empty($semesterError) && empty($yearError) && empty($unidError) && empty($majorError)
			&& empty($edLevelError) && empty($empError) && empty($empNameError) && empty($empHoursError)
			&& empty($empDescError) && empty($availError) && empty($availHoursError)
			&& empty($transPermError) && empty($gradFinancialError) && empty($gpaError)) {

			// Insert application
			if (insertApplication($unid, $semester, $year, $major, $gpa, $educationLevel,
								$available, $availableHours, $transcriptPermission, $additionalInfo,
								$graduateFinancialAid))
			{
				// Get userId from session
				$userId = $_SESSION['user']->getUserId();
				// Grab the newest application (the one just inserted)
				$appId = getNewestApplication($userId);
				// Insert employment information if it was entered
				if ($employed == '1') {
					if (insertEmployment($appId, $employerName, $employmentDescription, $employmentHours)) {
						$application = getApplicationByAppId($appId);
					}
					else {
						require 'form.php';
						return;
					}
				}
				else {
					$application = getApplicationByAppId($appId);
				}
			}
			else {
				require 'form.php';
				return;
			}
		}
	}
	else {
		require 'form.php';
	}
// HTML content

echo <<<END

<!DOCTYPE html>

<html>
	<head>
		<title>Application Display</title>
		<link rel="stylesheet" href="../css/app.css">
		<link rel="stylesheet" href="../css/formResult.css">
		<meta name="description" content="A Teaching Assistant resource for students and instructors">
		<meta name="author" content="Ethan Hayes">
		<meta charset="UTF-8">
		<meta name="keywords" content="University, Utah, TA, Teaching, Assistant, Application">
	</head>

	<body>
END;
require '../navmenu/applicantNavMenu.php';
echo <<<END
	$application
	</body>
</html>
END;
?>