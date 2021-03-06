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

<h3> Chair: <?php echo $chair["full_name"] ?> </h3><br>
<h3> Email: <?php echo $chair["faculty_email"] ?> </h3><br>



<form method="POST" action="">


		<?= show_error($error, 'subject') ?> 
Subject: <input type="text" name="subject" value="<?= show_value($input, 'subject')?>" ><br><br>
		<?= show_error($error, 'message') ?>
Message: <textarea name="message"><?= show_value($input, 'message')?></textarea><br><br>
<input type="submit" name="submit_new_chair">

</form>