<?php check_user([CHAIR,INSTRUCTOR,SECRETARY]) ?>


<?php 

	$error = [];
	$input = [];
	$s_id = isset($_GET["student_id"])? $_GET["student_id"] : "";
	$student = get_student_by_id($s_id);

	if (!$student) {
		change_page("user.php");
	}

	$s_email = $student["student_email"];
	
function validate_contact_student($input){
	$errors = [];
	if(!isset($input['subject']) || empty($input['subject'])){
		$errors['subject'] = "Subject is required";
	} else if(strlen($input['subject']) > 50){
		$errors['subject'] = "Subject limited to 50 characters";
	}
	if(!isset($input['message']) || empty($input['message'])){
		$errors['message'] = "Message is required";
	}
	return $errors;
}

if(isset($_POST['submit_student'])){
	$error = validate_contact_student($_POST);

	$input = clean_array($_POST);
	if(empty($error)){
		mail($student['student_email'], $_POST['subject'],$_POST['message']);
		echo "<h3 style='color: green'>Message was sent</h3>";
		$input = [];
	}
}


?>


<h1>Contact Student</h1>
<hr>


<div class="who">
	<h3> <?php echo "Student ID: ".$s_id?></h3>
	<h2>Name: <?php echo $student["full_name"]?></h2>
	<h3><?php echo "Email: ".$s_email?></h3>
</div>



<form method="POST" action="" class="form">
	<div class="form-group">
		<label>Subject</label>
		<input <?= error_outline($error, "subject") ?> type="text" name="subject" value="<?= show_value($input, 'subject')?>" required>
		<?= show_error($error, 'subject') ?>
	</div>
	<div class="form-group">
		<label>Message</label>
		<textarea <?= error_outline($error, "message") ?> id="comments" name="message" required><?= show_value($input, 'message')?></textarea>
		<?= show_error($error, 'message') ?>
	</div>

	<input type="submit" name="submit_student">
</form>

