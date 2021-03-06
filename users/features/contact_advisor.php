<?php check_user([CHAIR,SECRETARY,STUDENT]) ?>
<h1>Contact Advisor</h1>
<hr>

<?php 
	$faculty_id = isset($_GET["faculty_id"])? $_GET["faculty_id"] : "";
	if($role === STUDENT){
   		$faculty_id =$user["faculty_id"];
	} 
	$faculty = get_faculty_by_id($faculty_id);


	function validate_contact_advisors($input){
		$errors = [];
	
 	 	if(!isset($input['subject']) || empty($input['subject'])){
     		$errors['subject']="subject is required";
		}

  		if(!isset($input['message'])){
     		$errors['message'] ="message is requires";
		}
	
       return $errors;
	}

	$errors = [];
	$input = [];


 	if(isset($_POST['submit_new_advisors'])){
    	$errors = validate_contact_advisors($_POST);
  		if(empty($errors)){
    		mail($faculty['faculty_email'],$_POST['subject'],$_POST['message']);
			echo "<h3 style='color:green'>Message Sent!</h3>";
  		}
		$input = clean_array($_POST);
 	}


?>

 <h3> Advisor : <?php echo $faculty["full_name"] ?>
 </h3>

<form method="post">

	<?=show_error($errors, "subject")?>
	subject:   <input type="text" name="subject"> <br>
	<?=show_error($errors, "message")?>
	Message : <textarea name="message"></textarea> <br>
        <input type="submit" name="submit_new_advisors">	 
	
</form>
 
   
