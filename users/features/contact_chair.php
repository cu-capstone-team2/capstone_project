<?php check_user([INSTRUCTOR]) ?>
<h1>Contact Chair</h1>
<hr>

<?php

$chair = get_chair();
$error = [];
$input = [];

function validate_contact_chair($input){
	$errors = [];
	if(!isset($input['subject']) || empty($input['subject'])){
		$errors['subject'] = "Please input in subject";
	}
	
	if(!isset($input['message']) || empty($input['message'])){
		$errors['message'] = "Please input in message";
	}
	
	return $errors;
}

if(isset($_POST['submit_new_chair'])){
	$error=validate_contact_chair($_POST);
	if(empty($error)){
		mail($chair['faculty_email'], $_POST['subject'],$_POST['message']);
		echo "Message was sent";
	}
	$input = clean_array($_POST);
}

?>

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
		<label>Message (Max: 255)</label>
		<textarea id="comments" <?= error_outline($error, 'subject') ?> name="message" required><?= show_value($input, 'message')?></textarea>
		<p>Character Count: <span id="char-count">0</span></p>
	</div>

<input type="submit" name="submit_new_chair">

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