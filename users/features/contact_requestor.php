<?php check_user([ADMIN])?>

<?php

	$error = [];
	$input = [];
	
	
		
	if(isset($_GET["apply_id"])){
		$r_id = $_GET["apply_id"];
			$request = get_apply_info($r_id);
			$r_email = $request["email"];
	
	}else if(isset($_GET["contact_id"])){
		$r_id = $_GET["contact_id"];
		$request = get_contact_info($r_id);
		$r_email = $request["email"];
	} else{
		change_page('user.php');
	}

	if(!$request)
		change_page('user.php');


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

	$input = clean_array($_POST);
	if(empty($error)){
		mail($request['email'], $_POST['subject'],$_POST['message']);
		echo "<h3 style='color: green'>Message was sent</h3>";
		$input = [];
	}
}


?>


<h1>Contact Requestor</h1>
<hr>

<div class="who">
	<h2> <?php echo $request["full_name"]?></h2>
	<h3> <?php echo "Email: ".$r_email?></h3>
</div>



<form method="POST" action="" class="form">
<div class="form-group">
	<label>Subject</label>
	<input <?= error_outline($error, "subject") ?> type="text" name="subject" value="<?= show_value($input, 'subject')?>" required>
	<?= show_error($error, 'subject') ?>
</div>

<div class="form-group">
	<label>Message</label>
	<textarea <?= error_outline($error,"message") ?> id="message" name="message" required><?= show_value($input, 'message')?></textarea>
	<?= show_error($error, 'message') ?>
</div>



	<input type="submit" name="submit_requestor">

</form>

