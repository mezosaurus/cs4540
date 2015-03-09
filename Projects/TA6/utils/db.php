<?php

// Opens and returns a DB connection
function openDBConnection () {
	$server_name  = 'localhost';
	$db_user_name = 'TA_Application';
	$db_password  = '465719065';
	$db_name      = 'TA6';
	$db = new PDO("mysql:host=$server_name;dbname=$db_name;charset=utf8", $db_user_name, $db_password);
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    return $db;
}

// Get applications from DB for a userId
function getApplications($userId) {
	try {
		$DBH = openDBConnection();
		$DBH->beginTransaction();

		$select = "
			SELECT * FROM Applications
			WHERE userId = :userId
		";
		$stmt = $DBH->prepare($select);
		$stmt->bindValue(':userId', $userId);
		$stmt->execute();
		$applications = array();
		while ($row = $stmt->fetch()) {
			$applications[] = $row;
		}

		$DBH = null;
		return $applications;
	}
	catch (PDOException $e) {
		if ($e->getCode() == 23000) {
			return false;
		}
		reportDBError($e);
	}
}

// Get most recent application for userId
function getNewestApplication($userId) {
	try {
		$DBH = openDBConnection();
		$DBH->beginTransaction();

		$select = "
			SELECT * FROM Applications
			WHERE userId = :userId ORDER BY submitDate DESC LIMIT 1
		";

		$stmt = $DBH->prepare($select);
		$stmt->bindValue(':userId', $userId);
		$stmt->execute();
		$data = $stmt->fetch();
		$appId = $data['appId'];

		$DBH = null;
		return $appId;
	}
	catch (PDOException $e) {
		if ($e->getCode() == 23000) {
			return false;
		}
		reportDBError($e);
	}
}

// Get application by appId
function getApplicationByAppId($appId) {
	try {
		$DBH = openDBConnection();
		$DBH->beginTransaction();

		$select = "
			SELECT * Applications
			WHERE a.appId = :appId
		";
		$stmt = $DBH->prepare($select);
		$stmt->bindValue(':appId', $appId);
		$stmt->execute();
		$data = $stmt->fetch();
		
		// Find out if they had employment information
		$empSelect = "
			SELECT * FROM Employment
			WHERE appId = :appId
		";
		$empStmt = $DBH->prepare($empSelect);
		$empStmt->bindValue(':appId', $appId);
		$empStmt->execute();
		$empData = $empStmt->fetch();

		// Setup employment data vars
		$employerName = $employmentHours = $employmentDescription = '';
		// Verify data was received from SQL query
		if ($empData['employerName']) {
			// Employment information found for the appId, include it in results
			$employerName = $empData['employerName'];
			$employmentHours = $empData['hours'];
			$employmentDescription = $empData['description'];
		}

		$application = new Application($appId, $data['submitDate'], $data['unid'], $data['semester'], $data['year'], $data['major'], $data['gpa'],
										$data['educationLevel'], $data['available'], $data['availableHours'], $data['transcriptPermission'], $data['additionalInfo'],
										$data['graduateFinancialAid'], $employerName, $employmentHours, $employmentDescription);

		$DBH = null;
		return $application;
	}
	catch (PDOException $e) {
		if ($e->getCode() == 23000) {
			return false;
		}
		reportDBError($e);
	}
}

// Get Applicants from DB
function getApplicants() {
	try {
		$DBH = openDBConnection();
		$DBH->beginTransaction();

		$applicantSelect = "
			SELECT * FROM Users u, Roles r, Applications a
			WHERE u.userId = r.userId AND u.userId = a.userId AND r.role = :applicant
		";
		$applicantSelectStmt = $DBH->prepare($applicantSelect);
		$applicantSelectStmt->bindValue(':applicant', 'applicant');
		$applicantSelectStmt->execute();
		$applicants = array();
		while($row = $applicantSelectStmt->fetch()) {
			$applicants[] = new Applicant($row['userId'], $row['appId'], $row['firstName'], $row['lastName']);
		}

		$DBH = null;

		return $applicants;
	}
	catch (PDOException $e) {
		if ($e->getCode() == 23000) {
			return false;
		}
		reportDBError($e);
	}
}

