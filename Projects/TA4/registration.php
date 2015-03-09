<?php 
	require 'utils/db.php';
	require 'utils/functions.php';

	redirectToHTTPS();

	// Setup error vars
	$emailError = '';
	$pwError = '';
	$firstNameError = '';
	$lastNameError = '';
	$addressError = '';
	$cityError = '';
	$stateError = '';
	$zipError = '';
	$phoneError = '';
	$roleError = '';

	// Make sure the register submit button has been hit
	if (isset($_POST['register'])) {
		// Get field values from POST
		$email = trim($_POST['email']);
		$password = trim($_POST['password']);
		$firstName = trim($_POST['firstName']);
		$lastName = trim($_POST['lastName']);
		$address = trim($_POST['address']);
		$city = trim($_POST['city']);
		$state = trim($_POST['state']);
		$zip = trim($_POST['zip']);
		$phone = trim($_POST['phone']);

		// Validate all fields have content
		if ($email != '' && $password != '' && $firstName != '' && $lastName != '' && $address != ''
			&& $city != '' && $state != '' && $zip != '' && $phone != '' && !empty($_POST['role'])) {
			// All fields have content, insert to Users table
			if (registerNewUser($email, $password, $firstName, $lastName, $address, $city, $state, $zip, $phone)) {
				$userId = getUserId($email);
				// Successful insert to Users table, insert roles
				foreach ($_POST['role'] as $role) {
					$role = trim($role);
					insertRole($userId, $role);
				}
				require 'registered.php';
				return;
			}
			else {
				$email = 'That email is already in use.';
				require 'registrationForm.php';
				return;
			}
		}
		// Check for empty fields and setup error messages
		if ($email == '') {
			$emailError = 'Enter a valid email.';
		}
		if ($password == '') {
			$pwError = 'Choose a password.';
		}
		if ($firstName == '') {
			$firstNameError = 'Enter first name.';
		}
		if ($lastName == '') {
			$lastNameError = 'Enter last name.';
		}
		if ($address == '') {
			$addressError = 'Enter residential address.';
		}
		if ($city == '') {
			$cityError = 'Enter city name.';
		}
		if ($state == '') {
			$stateError = 'Enter 2 character state.';
		}
		if ($zip == '') {
			$zipError = 'Enter 5 digit zip code.';
		}
		if ($phone == '') {
			$phoneError = 'Enter phone number.';
		}
		if (empty($_POST['role'])) {
			$roleError = 'Please select one or more roles.';
		}

		require 'registrationForm.php';
	}
	else {
		require 'registrationForm.php';
	}

?>
	
	