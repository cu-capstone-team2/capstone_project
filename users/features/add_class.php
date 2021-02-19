<?php 

check_user([ADMIN]);

$course_id = isset($_GET["course_id"])? $_GET["course_id"] : "";

	$course = get_course_by_id($course_id);

	if(!$course){
		change_page("user.php");
	}

$courses = get_all_courses($course_id);


?>


<h1>Add Class</h1>
<h3> <?php echo $course["course_name"] ?></h3>
