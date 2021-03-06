<?php check_user([CHAIR,INSTRUCTOR,SECRETARY]) ?>


<?php 


	$s_id = $_GET["student_id"];
	$student = get_student_by_id($s_id);
	$s_email = $student["student_email"];
	if (!$student) {
		change_page("user.php?feature=list_advisees");
		change_page("user.php?feature=list_students");

	}
	
	

?>


<h1>Contact Student</h1>
<hr>

<h2> <?php echo $student["full_name"]?></h2>
<h3> <?php echo "Student ID: ".$s_id?></h3>
<h3> <?php echo "Email: ".$s_email?></h3>

