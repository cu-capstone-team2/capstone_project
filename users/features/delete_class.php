<?php

check_user([ADMIN]);

$class_id = isset($_GET["class_id"])? $_GET["class_id"] : "";

$class = get_class_by_id($class_id);

if(!$class){
	change_page("user.php");
} else {

}

	$students = get_students_by_class($class["class_id"]);
	foreach ($students as $student) {
		//echo $student["full_name"]."=> id:".$student["student_id"]."<br>";
		delete_enrollment($student["student_id"], $class["class_id"]);
	}
	echo var_dump($students);
	if (empty(get_students_by_class($class["class_id"]))) {
		delete_class($class_id);
		change_page("user.php?feature=list_classes");
	}
?>



<p class='error'>UNDER CONSTRUCTION</p>
<h1>Delete Class</h1>
<hr>
<h3> <?php echo $class["course_name"] ?></h3>
<br>
<?php
	
?>
