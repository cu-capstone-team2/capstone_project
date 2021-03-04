<?php

check_user([ADMIN]);

$course_id = isset($_GET["course_id"])? $_GET["course_id"] : "";

	$course = get_course_by_id($course_id);

	if(!$course){
		change_page("user.php");
	}

$courses = get_all_courses($course_id);
$classes = get_all_classes();

function validate_new_class($input){
	$errors = [];



}


?>


<h1>Add Class</h1>
<hr>
<h3> <?php echo $course["course_name"] ?></h3>


<form method = "post">
		<?php foreach($courses as $courses): ?>
		<?php endforeach;?>
		




		<input type="submit" name="submit_new_class">
</form>
