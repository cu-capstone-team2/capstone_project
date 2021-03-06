<?php check_user([ADMIN,SECRETARY,STUDENT,INSTRUCTOR,CHAIR]) ?>

<?php

function verify_password($input){
	global $user, $role;
	$errors = [];
	
	if(!isset($input["old_password"]) || empty($input["old_password"])){
		$errors["old_password"] = "Old password is required";
	} else if(
		($role === STUDENT && !password_verify($input["old_password"], $user["student_password"]))
		||
		($role !== STUDENT && !password_verify($input["old_password"], $user["faculty_password"]))
		){
		$errors["old_password"] = "Old password is incorrect";
	}
	
	if(!isset($input["new_password"]) || empty($input["new_password"])){
		$errors["new_password"] = "New password is required";
	}
	
	if(!isset($input["confirm_password"]) || empty($input["confirm_password"])){
		$errors["confirm_password"] = "Confirm password is required";
	} else if(isset($input["new_password"]) && $input["confirm_password"] !== $input["new_password"]){
		$errors["new_password"] = "New password and confirmation do not match";
	} else if(isset($input["new_password"])){
		// make sure stringlength is at least 10 characters
		// one number, one capital letter, one special character required
		$np = $input["new_password"];
		$errors["new_password"] = "";
		if(strlen($np) < 10){
			$errors["new_password"] .= "New password must be at least 10 characters<br>";
		}
		// verify special characters, letters, and numbers
		
		if ( !preg_match("#[0-9]+#", $np) ) {
			$errors["new_password"] .= "New password must have 1 number<br>";
		}

		if ( !preg_match("#[a-z]+#", $np) ) {
			$errors["new_password"] .= "New password must have 1 lowercase letter<br>";
		}

		if ( !preg_match("#[A-Z]+#", $np) ) {
			$errors["new_password"] .= "New password must have 1 uppercase letter<br>";
		}

		if ( !preg_match("/[\'^£$%&*()}{@#~?><>,|=_+!-]/", $np) ) {
			$errors["new_password"] .= "New password must have 1 special character<br>";
		}
		
		
		if(empty($errors["new_password"])){
			unset($errors["new_password"]);
		}
	}
	
	return $errors;
}

$errors = [];
$input = [];

if(isset($_POST["submit_password"])){
	$errors = verify_password($_POST);
	$input = clean_array($_POST);
	if(empty($errors)){
		$new_password = PASSWORD_HASH($_POST["new_password"],PASSWORD_DEFAULT);
		if($role === STUDENT){
			update_student_password($user["student_id"],$new_password);
		} else{
			update_faculty_password($user["faculty_id"],$new_password);
		}
		echo "<h3 style='color: green'>Updated Password Successfully</h3>";
		$input = [];
	}
}

?>

<h1>Edit Info</h1>
<hr>

<h4>Change Password</h4>
<form method="post">

	<?= show_error($errors,"old_password") ?>
	<label>Old Password</label>
	<input type="password" name="old_password" value="<?= show_value($input,"old_password") ?>" />
	<br>
	
	<?= show_error($errors,"new_password") ?>
	<label>New Password</label>
	<input type="password" name="new_password" value="<?= show_value($input,"new_password") ?>" />
	<br>
	
	<?= show_error($errors,"confirm_password") ?>
	<label>Confirm Password</label>
	<input type="password" name="confirm_password" value="<?= show_value($input,"confirm_password") ?>" />
	<br>
	<input type="submit" name="submit_password" value="Update Password" />
</form>
