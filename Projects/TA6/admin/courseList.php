<?php
	ini_set('display_errors',1);
	ini_set('display_startup_errors',1);
	error_reporting(-1);
	require '../models/user.php';
	require '../models/course.php';
	require '../models/application.php';
	require '../utils/db.php';
	require '../utils/functions.php';
	session_start();
	//verifyRole('admin');

	// Vars
	$semester = $year = "";
	$semesterError = $yearError = "";

	// Setup regex patterns
	// Year pattern
	$yearRegex = "/^[0-9]{2}$/";

	$content = "";

	if ($_SERVER["REQUEST_METHOD"] == "POST") {
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

		// Ensure no errors occurred with validation input
		if (empty($yearError) && empty($semesterError)) {
			echo '<script type="text/javascript">console.log("inputs good")</script>';
			echo '<script type="text/javascript">console.log("year = ' . $year . '")</script>';
			echo '<script type="text/javascript">console.log("semester = ' . $semester . '")</script>';
			// open a socket to the acs web page
			$fp = fsockopen("www.acs.utah.edu", 80, $errno, $errstr, 5);

			/*
			* term is a 4 digit number with the following format.
	        * 1st digit is a 1 if the year is after 2000, or a zero if it is before 2000
	        * 2nd and 3rd digit are the last two digits of the year
	        * 4th digit is the semester:  4 = spring, 6 = summer, 8 = fall
	        *
	        * classes before Fall 2007 use dept=CP+SC
	        */

	        $term = $dept = "";

	     	// Determine if year is before or after 2000
	     	if ($year >= "00") {
	     		// 2000 or greater
	     		// check to see if year is greater than 2007
	     		if ($year >= "07") {
	     			if ($year == "07") {
	     				if ($semester == "fall") {
	     					$dept = "CS";
	     				}
	     				else {
	     					$dept = "CP+SC";
	     				}
	     			}
	     			else {
		     			$dept = "CS";
		     		}
	     		}
	     		else {
	     			$dept = "CP+SC";
	     		}

	     		$term = "1" . $year;
	     	}
	     	else {
	     		// before 2000
	     		$term = "0" . $year;
	     		$dept = "CP+SC";
	     	}

	     	if ($semester == "spring") {
	     		// spring = 4
	     		$term .= "4";
	     	}
	     	else if ($semester == "summer") {
	     		// summer = 6
	     		$term .= "6";
	     	}
	     	else {
	     		// famm =  8
	     		$term .= "8";
	     	}

	     	echo '<script type="text/javascript">console.log("term = ' . $term . '")</script>';
			echo '<script type="text/javascript">console.log("dept = ' . $dept . '")</script>';

			// prepare the GET request to pull the data.
			//  (simulate a web browser)
			$out = "GET /uofu/stu/scheduling?term=". $term . "&dept=" .$dept . "&classtype=g HTTP/1.1\r\n";
			$out .= "Host: www.acs.utah.edu\r\n";
			$out .= "Connection: Close\r\n\r\n";

			// Send GET request
			fwrite($fp, $out);

			// check for success
			if (!$fp) {
				$content = " offline ";
			}
			else {
				// pull the entire web page and concat it up in a single "page" variable
				$page = "";
				while (!feof($fp)) {
					$page .= fgets($fp, 100000);
				}
				fclose($fp);
				$page = str_replace('&nbsp;', '', $page);
				$doc = new DOMDocument();
				@$doc->loadHTML($page);

				$tables = $doc->getElementsByTagName('table');
				// Index 4 is the course info table if dept is CS
				// Index 0 is the course info table if dept is CP+SC
				$table = "";
				if ($dept == "CS") {
					$table = $tables->item(4);
				}
				else {
					$table = $tables->item(0);
				}

				$rows = $table->getElementsByTagName('tr');

				$content = '<table id="courseList">';
				// 1 header row, 17 content rows per section
				foreach ($rows as $row) {
					// Row consists of 16 data elements
					// Flg = 0
					// Class number = 1
					// Subject = 2
					// Catalog number = 3
					// Section = 4
					// Component = 5
					// Units = 6
					// Title = 7
					// Days taught = 8
					// Time = 9
					// Location = 10
					// Class attributes = 11
					// Instructor = 12
					// Feedback = 13
					// Pre req = 14
					// Fees = 15
					
					$cells = $row->getElementsByTagName('td');
					$content .= "<tr>";
					$cellIndex = 0;
					
					foreach ($cells as $cell) {
						$header = false;
						if ($cellIndex == 0) {
							//$content .= "<td class='flag'>";
							$cellIndex = $cellIndex + 1;
							continue;
						}
						else if ($cellIndex == 1) {
							if ($cell->nodeValue == "Class Number") {
								$header = true;
								$content .= "<th class='class-number'>";
							}
							else {
								$content .= "<td class='class-number'>";
							}
						}
						else if ($cellIndex == 2) {
							if ($cell->nodeValue == "Subject") {
								$header = true;
								$content .= "<th class='subject'>";
							}
							else
								$content .= "<td class='subject'>";
						}
						else if ($cellIndex == 3) {
							if ($cell->nodeValue == "Catalog Number") {
								$header = true;
								$content .= "<th class='catalog-number'>";
							}
							else
								$content .= "<td class='catalog-number'>";
						}
						else if ($cellIndex == 4) {
							if ($cell->nodeValue == "Section") {
								$header = true;
								$content .= "<th class='section'>";
							}
							else
								$content .= "<td class='section'>";
						}
						else if ($cellIndex == 5) {
							if ($cell->nodeValue == "Component") {
								$header = true;
								$content .= "<th class='component'>";
							}
							else
								$content .= "<td class='component'>";
						}
						else if ($cellIndex == 6) {
							if ($cell->nodeValue == "Units") {
								$header = true;
								$content .= "<th class='units'>";
							}
							else
								$content .= "<td class='units'>";
						}
						else if ($cellIndex == 7) {
							if ($cell->nodeValue == "Title") {
								$header = true;
								$content .= "<th class='title'>";
							}
							else
								$content .= "<td class='title'>";
						}
						else if ($cellIndex == 8) {
							if ($cell->nodeValue == "Days Taught") {
								$header = true;
								$content .= "<th class='days-taught'>";
							}
							else
								$content .= "<td class='days-taught'>";
						}
						else if ($cellIndex == 9) {
							if ($cell->nodeValue == "Time") {
								$header = true;
								$content .= "<th class='time'>";
							}
							else
								$content .= "<td class='time'>";
						}
						else if ($cellIndex == 10) {
							if ($cell->nodeValue == "Location") {
								$header = true;
								$content .= "<th class='location'>";
							}
							else
								$content .= "<td class='location'>";
						}
						else if ($cellIndex == 11) {
							if ($cell->nodeValue == "Class Attributes") {
								$header = true;
								$content .= "<th class='class-attributes'>";
							}
							else
								$content .= "<td class='class-attributes'>";
						}
						else if ($cellIndex == 12) {
							if ($cell->nodeValue == "Instructor") {
								$header = true;
								$content .= "<th class='instructor'>";
							}
							else
								$content .= "<td class='instructor'>";
						}
						else if ($cellIndex == 13) {
							if ($cell->nodeValue == "Feed Back") {
								$header = true;
								$content .= "<th class='feedback'>";
							}
							else
								$content .= "<td class='feedback'>";
						}
						else if ($cellIndex == 14) {
							if ($cell->nodeValue == "Pre Req") {
								$header = true;
								$content .= "<th class='pre-req'>";
							}
							else
								$content .= "<td class='pre-req'>";
						}
						else if ($cellIndex == 15) {
							if ($cell->nodeValue == "Fees") {
								$header = true;
								$content .= "<th class='fees'>";
							}
							else
								$content .= "<td class='fees'>";
						}
						$content .= $cell->nodeValue; 
						if ($header)
							$content .= "</th>";
						else
							$content .= "</td>";
						$cellIndex = $cellIndex + 1;
						// reset cellIndex if it goes past 15
						if ($cellIndex == 16)
							$cellIndex = 0;
					}
					$content .= "</tr>";
				}
				$content .= "</table>";
			}
		}
		else {
			echo '<script type="text/javascript">console.log("inputs bad")</script>';
		}
	}
	//$courses = getCourses();
