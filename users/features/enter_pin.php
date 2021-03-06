<?php check_user([STUDENT]) ?>
<h1>Enter Pin</h1>
<hr>

<?php

function validate_pin($input){
  global $user;
  $errors = [];

  if(!isset($input["PIN"])){
    $errors['PIN'] = "PIN is required";
  } else if($input["PIN"] !== $user["PIN"]){
    $errors["PIN"] = "PIN is incorrect";
  }

  return $errors;
}


$errors = [];
$input = [];
if(isset($_POST["submit_pin"])){
  $errors = validate_pin($_POST);
  if(empty($errors)){
    $_SESSION["PIN"] = true;
    change_page("user.php?feature=enroll");
  }
  $input = clean_array($_POST);
}

?>


<form method="POST" class="form">
  <div class="form-group">
    <label>Your Enrollment PIN</label>
    <input <?= error_outline($errors, 'PIN') ?> type="password" name="PIN" value="<?= show_value($input,"PIN") ?>" required/>
    <?= show_error($errors,'PIN') ?>
  </div>
  <input type="submit" name="submit_pin" />
</form>
