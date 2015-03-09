<!DOCTYPE html>
<html>
	<head>
		<title>Register New User</title>
		<link rel="stylesheet" href="css/app.css">
		<link rel="stylesheet" href="css/form.css">
		<script src="js/registration.js"></script>
		<meta name="description" content="A Teaching Assistant resource for students and instructors">
		<meta name="author" content="Ethan Hayes">
		<meta charset="UTF-8">
		<meta name="keywords" content="University, Utah, TA, Teaching, Assistant, Application">
	</head>
	<body>
	<?php include('navmenu.html'); ?>
		<section class="content">
		<div class="description">
			<div class="login" id="login">
		      <h2>Register</h2>
		      <h3>All fields required</h3>
		      <form name="registrationForm" method="post" action="registration.php">
		        <p>
		        	<span style="color:red"><?php echo $emailError?></span>
		        	<br/>
		        	<input type="email" name="email" id="regEmail" value="<?php echoValue('email')?>" placeholder="Email" required>
		        </p>
		        <p>
		        	<span style="color:red"><?php echo $pwError?></span>
		        	<br/>
		        	<input type="password" id="regPassword" name="password" pattern="^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9]).{8,}$" placeholder="Password" required>
		        </p>
		        <p>
		        	<span style="color:red"><?php echo $confirmPwError?></span>
		        	<br/>
		        	<input type="password" id="regConfirmPw" name="passwordConfirm" placeholder="Confirm Password" required>
		        </p>
		        <p>
		        	<span style="color:red"><?php echo $firstNameError?></span>
		        	<br/>
		        	<input type="text" id="regFirstName" name="firstName" pattern="^[a-zA-Z ]*$" value="<?php echoValue('firstName')?>" placeholder="First Name" required>
		        </p>
		        <p>
		        	<span style="color:red"><?php echo $lastNameError?></span>
		        	<br/>
		        	<input type="text" id="regLastName" name="lastName" pattern="^[a-zA-Z ]*$" value="<?php echoValue('lastName')?>" placeholder="Last Name" required>
		        </p>
		        <p>
	        		<span style="color:red"><?php echo $addressError?></span>
	        		<br/>
		        	<input type="text" name="address" value="<?php echoValue('address')?>" placeholder="Address" required>
		        </p>
		        <p>
		        	<span style="color:red"><?php echo $cityError?></span>
		        	<br/>
		        	<input type="text" id="regCity" name="city" pattern="^[a-zA-Z ]*$" value="<?php echoValue('city')?>" placeholder="City" required>
		        </p>
		        <p>
		        	<span style="color:red"><?php echo $stateError?></span>
		        	<br/>
		        	<select name="state" value="<?php echoValue('state')?>"  required>
		        		<option value="AL">Alabama</option>
						<option value="AK">Alaska</option>
						<option value="AZ">Arizona</option>
						<option value="AR">Arkansas</option>
						<option value="CA">California</option>
						<option value="CO">Colorado</option>
						<option value="CT">Connecticut</option>
						<option value="DE">Delaware</option>
						<option value="DC">District Of Columbia</option>
						<option value="FL">Florida</option>
						<option value="GA">Georgia</option>
						<option value="HI">Hawaii</option>
						<option value="ID">Idaho</option>
						<option value="IL">Illinois</option>
						<option value="IN">Indiana</option>
						<option value="IA">Iowa</option>
						<option value="KS">Kansas</option>
						<option value="KY">Kentucky</option>
						<option value="LA">Louisiana</option>
						<option value="ME">Maine</option>
						<option value="MD">Maryland</option>
						<option value="MA">Massachusetts</option>
						<option value="MI">Michigan</option>
						<option value="MN">Minnesota</option>
						<option value="MS">Mississippi</option>
						<option value="MO">Missouri</option>
						<option value="MT">Montana</option>
						<option value="NE">Nebraska</option>
						<option value="NV">Nevada</option>
						<option value="NH">New Hampshire</option>
						<option value="NJ">New Jersey</option>
						<option value="NM">New Mexico</option>
						<option value="NY">New York</option>
						<option value="NC">North Carolina</option>
						<option value="ND">North Dakota</option>
						<option value="OH">Ohio</option>
						<option value="OK">Oklahoma</option>
						<option value="OR">Oregon</option>
						<option value="PA">Pennsylvania</option>
						<option value="RI">Rhode Island</option>
						<option value="SC">South Carolina</option>
						<option value="SD">South Dakota</option>
						<option value="TN">Tennessee</option>
						<option value="TX">Texas</option>
						<option value="UT">Utah</option>
						<option value="VT">Vermont</option>
						<option value="VA">Virginia</option>
						<option value="WA">Washington</option>
						<option value="WV">West Virginia</option>
						<option value="WI">Wisconsin</option>
						<option value="WY">Wyoming</option>
		        	</select>
		        </p>
		        <p>
		        	<span style="color:red"><?php echo $zipError?></span>
		        	<br/>
		        	<input type="text" id="regZip" name="zip" maxLength="5" pattern="^[0-9]{5}$" value="<?php echoValue('zip')?>" placeholder="Zip"  required>
		        </p>
		        <p>
		        	<span style="color:red"><?php echo $phoneError?></span>
		        	<br/>
		        	<input type="tel" id="regPhone" size="10" name="phone" maxLength="10" pattern="^[0-9]{10}$" value="<?php echoValue('phone')?>" placeholder="Phone Number"  required>
		        </p>

		        <p>
		        	<span style="color:red"><?php echo $roleError?></span>
		        	<br/>
			        <input type="checkbox" id="applicantRole" name="role[]" value="applicant" <?php echoCheckbox('applicant')?>>
			        <label for="applicantRole">Applicant</label>
			        <br/>
			        <input type="checkbox" id="adminRole" name="role[]" value="admin" <?php echoCheckbox('admin')?>>
			        <label for="adminRole">Administrator</label>
			        <br/>
			        <input type="checkbox" id="instructorRole"name="role[]" value="instructor" <?php echoCheckbox('instructor')?>>
			        <label for="instructorRole">Instructor</label>
		        </p>
		        <p class="submit"><input type="submit" name="register" value="Register"></p>
		      </form>
		    </div>
		</div>
	</section>
	</body>
</html>