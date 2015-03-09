<?php
	require 'utils/db.php';
	require 'utils/functions.php';

	//redirectToHTTPS();

	// Setup error vars
	$emailError = $pwError = $confirmPwError = $firstNameError = $lastNameError = $addressError = $cityError = $stateError = $zipError = $phoneError = $roleError = '';
	// Setup value vars
	$email = $password = $confirmPw = $firstName = $lastName = $address = $city = $state = $zip = $phone = '';
	$validatedRoles = array();

	// Setup regex patterns
	// names should only be letters and white space
	$nameRegex = "/^[a-zA-Z ]*$/";
	// password should be minimum 8 length, contain at least one lowercase, contain at least one uppercase, contain at least one number
	$pwRegex = "/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9]).{8,}$/";
	// state should be 2 uppercase letters
	$stateRegex = "/^[A-Z]{2}$/";
	// zip should be 5 digits
	$zipRegex = "/^[0-9]{5}$/";
	// phone should be 10 digits
	$phoneRegex = "/^[0-9]{10}$/";

	// Check for a POST
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		// EMAIL VALIDATION
		if (empty($_POST['email'])) {
			$emailError = 'Email is required.';
		}
		else {
			// email non-empty, pass it to validate function
			$email = validateInput($_POST['email']);
			// make sure email is properly formatted
			if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
				$emailError = "Please enter a valid email.";
			}
		}
		// PASSWORD VALIDATION
		if (empty($_POST['password'])) {
			$pwError = 'Password is required.';
		}
		else {
			// password is non-empty, pass it to validate function
			$password = validateInput($_POST['password']);
			// validate password against regex
			if (!preg_match($pwRegex, $password)) {
				$pwError = 'Password must contain at least one lowercase letter, at least one uppercase letter, at least one number, and be at least 8 characters in length.';
			}
		}
		// CONFIRM PASSWORD VALIDATION
		if (empty($_POST['passwordConfirm'])) {
			$confirmPwError = 'Please re-enter your password.';
		}
		else {
			// confirm pw is non-empty, pass it to validate function
			$confirmPw = validateInput($_POST['passwordConfirm']);
			// Make sure the password and confirm password values match
			if ($confirmPw != $password) {
				$confirmPwError = 'Passwords do not match.';
			}
		}
		// FIRST NAME VALIDATION
		if (empty($_POST['firstName'])) {
			$firstNameError = 'First name is required.';
		}
		else {
			// firstName is non-empty, pass it to validate function
			$firstName = validateInput($_POST['firstName']);
			// validate firstname against regex
			if (!preg_match($nameRegex, $firstName)) {
				$firstNameError = 'First name must only contain letters and white space.';
			}
		}
		// LAST NAME VALIDATION
		if (empty($_POST['lastName'])) {
			$lastNameError = 'Last name is required.';
		}
		else {
			// lastName is non-empty, pass it to validate function
			$lastName = validateInput($_POST['lastName']);
			// validate lastname against regex
			if (!preg_match($nameRegex, $lastName)) {
				$lastNameError = 'Last name must only contain letters and white space.';
			}
		}
		// ADDRESS VALIDATION
		if (empty($_POST['address'])) {
			$addressError = 'Address is required.';
		}
		else {
			// address is non-empty, pass it to validate function
			$address = validateInput($_POST['address']);
		}
		// CITY VALIDATION
		if (empty($_POST['city'])) {
			$cityError = 'City is required.';
		}
		else {
			// city is non-empty, pass it to validate function
			$city = validateInput($_POST['city']);
			// city should only have letters and white space just like names
			if (!preg_match($nameRegex, $city)) {
				$cityError = 'City must only contain letters and white space.';
			}
		}
		// STATE VALIDATION
		if (empty($_POST['state'])) {
			$stateError = 'State is required.';
		}
		else {
			// state is non-empty, pass it to validate function
			$state = validateInput($_POST['state']);
			// validate state against regex
			if (!preg_match($stateRegex, $state)) {
				$stateError = 'State must only be 2 uppercase letters.';
			}
		}
		// ZIP VALIDATION
		if (empty($_POST['zip'])) {
			$zipError = 'Zip code is required.';
		}
		else {
			// zip is non-empty, pass it to validate function
			$zip = validateInput($_POST['zip']);
			// validate zip against regex
			if (!preg_match($zipRegex, $zip)) {
				$zipError = 'Zip code must be 5 digits.';
			}
		}
		// PHONE VALIDATION
		if (empty($_POST['phone'])) {
			$phoneError = 'Phone number is required.';
		}
		else {
			// phone is non-empty, pass it to validate function
			$phone = validateInput($_POST['phone']);
			// validate phone against regex
			if (!preg_match($phoneRegex, $phone)) {
				$phoneError = 'Phone number must be 10 digits.';
			}
		}
		// ROLE VALIDATION
		if (empty($_POST['role'])) {
			$roleError = 'At least one role is required.';
		}
		else {
			// role is non-empty, but an array so iterate and pass each value to the validate function
			$roles = $_POST['role'];
			foreach ($roles as $role) {
				$role = validateInput($role);
				// Only allowable roles are applicant, admin, and instructor
				if ($role != 'applicant' && $role != 'admin' && $role != 'instructor') {
					$roleError = 'Please select a valid role.';
				}
				else {
					$validatedRoles[] = $role;
				}
			}
		}

		// Validate there were no errors
		if (empty($emailError) && empty($pwError) && empty($confirmPwError) && empty($firstNameError) && empty($lastNameError) && empty($addressError) &&
				empty($cityError) && empty($stateError) && empty($zipError) && empty($phoneError) && empty($roleError)) {
			// No errors were found, proceed to insert
			if (registerNewUser($email, $password, $firstName, $lastName, $address, $city, $state, $zip, $phone)) {
				$userId = getUserId($email);
				// Successful insert to Users table, insert roles
				foreach ($validatedRoles as $role) {
					insertRole($userId, $role);
				}
				require 'registered.php';
				return;
			}
			else {
				$emailError = 'That email is already in use.';
				require 'registrationForm.php';
				return;
			}
		}

		require 'registrationForm.php';
	}
	else {
		require 'registrationForm.php';
	}

?>