// Get courses from DB
function getCourses() {
	try {
		$DBH = openDBConnection();
		$DBH->beginTransaction();

		$courseSelect = "
			SELECT * FROM Courses
		";
		$courseSelectStmt = $DBH->prepare($courseSelect);
		$courseSelectStmt->execute();
		$courses = array();
		while($row = $courseSelectStmt->fetch()) {
			$course = new Course($row);
			$courses[] = $course;
		}
		$DBH = null;

		return $courses;
	}
	catch (PDOException $e) {
		if ($e->getCode() == 23000) {
			return false;
		}
		reportDBError($e);
	}
}

// Registers a new user
function registerNewUser ($email, $password, $firstName, $lastName, $address, $city, $state, $zip, $phone) {
	try {
		$DBH = openDBConnection();
		$DBH->beginTransaction();

		$hashedPassword = computeHash($password, makeSalt());

		// User table insert
		$userInsert = "
			INSERT INTO Users
			(email, password, firstName, lastName, address, city, state, zip, phone)
			VALUES (:email,:password,:firstName,:lastName,:address,:city,:state,:zip,:phone)
		";
		$userInsertStmt = $DBH->prepare( $userInsert );
		$userInsertStmt->bindValue(':email', $email);
		$userInsertStmt->bindValue(':password', $hashedPassword);
		$userInsertStmt->bindValue(':firstName', $firstName);
		$userInsertStmt->bindValue(':lastName', $lastName);
		$userInsertStmt->bindValue(':address', $address);
		$userInsertStmt->bindValue(':city', $city);
		$userInsertStmt->bindValue(':state', $state);
		$userInsertStmt->bindValue(':zip', $zip);
		$userInsertStmt->bindValue(':phone', $phone);
 	 	$userInsertStmt->execute();

		$DBH->commit();
		$DBH = null;
		return true;
	}
	catch (PDOException $e) {
		if ($e->getCode() == 23000) {
			return false;
		}
		reportDBError($e);
	}
}

function insertRole ($userId, $role) {
	try {
		$DBH = openDBConnection();
		$DBH->beginTransaction();

		// Insert to role table
		$roleInsert = "
			INSERT INTO Roles 
			(userId, role)
			VALUES (:userId,:role)
		";
		$roleInsertStmt = $DBH->prepare( $roleInsert );
		$roleInsertStmt->bindValue(':userId', $userId);
		$roleInsertStmt->bindValue(':role', $role);
 	 	$roleInsertStmt->execute();

 	 	$DBH->commit();
 	 	$DBH = null;

 	 	return true;
	}
	catch (PDOException $e) {
		if ($e->getCode() == 23000) {
			return false;
		}
		reportDBError($e);
	}
}

function insertApplication($unid, $semester, $year, $major, $gpa, $educationLevel,
						$available, $availableHours, $transcriptPermission, $additionalInfo,
						$graduateFinancialAid) {
	try {
		// Get userId
		$userId = $_SESSION['user']->getUserId();
		$DBH = openDBConnection();
		$DBH->beginTransaction();

		$appInsert = "
			INSERT INTO Applications
			(userId, submitDate, unid, semester, year, major, gpa, educationLevel, available, availableHours, transcriptPermission, additionalInfo, graduateFinancialAid)
		 	VALUES (:userId, now(), :unid, :semester, :year, :major, :gpa, :educationLevel, :available, :availableHours, :transcriptPermission, :additionalInfo, :graduateFinancialAid)
		";
		$stmt = $DBH->prepare($appInsert);
		$stmt->bindValue(':userId', $userId);
		$stmt->bindValue(':unid', $unid);
		$stmt->bindValue(':semester', $semester);
		$stmt->bindValue(':year', $year);
		$stmt->bindValue(':major', $major);
		$stmt->bindValue(':gpa', $gpa);
		$stmt->bindValue(':educationLevel', $educationLevel);
		$stmt->bindValue(':available', $available);
		$stmt->bindValue(':availableHours', $availableHours);
		$stmt->bindValue(':transcriptPermission', $transcriptPermission);
		$stmt->bindValue(':additionalInfo', $additionalInfo);
		$stmt->bindValue(':graduateFinancialAid', $graduateFinancialAid);
		$stmt->execute();

		$DBH->commit();
 	 	$DBH = null;

 	 	return true;
	}
	catch (PDOException $e) {
		if ($e->getCode() == 23000) {
			return false;
		}
		reportDBError($e);
	}
}

