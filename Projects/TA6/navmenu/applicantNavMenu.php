<!--
	Author: Ethan Hayes
	Date: 2015
-->
<nav class="fixed-nav-bar">
	<div id="menu" class="menu">
		<h2 class="sitename">TA Hub</h2>
		<ul class="menu-items">
			<li><a href="/index.html">Home</a></li> |
			<li><a href="/Projects/TA6/index.php">Hub</a></li> |
			<li><a href="/Projects/TA6/applicant/index.php">Applicant Main</a></li> |
			<li><a href="/Projects/TA6/applicant/form.php">Application Form</a></li> |
			<li><?php echo $_SESSION['user']->getName() ?></li> - 
			<li><a href="/Projects/TA6/logout.php">Logout</a></li>
		</ul>
	</div>
</nav>