<?php 

// connect to database, authentication functions, and common functions
require_once("includes/all.php");

// allows logout the user on homepage
logout();

?>

<?php require_once("partials/home/header.php") ?>
	<a href="apply.php" class="apply-format">Apply Now!</a>
	<br>
    <div class="welcome_image"></div>
	<br>
	<br>
	<div class="welcome">
		<div class="welcome_text">
            College Enrollment System
        </div>
	<br>	
    </div>
<?php require_once("partials/home/footer.php") ?>
