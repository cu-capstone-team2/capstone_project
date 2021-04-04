<?php check_user([INSTRUCTOR]) ?>

<?php

$chair = get_chair();
if(!$chair){
	change_page('user.php');
}
$error = [];
$input = [];

function validate_contact_chair($input){
	$errors = [];
	if(!isset($input['subject']) || empty($input['subject'])){
		$errors['subject'] = "Please input a subject";
	} else if(strlen($input['subject']) > 50){
		$errors['subject'] = "Subject is limited to 50 characters";
	}
	
	if(!isset($input['message']) || empty($input['message'])){
		$errors['message'] = "Please input a message";
	}
	
	return $errors;
}

if(isset($_POST['submit_new_chair'])){
	$error=validate_contact_chair($_POST);
	$input = clean_array($_POST);
	if(empty($error)){
		mail($chair['faculty_email'], $_POST['subject'],$_POST['message']);
		echo "<h3 style='color:green'>Message was sent</h3>";
		$input = [];
	}
}

?>

<h1>Contact Chair</h1>
<hr>

<div class="who">
	<h3>Chair: <?php echo $chair["full_name"] ?> </h3>
	<h3>Email: <?php echo $chair["faculty_email"] ?> </h3>
</div>

<form method="POST" class="form">

	<div class="form-group">
		<?= show_error($error, 'subject') ?> 
		<label>Subject</label>
		<input <?= error_outline($error, 'subject') ?> type="text" name="subject" value="<?= show_value($input, 'subject')?>" required >
	</div>
	<div class="form-group">
		<?= show_error($error, 'message') ?>
		<label>Message</label>
		<textarea id="comments" <?= error_outline($error, 'subject') ?> name="message" required><?= show_value($input, 'message')?></textarea>
	</div>

<input type="submit" name="submit_new_chair">

</form>

