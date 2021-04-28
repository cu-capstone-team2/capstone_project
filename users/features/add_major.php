<?php check_user([ADMIN]);


/*
  Validates the major input form data and returns errors if any.
  Validations:
  Are all inputs complete?
  Are all inputs sanitized?
  Are character limits respected?
  Are inputs unique?
*/
function validate_new_major($input){
  $errors = [];

  if(!isset($input['major_name']) || empty($input['major_name'])){
    $errors['major_name'] = "Major Name is Required";
  }else if(!ctype_alpha(str_replace(' ', '', $input["major_name"]))){
      $errors["major_name"] = "Major Name can only contain characters";
  }else if(strlen($input['major_name']) > 50){
    $errors['major_name'] = "Max 50 characters for Major Name";
  } else{
    $majors = get_majors_by_major_name($input['major_name']);
    if(!empty($majors)){
      $errors['major_name'] = "Major name is taken";
    }
  }

  if(!isset($input['short_name']) || empty($input['short_name'])){
      $errors['short_name'] = "Short Name Required";
  }else if(!ctype_alpha($input['short_name'])){
      $errors["short_name"] = "Short Name can only contain characters";
  }else if(strlen($input['short_name']) > 4){
      $errors["short_name"] = "Max 4 characters for Abbreviation";
  } else{
    $majors = get_majors_by_short_name($input['short_name']);
    if(!empty($majors)){
      $errors['short_name'] = "Abbreviation is taken";
    }
  }

  return $errors;
}

$input = [];
$errors = [];
// If no errors detected, adds major.
if(isset($_POST["submit_major"])){
  $errors = validate_new_major($_POST);
  $input = clean_array($_POST);
  if(empty($errors)){
    insert_major($_POST["major_name"],$_POST["short_name"]);
    echo "<h3 style='color:green'>Major Added!</h3>";
	$input = [];
  }
}

?>
<h1>Add Major</h1>
<hr>

<form method="post" class="form">
  <div class="form-group">
    <label>Major Name</label>
    <input <?=error_outline($errors,"major_name")?> type="text" name="major_name" value="<?=show_value($input,"major_name")?>" required>
    <?= show_error($errors, "major_name") ?>
  </div>

  <div class="form-group">
    <label>Abbreviation</label>
    <input <?=error_outline($errors,"short_name")?> type="text" name="short_name" value="<?=show_value($input,"short_name")?>" required>
    <?= show_error($errors, "short_name") ?>
  </div>
  <input type="submit" name="submit_major">
</form>