// Function to insert employment information from application
function insertEmployment($appId, $employerName, $description, $hours) {
	try {
		$DBH = openDBConnection();
		$DBH->beginTransaction();

		$appInsert = "
			INSERT INTO Employment
			(appId, employerName, description, hours)
		 	VALUES (:appId, :employerName, :description, :hours)
		";
		$stmt = $DBH->prepare($appInsert);
		$stmt->bindValue(':appId', $appId);
		$stmt->bindValue(':employerName', $employerName);
		$stmt->bindValue(':description', $description);
		$stmt->bindValue(':hours', $hours);
		$stmt->execute();

		$DBH->commit();
 	 	$DBH = null;

 	 	return true;
	}
	catch (PDOException $e) {
		if ($e->getCode() == 23000) {
			return false;
		}
		reportDBError($e);
	}
}

// Get userId
function getUserId($email) {
	try {
		$DBH = openDBConnection();
		$DBH->beginTransaction();

		$userSelect = "
			SELECT userId FROM Users WHERE email=:email
		";
		$stmt = $DBH->prepare($userSelect);
		$stmt->bindValue(':email', $email);
		$stmt->execute();

		$userId;
		while($row = $stmt->fetch()) {
			$userId = $row['userId'];
		}
		$DBH = null;
		return $userId;
	}
	catch (PDOException $e) {
		reportDBError($e);
	}
}

// Verify user has correct role access
function verifyRole($role) {
	//redirectToHTTPS();

	if (isset($_SESSION['user'])) {
		$roles = $_SESSION['user']->getRole();
		// Check the user's role
		if ($role == '' || ($roles && in_Array($role, $roles))) {
			return $_SESSION['user']->getName();
		}
		else {
			header('Location: /Projects/TA6/unauthenticated.php');
			exit();
		}
	}
	else {
		header('Location: /Projects/TA6/unauthenticated.php');
		exit();
	}
}

// Verify user is logged in
function verifyAuthenticated() {
	if (isset($_SESSION['user'])) {
		//redirectToHTTPS();
		if (basename($_SERVER['PHP_SELF']) != "hub.php") {
			header("Location: hub.php");
		}
	}
	else {
		if (basename($_SERVER['PHP_SELF']) != "index.php") {
			header("Location: index.php");
		}
	}
}

// Verify login
function verifyLogin($email, $password) {
	echo '<script type="text/javascript">console.log("verifyLogin");</script>';
	try {
		$DBH = openDBConnection();
		$message = '';

		$loginQuery = "
			SELECT *
			FROM Users
			WHERE email=:email
		";
		$stmt = $DBH->prepare($loginQuery);
		$stmt->bindValue(':email', $email);
		$stmt->execute();

		if ($row = $stmt->fetch()) {
			// Validate pw
			$hashedPw = $row['password'];
			//echo '<script type="text/javascript">console.log("stored pw = ' . $hashedPw . '")</script>';
			//echo '<script type="text/javascript">console.log("computed pw = '. $computedPw . '");</script>';
			if (computeHash($password, $hashedPw) == $hashedPw) {
				$userId = $row['userId'];
				$email = $row['email'];
				$password = $row['password'];
				$firstName = $row['firstName'];
				$lastName = $row['lastName'];
				$address = $row['address'];
				$city = $row['city'];
				$state = $row['state'];
				$zip = $row['zip'];
				$phone = $row['phone'];
				
				$message = "Successful Login";
				$stmt->closeCursor();

				// Get user roles
				$roleSelect = "
					SELECT role FROM Roles where userId = :userId
				";
				$stmt = $DBH->prepare($roleSelect);
				$stmt->bindValue(':userId', $userId);
				$stmt->execute();
				$roles = array();
				while ($row = $stmt->fetch()) {
					$roles[] = $row['role'];
				}

				$user = new User($roles, $userId, $email, $password, $firstName, $lastName, $address, $city, $state, $zip, $phone);

				$_SESSION['user'] = $user;

				//$_SESSION['roles'] = $roles;

				//changeSessionID();

				$message = "success";
				return $message;
			}
			else {
				$message = "Email and/or password is wrong.";
				//require "index.php";
				return $message;
			}
		}
		else {
			$message = "Email and/or password is wrong.";
			//require "index.php";
			return $message;
		}
	}
	catch (PDOException $e) {
		reportDBError($e);
	}
}

// Logs and reports a database error
function reportDBError ($exception) {
	$file = fopen("log.txt", "a"); 
	fwrite($file, date(DATE_RSS));
	fwrite($file, "\n");
	fwrite($file, $exception->getMessage());
	fwrite($file, $exception->getTraceAsString());
	fwrite($file, "\n");
	fwrite($file, "\n");
	fclose($file);
	require "../registrationError.php";
	exit();
}
?>