?>
<!DOCTYPE html>
<html>
<head>
	<title>Course List</title>
	<link rel="stylesheet" href="../css/app.css">
	<link rel="stylesheet" href="../css/administrator.css">
	<script src="../js/app.js"></script>
	<meta name="description" content="Page for admins to view course list">
	<meta name="author" content="Ethan Hayes">
	<meta charset="UTF-8">
	<meta name="keywords" content="University, Utah, TA, Teaching, Assistant, Application">
</head>
<body>
	<?php require '../navmenu/adminNavMenu.php';?>

	<section class="content">
		<div class="description">
			<h1>Course Overview</h1>
			<p class="summary">
				On this page an administrator can see a list of all the courses
			</p>
		</div>
	</section>
	<div id="courseListForm" class="course-list">
			<form method="post" name="courseListForm" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
				<label class="no-indent">Please select the semester and year you would like to see a course list for:</label>
				<br/>
				<select name="semester" required>
					<option value="spring">Spring</option>
					<option value="summer">Summer</option>
					<option value="fall">Fall</option>
				</select>
				<select name="year" required>
					<script>
						var date = new Date();
						var year = date.getFullYear();
						for (year; year >= 1998; year--) {
							var val = year.toString().substring(2);
							document.write('<option value="'+val+'">'+year+'</option>');
						}
					</script>
				</select>
				<br/>
				<input class="button" type="submit" value="Get Courses">
			</form>
			<?php 
				echo $content;
				/*foreach ($courses as $course) {
					echo "<li>";
					echo $course;
					echo "</li>";
				}*/
			?>
	</div>
</body>
</html>