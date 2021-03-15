<?php check_user([ADMIN])?>

<?php

	$error = [];
	$input = [];
	$r_id = $_GET["apply_id"];
	$request = get_apply_info($r_id);
	$r_email = $request["email"];


function validate_contact_requestor($input){
	$errors = [];
	if(!isset($input['subject']) || empty($input['subject'])){
		$errors['subject'] = "Input in subject";
	}

	if(!isset($input['message']) || empty($input['message'])){
		$errors['message'] = "Input in message";
	}

	return $errors;
}

if(isset($_POST['submit_requestor'])){
	$error = validate_contact_requestor($_POST);

	if(empty($error)){
				mail($request['email'], $_POST['subject'],$_POST['message']);
				echo "Message was sent";
	}
	$input = clean_array($_POST);
}


?>


<h1>Contact Requestor</h1>
<hr>

<h2> <?php echo $request["full_name"]?></h2>
<h3> <?php echo "Email: ".$r_email?></h3>


<form method="POST" action="">

	<?= show_error($error, 'subject') ?><br>
	Subject: <input type="text" name="subject" value="<?= show_value($input, 'subject')?>" ><br><br>
	<?= show_error($error, 'message') ?><br>
	Message: <textarea name="message"><?= show_value($input, 'message')?></textarea><br><br>
	<input type="submit" name="submit_requestor">

</form>
