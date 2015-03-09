<?php
// Reports if https is in use
function usingHTTPS () {
  return true;
	return isset($_SERVER['HTTPS']) && ($_SERVER['HTTPS'] != "off");
}

// Redirects to HTTPS
function redirectToHTTPS()
{
	if(!usingHTTPS())
	{
		$redirect = "https://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
		header("Location:$redirect");
		exit();
	}
}

// Changes the session ID
function changeSessionID () {

  // Ask the browser to delete the existing cookie
  setcookie("PHPSESSID", "", time()-3600, "/");

  // Change the session ID and send it to the browser in a secure cookie
  $server = $_SERVER['SERVER_NAME'];
  $secure = usingHTTPS();
  session_set_cookie_params(0, "/", $server, $secure, true);
  session_regenerate_id(true);
}

// Generates random salt for blowfish
function makeSalt () {
	$salt = strtr(base64_encode(mcrypt_create_iv(16, MCRYPT_DEV_URANDOM)), '+', '.');
	return '$2a$12$' . $salt;
}

// Compute a hash using blowfish using the salt. 
function computeHash ($password, $salt) {
	return crypt($password, $salt);
}

function echoValue ($value) {
	if (isset($_POST[$value])) {
		echo $_POST[$value];
	}
}
function echoCheckbox ($value) {
	if (!empty($_POST['role'])) {
		foreach ($_POST['role'] as $role) {
			if ($role == $value)
				echo "checked = 'checked''";
		}
	}
}
?>