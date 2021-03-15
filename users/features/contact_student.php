<?php check_user([CHAIR,INSTRUCTOR,SECRETARY]) ?>


<?php 

	$error = [];
	$input = [];
	$s_id = $_GET["student_id"];
	$student = get_student_by_id($s_id);
	$s_email = $student["student_email"];

	if (!$student) {
		change_page("user.php?feature=list_advisees");
		change_page("user.php?feature=list_students");

	}
	
function validate_contact_student($input){
	$errors = [];
	if(!isset($input['subject']) || empty($input['subject'])){
		$errors['subject'] = "Input in subject";
	}
	
	if(!isset($input['message']) || empty($input['message'])){
		$errors['message'] = "Input in message";
	}
	
	return $errors;
}

if(isset($_POST['submit_student'])){
	$error = validate_contact_student($_POST);

	if(empty($error)){
		mail($student['student_email'], $_POST['subject'],$_POST['message']);
		echo "Message was sent";
	}
	$input = clean_array($_POST);
}


?>


<h1>Contact Student</h1>
<hr>

<h2> <?php echo $student["full_name"]?></h2>
<h3> <?php echo "Student ID: ".$s_id?></h3>
<h3> <?php echo "Email: ".$s_email?></h3>


<form method="POST" action="">

	<?= show_error($error, 'subject') ?><br>
	Subject: <input type="text" name="subject" value="<?= show_value($input, 'subject')?>" ><br><br>
	<?= show_error($error, 'message') ?><br>
	Message: <textarea name="message"><?= show_value($input, 'message')?></textarea><br><br>
	<input type="submit" name="submit_student">

</form>