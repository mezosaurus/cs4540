<!DOCTYPE html>
<html>
<head>
	<title> Teaching Assistant Application</title>
	<link rel="stylesheet" href="css/app.css">
	<link rel="stylesheet" href="css/appForm.css">
	<script src="js/app.js"></script>
	<meta name="description" content="A Teaching Assistant resource for students and instructors">
	<meta name="author" content="Ethan Hayes">
	<meta charset="UTF-8">
	<meta name="keywords" content="University, Utah, TA, Teaching, Assistant, Application">
</head>
<body onload="createFormElements();">
	<?php include("navmenu.html");?>

	<section class="content">
		<div class="description">
			<h1>Teaching Assistant Requirements</h1>
			<p class="summary">
				<ol>
					<li>
							TAs are expected to spend 20 hours per week on TA duties. Students who are TAing should plan to take a lighter load than normal. This is especially true for students new to the University of Utah.
						<br><br>
							TAs must allocate enough time to properly prepare for office hours, including pre-reading and pre-doing the course assignments. When in charge of a discussion section, TAs will be expected to pre-prepare and practice their discussion.
						<br><br>
							TAs will be expected to finish assigned grading promptly and accurately within 7 days of the due date. Grading takes priority over other academic endeavors.
					</li>
					<br/>
					<li>
						TAs are expected to be in town the week before school starts.
					</li>
					<br/>
					<li>
						TA applicants should only choose classes for which they <b>can attend the class lectures and lab sections</b>.  You can find information about when and where classes meet on the CIS system.
					</li>
					<br/>
					<li>
						TAs are expected to be able to <b>effectively communicate</b> with the professor and students in the class. You will be expected to be fluent in the English language and comfortable speaking to individuals and groups.
					</li>
					<br/>
					<li>
						Excellent TAs will provide additional support to your faculty supervisor above and beyond normal duties, e.g., suggesting and/or creating new assignments, holding extra study sessions, stepping in to answer questions to students and solve issues, etc.
					</li>
				</ol>
			</p>
		</div>
	</section>
	<br/>
	<h1 style="text-align: center">Teaching Assistant Application Form</h1>
	<br/>
	<form class="application-form" id="applicationForm" action="formSubmit.php" method="post">
		<label class="no-indent" for="semesterSelect">Please select the semester and year you would like to TA for:</label>
		<br/>
		<select id="semesterSelect" name="semester" form="applicationForm">
			<option value="spring">Spring</option>
			<option value="summer">Summer</option>
			<option value="fall">Fall</option>
		</select>
		<select id="yearSelect" name="year" form="applicationForm">
			<script>
				var date = new Date();
				var year = date.getFullYear();
				document.write('<option value="'+year+'" selected="selected">'+year+'</option>');
			</script>
		</select>
		<br/>
		<div class="section-clickable" onClick="showSection(1)">
			<h2 class="section-header">Personal and Contact Information
				<div id="sectionBtn1" style="display:inline-block" class="arrow-up"></div>
			</h2>
		</div>
		<div id="formSection1" class="form-section" style="display: none">
			<label for="firstName">First Name</label>
            <input type="text" name="firstName" placeholder="First Name">
            <br/>
            <label for="lastName">Last Name</label>
            <input type="text" name="lastName" placeholder="Last Name">
            <br/>
            <label for="unid">University ID (e.g., 00123456)</label>
            <input type="text" name="unid" placeholder="UUIID">
            <br/>
            <label for="email">Email</label>
            <input type="email" name="email" placeholder="Email">
            <br/>
            <label for="phone">Phone</label>
            <input type="tel" name="phone" placeholder="Phone">
            <br/>
            <label for="Address">Address</label>
            <input type="text" name="address" placeholder="Address">
            <br/>
            <label for="city">City</label>
            <input type="text" name="city" placeholder="City">
            <br/>
            <label for="state">State</label>
            <input type="text" name="state" placeholder="State">
            <br/>
            <label for="zip">Zip</label>
            <input type="text" name="zip" placeholder="Zip">
            <br/>
            <label for="major">Major</label>
            <input type="text" name="major" placeholder="Major">
            <br/>
            <label for="educationLevel">Education Level</label>
            <select name="educationLevel" form="applicationForm">
            	<option value="bachelor">Bachelor's</option>
            	<option value="undergradbsms">BS/MS - Undergraduate</option>
            	<option value="gradbsms">BS/MS - Graduate</option>
            	<option value="master">Master's</option>
            	<option value="phd">PhD</option>
            </select>
            <br/>
            <label for="gpa">GPA</label>
            <input type ="text" name="gpa" placeholder="GPA">
            <br/>
            <label for="employed">Will you be employed other than your potential TA position?</label>
            <br/>
            <input type="radio" id="employedYes" name="employed" value="1"><label for="employedYes">Yes</label>
            <br/>
            <input type="radio" id="employedNo" name="employed" value="0"><label for="employedNo">No</label>
            <br/>
            <label for="hours">Hours</label>
            <input type="text" name="hours" placeholder="Other Employment Hours">
            <br/>
            <label for="description">Describe other employment:</label>
            <br/>
        	<textarea name="description"></textarea>
        	<br/>
            <label for="available">Will you be in town and available the week before School starts?</label>
            <br/>
            <input type="radio" id="availableYes" name="available" value="1"><label for="availableYes">Yes</label>
            <br/>
            <input type="radio" id="availableNo" name="available" value="0"><label for="availableNo">No</label>
            <br/>
            <label for="availableHours">Hours you are available weekly to TA:</label>
            <input type="text" name="availableHours" placeholder="Available Hours">
        	<br/>
            <label>I grant the SoC the right to review my course grades and transcripts for the purpose of making hiring decisions:</label>
            <br/>
            <input type="radio" id="permissionYes" name="transcriptPermission" value="1" checked><label for="permissionYes">Yes</label>
            <br/>
            <input type="radio" id="permissionNo" name="transcriptPermission" value="0"><label for="permissionNo">No</label>
            <br/>
		</div>
		<br/>
		<div class="section-clickable" onClick="showSection(2)">
			<h2 class="section-header">Past TA Experience
				<div id="sectionBtn2" style="display:inline-block" class="arrow-up"></div>
			</h2>
		</div>
		<div id="formSection2" class="form-section" style="display: none">
			Please select all courses you have previously TA'd for:
			<h3 class="inner-section-header">CS 1000 - 1999
				<div id="sectionBtn1000" style="display:inline-block" class="arrow-up" onClick="showSection(1000)"></div>
			</h3>
			<div id="formSection1000" class="inner-form-section" style="display: none"></div>

			<h3 class="inner-section-header">CS 2000 - 2999
				<div id="sectionBtn2000" style="display:inline-block" class="arrow-up" onClick="showSection(2000)"></div>
			</h3>
			<div id="formSection2000" class="inner-form-section" style="display: none"></div>

			<h3 class="inner-section-header">CS 3000 - 3999
				<div id="sectionBtn3000" style="display:inline-block" class="arrow-up" onClick="showSection(3000)"></div>
			</h3>
			<div id="formSection3000" class="inner-form-section" style="display: none"></div>

			<h3 class="inner-section-header">CS 4000 - 4999
				<div id="sectionBtn4000" style="display:inline-block" class="arrow-up" onClick="showSection(4000)"></div>
			</h3>
			<div id="formSection4000" class="inner-form-section" style="display: none"></div>

			<h3 class="inner-section-header">CS 5000 - 5999
				<div id="sectionBtn5000" style="display:inline-block" class="arrow-up" onClick="showSection(5000)"></div>
			</h3>
			<div id="formSection5000" class="inner-form-section" style="display: none"></div>

			<h3 class="inner-section-header">CS 6000 - 6999
				<div id="sectionBtn6000" style="display:inline-block" class="arrow-up" onClick="showSection(6000)"></div>
			</h3>
			<div id="formSection6000" class="inner-form-section" style="display: none"></div>
		</div>
		<br/>
		<div class="section-clickable" onClick="showSection(3)">
			<h2 class="section-header">Course Selection
				<div id="sectionBtn3" style="display:inline-block" class="arrow-up"></div>
			</h2>
		</div>
		<div id="formSection3" class="form-section" style="display: none">
			Please select all courses you would like to TA for (must have taken the course before you can TA it):
			<h3 class="inner-section-header">CS 1000 - 1999
				<div id="sectionBtn1001" style="display:inline-block" class="arrow-up" onClick="showSection(1001)"></div>
			</h3>
			<div id="formSection1001" class="inner-form-section" style="display: none"></div>

			<h3 class="inner-section-header">CS 2000 - 2999
				<div id="sectionBtn2001" style="display:inline-block" class="arrow-up" onClick="showSection(2001)"></div>
			</h3>
			<div id="formSection2001" class="inner-form-section" style="display: none"></div>

			<h3 class="inner-section-header">CS 3000 - 3999
				<div id="sectionBtn3001" style="display:inline-block" class="arrow-up" onClick="showSection(3001)"></div>
			</h3>
			<div id="formSection3001" class="inner-form-section" style="display: none"></div>

			<h3 class="inner-section-header">CS 4000 - 4999
				<div id="sectionBtn4001" style="display:inline-block" class="arrow-up" onClick="showSection(4001)"></div>
			</h3>
			<div id="formSection4001" class="inner-form-section" style="display: none"></div>

			<h3 class="inner-section-header">CS 5000 - 5999
				<div id="sectionBtn5001" style="display:inline-block" class="arrow-up" onClick="showSection(5001)"></div>
			</h3>
			<div id="formSection5001" class="inner-form-section" style="display: none"></div>

			<h3 class="inner-section-header">CS 6000 - 6999
				<div id="sectionBtn6001" style="display:inline-block" class="arrow-up" onClick="showSection(6001)"></div>
			</h3>
			<div id="formSection6001" class="inner-form-section" style="display: none"></div>
		</div>
		<br/>
		<div class="section-clickable" onClick="showSection(4)">
			<h2 class="section-header">Additional Information
				<div id="sectionBtn4" style="display:inline-block" class="arrow-up"></div>
			</h2>
		</div>
		<div id="formSection4" class="form-section" style="display: none">
			<label for="additionalInfo">Please provide information on the following:</label>
			<br/>
			<ol class="form-list">
				<li>The strengths and abilities you would bring to the job.</li>
				<li>What programming languages and tools you are familiar with.</li>
				<li>Any past experience not described above.</li>
				<li>Any recommendations from faculty asking for you specifically as a TA.</li>
				<li>Any additional information you think would help us choose you as a TA. </li>
			</ol>
	        <textarea class="additional-info-textarea" name="additionalInfo"></textarea>
	        <br/>
		</div>
		<br/>
		<div class="section-clickable" onClick="showSection(5)">
			<h2 class="section-header">Graduate Students
				<div id="sectionBtn5" style="display:inline-block" class="arrow-up"></div>
			</h2>
		</div>
		<div id="formSection5" class="form-section" style="display: none">
	        <label for="graduateFinancialAid">Were you promised financial aid for this coming semester as part of your acceptance package?</label>
	        <br/>
	        <input type="radio" id="finAidYes" name="graduateFinancialAid" value="1" checked><label for="finAidYes">Yes</label>
	        <br/>
	        <input type="radio" id="finAidNo" name="graduateFinancialAid" value="0"><label for="finAidNo">No</label>
	        <br/>
	        <label for="country">What is your country of origin?<br/> (Where your were born/raised.)</label>
	        <input type = "text" name="country" placeholder="Country">
	        <br/>
	        <label for="previousUniversity">What is the name of <br/>your previous University?</label>
	        <input type = "text" name="previousUniversity" placeholder="Previous University">
	        <br/>
	        <label for="toflTotal">Please enter your <br/>total TOFL score:</label>
	        <input type = "text" name="toflTotal" placeholder="TOFL Total">
	        <br/>
	        <label for="toflSpoken">Please enter your TOFL <br/>spoken communication score:</label>
	        <input type = "text" name="toflSpoken" placeholder="TOFL Spoken">
	        <br/>
	        <label for="ieltsTotal">If you have taken the IELTS, <br/>please enter your total score:</label>
	        <input type = "text" name="ieltsTotal" placeholder="IELTS Total">
	        <br/>
	        <label for="ieltsSpoken">If you have taken the IELTS, <br/>please enter your spoken<br/> communication score:</label>
	        <input type = "text" name="ieltsSpoken" placeholder="IELTS Spoken">
	        <br/>
	        <label for="itaStatus">ITA Status</label>
	        <input type = "text" name="itaStatus" placeholder="ITA Status">
		</div>
		<br/>
		<input type="submit" name="submit" value="Submit" class="submit-button">
	</form>
</body>
</html>