<!--
	Author: Ethan Hayes
	Date: 2015
-->
<nav class="fixed-nav-bar">
	<div id="menu" class="menu">
		<h2 class="sitename">TA Hub</h2>
		<ul class="menu-items">
			<li><a href="/index.html">Home</a></li> |
			<li><a href="/Projects/TA3/instructor/instructor.php">Instructor Main</a></li> |
			<li><a href="/Projects/TA3/instructor/taEval.php">TA Evaluation</a></li> |
			<li><?php echo $_SESSION['name'] ?></li> - 
			<li><a href="/Projects/TA3/logout.php">Logout</a></li>
		</ul>
	</div>
</nav>