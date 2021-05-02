<?php

$key;

if(isset($_GET["key"])){//makes sure that gets the as a key if not returns to homepage
  $key = get_reset_password_by_key($_GET["key"]);
  if(!$key){
    change_page("index.php");
  }
} else{
  change_page("index.php");
}

function verify_password($input){//This function verify that new password 
	$errors = [];

	
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
			$errors["new_password"] .= "Password must be at least 10 characters<br>";
		}
		// verify special characters, letters, and numbers
		
		if ( !preg_match("#[0-9]+#", $np) ) {
			$errors["new_password"] .= "Password must have 1 number<br>";
		}

		if ( !preg_match("#[a-z]+#", $np) ) {
			$errors["new_password"] .= "Password must have 1 lowercase letter<br>";
		}

		if ( !preg_match("#[A-Z]+#", $np) ) {
			$errors["new_password"] .= "Password must have 1 uppercase letter<br>";
		}

		if ( !preg_match("/[\'^£$%&*()}{@#~?><>,|=_+!-]/", $np) ) {
			$errors["new_password"] .= "Password must have 1 special character<br>";
		}
		
		
		if(empty($errors["new_password"])){
			unset($errors["new_password"]);
		}
	}
	
	return $errors;
}

$errors = [];
$input = [];
$success = false;
// if no errors, then update password, else show errors
if(isset($_POST["submit_new_password"])){
  $errors = verify_password($_POST);
  if(empty($errors)){
    $input = [];
    $hash_password = password_hash($_POST["new_password"], PASSWORD_DEFAULT);
    if($key["student_id"] == 0){
      update_faculty_password($key["faculty_id"], $hash_password);
      delete_password_reset($key["faculty_id"], 0);
    } else{
      update_student_password($key["student_id"], $hash_password);
      delete_password_reset($key["student_id"], 1);
    }
    $success = true;
  } else{
    $input = clean_array($_POST);
  }
}
?>

<div class="form__login login">
  <?php if($success): ?>
    <h3>Successfully changed password</h3>
    <a href="login.php">Click here to login</a>
  <?php else: ?>
  <h1>Reset Password</h1>
  <?= show_error($errors,"new_password") ?>
  <?= show_error($errors,"confirm_password") ?>

  <form method="POST">
      <div class="container__input">
          <input type="password" name="new_password" value="<?= show_value($input,"new_password") ?>" autocomplete="off" required />
          <label>New Password</label>
      </div>
      <div class="container__input">
          <input type="password" name="confirm_password" value="<?= show_value($input,"confirm_password") ?>" autocomplete="off" required />
          <label>Confirm Password</label>
      </div>
      <input type="submit" name="submit_new_password" value="Update Password">
  </form>
  <?php endif ?>
</div>

<script>
document.querySelector('input').focus();
</script>