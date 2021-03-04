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
	if(!isset($input['faculty_id'])){
		$errors['faculty_id'] = "contact advisor";
	}
	return $errors;
}


?>
 <h3> Advisor : <?php echo $faculty["full_name"] ?>
 </h3>

<form method="POST" action="">
	subject:   <input type="text" name="subject"> <br>
	Message : <textarea name="message "></textarea> <br>
        <input type="submit" name="submit_new_advisors">	 
	
</form>
 
   
