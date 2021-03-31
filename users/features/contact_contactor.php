<?php check_user([ADMIN])?>

<?php

	$error = [];
	$input = [];
	


		$r_id = $_GET["contact_id"];
		$contact = get_contact_user($r_id);
		$r_email = $contact["email"];
	


function validate_contact_contactor($input){
	$errors = [];
	if(!isset($input['subject']) || empty($input['subject'])){
		$errors['subject'] = "Input in subject";
	}

	if(!isset($input['message']) || empty($input['message'])){
		$errors['message'] = "Input in message";
	}

	return $errors;
}

if(isset($_POST['submit_contactor'])){
	$error = validate_contact_contactor($_POST);

	if(empty($error)){
				mail($contact["email"], $_POST["subject"],$_POST["message"]);
				
				echo "Message was sent";
				close_contact($contact["ID"]);
	}
	$input = clean_array($_POST);
}


?>


<h1>Contact Requestor</h1>
<hr>

<div class="who">
	<h2> <?php echo $contact["full_name"]?></h2>
	<h3> <?php echo "Email: ".$r_email?></h3>
</div>



<form method="POST" action="" class="form">
<div class="form-group">
	<label>Subject</label>
	<input <?= error_outline($error, "subject") ?> type="text" name="subject" value="<?= show_value($input, 'subject')?>" >
	<?= show_error($error, 'subject') ?>
</div>

<div class="form-group">
	<label>Message (Max: 255)</label>
	<textarea <?= error_outline($error,"message") ?> id="message" name="message"><?= show_value($input, 'message')?></textarea>
	<p>Character Count: <span id="char-count">0</span></p>
	<?= show_error($error, 'message') ?>
</div>



	<input type="submit" name="submit_contactor">

</form>

<script>
const charCount = document.querySelector('#char-count');
const comments = document.querySelector('#message');

const updateCharCount = (e) => {
    if(comments.value.length > 255){
        comments.value = comments.value.substring(0,255);
    }
    charCount.innerHTML = comments.value.length;
}

updateCharCount();
comments.oninput = updateCharCount;


</script>
