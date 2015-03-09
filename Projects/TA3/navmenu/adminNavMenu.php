<!--
	Author: Ethan Hayes
	Date: 2015
-->
<nav class="fixed-nav-bar">
	<div id="menu" class="menu">
		<h2 class="sitename">TA Hub</h2>
		<ul class="menu-items">
			<li><a href="/index.html">Home</a></li> |
			<li><a href="/Projects/TA3/admin/courseList.php">Course Overview</a></li> |
			<li><a href="/Projects/TA3/admin/applicantList.php">Applicant Overview</a></li> |
			<li><a href="/Projects/TA3/admin/taList.php">TA Overview</a></li> |
			<li><?php echo $_SESSION['name'] ?></li> - 
			<li><a href="/Projects/TA3/logout.php">Logout</a></li>
		</ul>
	</div>
</nav>