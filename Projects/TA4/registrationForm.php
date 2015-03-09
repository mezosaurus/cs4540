<!DOCTYPE html>
<html>
	<head>
		<title>Register New User</title>
		<link rel="stylesheet" href="css/app.css">
		<script src="js/app.js"></script>
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
		      <form method="post" action="registration.php">
		        <p>
		        	<span style="color:red"><?php echo $emailError?></span>
		        	<br/>
		        	<input type="email" name="email" value="<?php echoValue('email')?>" placeholder="Email">
		        </p>
		        <p>
		        	<span style="color:red"><?php echo $pwError?></span>
		        	<br/>
		        	<input type="password" name="password" value="<?php echoValue('password')?>" placeholder="Password">
		        </p>
		        <p>
		        	<span style="color:red"><?php echo $firstNameError?></span>
		        	<br/>
		        	<input type="text" name="firstName" value="<?php echoValue('firstName')?>" placeholder="First Name">
		        </p>
		        <p>
		        	<span style="color:red"><?php echo $lastNameError?></span>
		        	<br/>
		        	<input type="text" name="lastName" value="<?php echoValue('lastName')?>" placeholder="Last Name">
		        </p>
		        <p>
	        		<span style="color:red"><?php echo $addressError?></span>
	        		<br/>
		        	<input type="text" name="address" value="<?php echoValue('address')?>" placeholder="Address">
		        </p>
		        <p>
		        	<span style="color:red"><?php echo $cityError?></span>
		        	<br/>
		        	<input type="text" name="city" value="<?php echoValue('city')?>" placeholder="City">
		        </p>
		        <p>
		        	<span style="color:red"><?php echo $stateError?></span>
		        	<br/>
		        	<input type="text" name="state" value="<?php echoValue('state')?>" placeholder="State">
		        </p>
		        <p>
		        	<span style="color:red"><?php echo $zipError?></span>
		        	<br/>
		        	<input type="text" name="zip" value="<?php echoValue('zip')?>" placeholder="Zip">
		        </p>
		        <p>
		        	<span style="color:red"><?php echo $phoneError?></span>
		        	<br/>
		        	<input type="tel" name="phone" value="<?php echoValue('phone')?>" placeholder="Phone Number">
		        </p>

		        <p>
			        <input type="checkbox" id="applicantRole" name="role[]" value="applicant" <?php echoCheckbox('applicant')?>>
			        <label for="applicantRole">Applicant</label>
			        <br/>
			        <input type="checkbox" id="adminRole" name="role[]" value="admin" <?php echoCheckbox('admin')?>>
			        <label for="adminRole">Administrator</label>
			        <br/>
			        <input type="checkbox" id="instructorRole"name="role[]" value="instructor" <?php echoCheckbox('instructor')?>>
			        <label for="instructorRole">Instructor</label>
			        <br/>
			        <span style="color:red"><?php echo $roleError?></span>
		        </p>
		        <p class="submit"><input type="submit" name="register" value="Register"></p>
		      </form>
		    </div>
		</div>
	</section>
	</body>
</html>