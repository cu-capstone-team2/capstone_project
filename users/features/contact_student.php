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
		$errors['subject'] = "Subject is required";
	}
	
	if(!isset($input['message']) || empty($input['message'])){
		$errors['message'] = "Message is required";
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


<div class="who">
	<h2> <?php echo $student["full_name"]?></h2>
	<h3> <?php echo "Student ID: ".$s_id?></h3>
	<h3> <?php echo "Email: ".$s_email?></h3>
</div>



<form method="POST" action="" class="form">

	<div class="form-group">
		<label>Subject</label>
		<input <?= error_outline($error, "subject") ?> type="text" name="subject" value="<?= show_value($input, 'subject')?>" required>
		<?= show_error($error, 'subject') ?>
	</div>

	<div class="form-group">
		<label>Message (Max: 255)</label>
		<textarea <?= error_outline($error, "message") ?> id="comments" name="message" required><?= show_value($input, 'message')?></textarea>
		<p>Character Count: <span id="char-count">0</span></p>
		<?= show_error($error, 'message') ?>
	</div>

	<input type="submit" name="submit_student">
</form>

<script>
const charCount = document.querySelector('#char-count');
const comments = document.querySelector('#comments');

const updateCharCount = (e) => {
    if(comments.value.length > 255){
        comments.value = comments.value.substring(0,255);
    }
    charCount.innerHTML = comments.value.length;
}

updateCharCount();
comments.oninput = updateCharCount;


</script>