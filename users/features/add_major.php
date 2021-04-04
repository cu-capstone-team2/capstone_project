<?php check_user([ADMIN]);

function validate_new_major($input){
  $errors = [];

  if(!isset($input['major_name']) || empty($input['major_name'])){
    $errors['major_name'] = "Major Name is Required";
  }else if(!ctype_alpha($input['major_name'])){
      $errors["major_name"] = "Major Name can only contain characters";
  }else if(strlen($input['major_name']) > 25){
    $errors['major_name'] = "Max 25 characters for Major Name";
  }

  if(!isset($input['short_name']) || empty($input['short_name'])){
      $errors['short_name'] = "Short Name Required";
  }else if(!ctype_alpha($input['short_name'])){
      $errors["short_name"] = "Short Name can only contain characters";
  }else if(strlen($input['short_name']) > 4){
      $errors["short_name"] = "Max 4 characters for Abbreviation";
  }

  return $errors;
}

$input = [];
$errors = [];

if(isset($_POST["submit_major"])){
  $errors = validate_new_major($_POST);
  $input = clean_array($_POST);
  if(empty($errors)){
    insert_major($_POST["major_name"],$_POST["short_name"]);
    echo "<h3 style:'color:green'>Major Added!</h3>";
    echo "<a href='user.php?featur=list_major' style='color:green'>Go back to Major</a>";
  }
  $input = [];
}

?>
<h1>Add Major</h1>
<hr>

<form method="post" class="form">
  <div class="form-group">
    <label>Major Name</label>
    <input <?=error_outline($errors,"major_name")?> type="text" name="major_name"<?=show_value($input,"major_name")?> required>
    <?= show_error($errors, "major_name") ?>
  </div>

  <div class="form-group">
    <label>Abbreviation</label>
    <input <?=error_outline($errors,"short_name")?> type="text" name="short_name"<?=show_value($input,"short_name")?> required>
    <?= show_error($errors, "short_name") ?>
  </div>
  <input type="submit" name="submit_major">
</form>