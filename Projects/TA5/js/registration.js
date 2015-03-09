// Setup an init function because the registration form is being loaded dynamically by PHP so to be able to access the form elements, we need to wait until it is loaded
(function(window, document, undefined) {
	window.onload = init;

	function init() {
		var regPw = document.getElementById('regPassword');
		var regEmail = document.getElementById('regEmail');
		var regPwConfirm = document.getElementById('regConfirmPw');
		var regFirstName = document.getElementById('regFirstName');
		var regLastName = document.getElementById('regLastName');
		var regCity = document.getElementById('regCity');
		var regZip = document.getElementById('regZip');
		var regPhone = document.getElementById('regPhone');
		// EMAIL VALIDATION
		regEmail.addEventListener('change', function(event) {
			if(regEmail.validity.typeMismatch) {
				regEmail.setCustomValidity("Please enter a valid email.");
			}
			else {
				regEmail.setCustomValidity("");
			}
		});
		// PASSWORD VALIDATION
		regPw.addEventListener('change', function(event) {
			if (regPw.validity.patternMismatch) {
				regPw.setCustomValidity("Password must contain at least one lowercase letter, at least one uppercase letter, at least one number, and be at least 8 characters in length.");
			}
			else {
				regPw.setCustomValidity("");
			}
		});
		// PASSWORD CONFIRM VALIDATION
		regPwConfirm.addEventListener('change', function(event) {
			var pw = regPw.value;
			var pwConfirm = regPwConfirm.value;
			if (pw !== pwConfirm) {
				regPwConfirm.setCustomValidity("Passwords do not match.");
			}
			else {
				regPwConfirm.setCustomValidity("");
			}
		});
		// FIRST NAME VALIDATION
		regFirstName.addEventListener('change', function(event) {
			if (regFirstName.validity.patternMismatch) {
				regFirstName.setCustomValidity("First name must only contain letters and white space.");
			}
			else {
				regFirstName.setCustomValidity("");
			}
		});
		// LAST NAME VALIDATION
		regLastName.addEventListener('change', function(event) {
			if (regLastName.validity.patternMismatch) {
				regLastName.setCustomValidity("Last name must only contain letters and white space.");
			}
			else {
				regLastName.setCustomValidity("");
			}
		});
		// CITY VALIDATION
		regCity.addEventListener('change', function(event) {
			if (regCity.validity.patternMismatch) {
				regCity.setCustomValidity("City must only contain letters and white space.");
			}
			else {
				regCity.setCustomValidity("");
			}
		});
		// ZIP VALIDATION
		regZip.addEventListener('change', function(event) {
			if (regZip.validity.patternMismatch) {
				regZip.setCustomValidity("Zip code must be 5 digits.");
			}
			else {
				regZip.setCustomValidity("");
			}
		});
		// PHONE VALIDATION
		regPhone.addEventListener('change', function(event) {
			if (regPhone.validity.patternMismatch) {
				regPhone.setCustomValidity("Phone number must be 10 digits.");
			}
			else {
				regPhone.setCustomValidity("");
			}
		});
	}
})(window, document, undefined);