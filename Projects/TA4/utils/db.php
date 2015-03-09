<?php

// Opens and returns a DB connection
function openDBConnection () {
	$server_name  = 'localhost';
	$db_user_name = 'TA_Application';
	$db_password  = '465719065';
	$db_name      = 'TA4';
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
			WHERE userId = '$userId'
		";
		$stmt = $DBH->prepare($select);
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

// Get Applicants from DB
function getApplicants() {
	try {
		$DBH = openDBConnection();
		$DBH->beginTransaction();

		$applicantSelect = "
			SELECT * FROM Users u, Roles r
			WHERE u.userId = r.userId AND r.role = 'applicant'
		";
		$applicantSelectStmt = $DBH->prepare($applicantSelect);
		$applicantSelectStmt->execute();
		$applicants = array();
		while($row = $applicantSelectStmt->fetch()) {
			$applicants[] = $row;
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
			VALUES ('$email', '$hashedPassword', '$firstName', '$lastName', '$address', '$city', '$state', '$zip', '$phone')
		";
		$userInsertStmt = $DBH->prepare( $userInsert );
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
			VALUES ('$userId', '$role')
		";
		$roleInsertStmt = $DBH->prepare( $roleInsert );
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

// Get userId
function getUserId($email) {
	try {
		$DBH = openDBConnection();
		$DBH->beginTransaction();

		$userSelect = "
			SELECT userId FROM Users WHERE email='$email'
		";
		$stmt = $DBH->prepare($userSelect);
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
	redirectToHTTPS();

	if (isset($_SESSION['user'])) {
		$roles = $_SESSION['user']->getRole();
		// Check the user's role
		if ($role == '' || ($roles && in_Array($role, $roles))) {
			return $_SESSION['user']->getName();
		}
		else {
			header('Location: /Projects/TA4/unauthenticated.php');
			exit();
		}
	}
	else {
		header('Location: /Projects/TA4/unauthenticated.php');
		exit();
	}
}

// Verify user is logged in
function verifyAuthenticated() {
	if (isset($_SESSION['user'])) {
		redirectToHTTPS();
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
			WHERE email='$email'
		";
		$stmt = $DBH->prepare($loginQuery);
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
					SELECT role FROM Roles where userId = '$userId'
				";
				$stmt = $DBH->prepare($roleSelect);
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
	require "registrationError.php";
	exit();
}
?>