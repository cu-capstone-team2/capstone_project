<?php check_user([CHAIR,SECRETARY,STUDENT]) ?>

<?php 
	$faculty_id = isset($_GET["faculty_id"])? $_GET["faculty_id"] : "";
	if($role === STUDENT){
   		$faculty_id =$user["faculty_id"];
	} 
	$faculty = get_faculty_by_id($faculty_id);
	if(!$faculty){
		change_page("user.php");
	}
	/*
        Validates input form data and returns errors if any.
        Validations:
        Are fields complete?
        Are input lengths respected?
        Are inputs sanitized?
    */
	function validate_contact_advisors($input){
		$errors = [];
		if(!isset($input['subject']) || empty($input['subject'])){
			$errors['subject']="subject is required";
		} else if(strlen($input['subject']) > 50){
			$errors['subject'] = 'Subject limited to 50 characters';
		}
		if(!isset($input['message']) || empty($input['message'])){
			$errors['message'] ="message is required";
		}
		return $errors;
	}

	$errors = [];
	$input = [];

	//If no errors detected, send email to advisor.
 	if(isset($_POST['submit_new_email'])){
		$input = clean_array($_POST);
    	$errors = validate_contact_advisors($_POST);

  		if(empty($errors)){
    		mail($faculty['faculty_email'],$_POST['subject'],$_POST['message']);
				echo "<h3 style='color:green'>Message Sent!</h3>";
			$input = [];
  		}
 	}


?>

<h1>Contact Advisor</h1>
<hr>

<div class="who">
	<?php if($role !== STUDENT): ?>
	<h3>ID : <?php echo $faculty["faculty_id"] ?></h3>

	<?php endif ?>
 <h3> Advisor : <?php echo $faculty["full_name"] ?></h3>
	<h3>Email: <?php echo $faculty["faculty_email"] ?></h3>
</div>

<form method="post" class='form'>

	 <div class="form-group">
		 <label>Subject</label>
		<input value="<?=show_value($input,"subject")?>" <?= error_outline($errors,'subject') ?> type="text" name="subject" required>
		<?=show_error($errors, "subject")?>
	</div>

	<div class="form-group">
		<label>Message</label>
		<textarea <?= error_outline($errors,'message') ?> name="message" required><?=show_value($input,"message")?></textarea>
		<?=show_error($errors, "message")?>
	</div>

        <input type="submit" name="submit_new_email">	 
	
</form>
 
   
