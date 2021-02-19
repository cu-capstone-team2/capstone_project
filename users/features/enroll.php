<?php check_user([CHAIR,INSTRUCTOR,STUDENT]) ?>
<h1>Enroll</h1>
<?php 
	$s_id = $_GET["student_id"];
	$student = get_student_by_id($s_id);
	if (!$student) {
		change_page("user.php?feature=list_advisees");
	}
?>
<br>
<h2> <?php echo $student["full_name"]?></h2>
<h3> <?php echo "Student ID: ".$s_id?></h3>
