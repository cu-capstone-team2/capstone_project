<?php
/****************************************************************
		
		******** RESET PASSWORD VERIFY PAGE ********
		



****************************************************************/

$user = false;

function validate_reset_password($input){//This function validates that the requestor has a vaild account
  global $user;
  $errors = [];

  if(!isset($_POST["username"]) || empty($_POST["username"])){
    $errors["reset"] = "All fields are required";
  }
  if(!isset($_POST["email"]) || empty($_POST["email"])){
    $errors["reset"] = "All fields are required";
  }
  if(!isset($_POST["role"]) || empty($_POST["role"])){
    $errors["reset"] = "All fields are required";
  }

  if(!empty($errors)) return $errors;

  $user = false;
  if($_POST["role"] === "student")
    $user = get_student_by_username($_POST["username"]);
  else if($_POST["role"] === "faculty")
    $user = get_faculty_by_username($_POST["username"]);
  
  if(!$user){
    $errors["reset"] = "Something went wrong";
  } else{
    $email = $_POST["role"] === "student"? $user["student_email"] : $user["faculty_email"];
    if($email !== $_POST["email"]){
      $errors["reset"] = "Something went wrong";
      $user = false;
    }
  }
  return $errors;
}

$errors = [];
$input = [];

if(isset($_POST["submit_reset_password"])){//checks to make sure no errors then email a temporary password to user
  $errors = validate_reset_password($_POST);
  if(empty($errors)){
    $key = generate_reset_password_key();
    $is_student = isset($user["student_id"]);
    $id = $is_student? $user["student_id"] : $user["faculty_id"];
    insert_reset_password($key, $id, $is_student);
    mail($_POST["email"], "Password Reset", "
      Link to reset your password:
      ada.cameron.edu/~team2/project/reset_password.php?key={$key}
    ");
  }
  $input = clean_array($_POST);
}

?>

<div class="form__login login">
    <?php if(!$user): ?>
    <?= show_error($errors,"reset") ?>
    <h1>Reset Password</h1>
    <form action="<?= action() ?>" method="POST">

        <div class="container__input">
            <input type="text" name="username" value="<?= show_value($input,'username') ?>" value="" autocomplete="off" required />
            <label>Username</label>
        </div>
        <div class="container__input">
            <input type="email" name="email" value="<?= show_value($input,"email") ?>" autocomplete="off" required />
            <label>Email</label>
        </div>
        <div class="container__select">
            <select name="role" required>
                <option hidden disabled selected></option>
                <option value="student" <?= check_select($input,'role','student') ?>>Student</option>
                <option value="faculty" <?= check_select($input,'role','faculty') ?>>Faculty/Staff</option>
            </select>
            <label>Role</label>
        </div>
        <input type="submit" name="submit_reset_password" value="Submit">
    </form>
    <?php else: ?>
    <h1>Reset Password Link Sent</h1>
    <p>A link was sent to your email, to reset your password.</p>
    <?php endif ?>
</div>

<script>
document.querySelector('input').focus();
</script>