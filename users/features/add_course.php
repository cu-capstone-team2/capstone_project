<?php check_user([ADMIN]) ?>
<?php

function validate_new_course($input){
  $errors = [];

  if(!isset($input['course_name']) || empty($input['course_name'])){
    $errors['course_name'] = "Course Name is Required";
  }else if(strlen($input['course_name']) > 50){
    $errors['course_name'] = "Max 50 characters for Course Name";
  }


  if(!isset($input['major_id']) || empty($input['major_id'])){
    $errors['major_id'] = "Subject is Required";
  }

  if(!isset($input['course_number']) || empty($input['course_number'])){
   $errors['course_number'] = "Course Number is Required";
 }else if(preg_match("#[a-z]+#", $input['course_number']) || 
          preg_match("#[A-Z]+#", $input['course_number']) || 
          preg_match("/[\'^£$%&*()}{@#~?><>,|=_+!-]/", $input['course_number'])){

    $errors['course_number'] = "Course Number can only contain Numbers";
 }

  if(!isset($input['credits'])|| empty ($input ['credits'])){
   $errors['credits'] = "Credits is required";
  }
  else if(preg_match("#[a-z]+#", $input['credits']) || 
          preg_match("#[A-Z]+#", $input['credits']) || 
          preg_match("/[\'^£$%&*()}{@#~?><>,|=_+!-]/", $input['credits'])){

    $errors['credits'] = "Credits can only contain Numbers";
  }
  else if((int)$input['credits'] <= 0 || (int)$input['credits'] > 5){
    $errors['credits'] = "Credits must be between 1 and 5";
  }
  
  if(isset($input['course_number']) && isset($input['major_id'])){
	$dupli_courses = get_courses_by_course_number($input['major_id'],$input['course_number']);
	if(!empty($dupli_courses)){
		$msg = "Course title interferes with the following courses: <BR>";
		foreach($dupli_courses as $this_course){
			$msg .= $this_course["course_title"] . ", " . $this_course["course_name"] . "<BR>";
		}
		$errors['dupli_courses'] = $msg;
		$errors['major_id'] = "";
		$errors['course_number'] = "";
	}
  }
  

  return $errors;
}

$input = [];
$errors = [];

if(isset($_POST["submit_course"])){
  $errors = validate_new_course($_POST);
    $input = clean_array($_POST);
  if(empty($errors)){
    insert_course($_POST["course_name"],$_POST["credits"], $_POST["course_number"],$_POST["major_id"]);	
    echo "<h3 style='color:green'>Course Added</h3>";
    $input = [];
  }
}

?>

<h1>Add Course</h1>
<hr>

<form method="post" class="form">

	<?= show_error($errors,'dupli_courses') ?>

  <div class="form-group">
    <label>Course Name</label>
    <input <?=error_outline($errors,"course_name")?> type="text" name="course_name" value="<?=show_value($input,"course_name")?>" required>
    <?= show_error($errors, "course_name") ?>
  </div>
  <div class="form-group">
    <label>Subject</label>
    <select <?= error_outline($errors,"major_id") ?> name="major_id" required>
		<option disabled hidden selected></option>
		<?php $subjects = get_all_majors(); ?>
		<?php foreach($subjects as $subject): ?>
			<option <?= check_select($input,"major_id",$subject["major_id"])?> value="<?= $subject["major_id"] ?>"><?= $subject["short_name"] ?> - <?= $subject["major_name"] ?></option>
		<?php endforeach ?>
	</select>
	<?= show_error($errors, "major_id") ?>

	
  </div>
  <div class="form-group">
    <label>Course Number</label>
    <input <?=error_outline($errors,"course_number")?> type="text" name="course_number" value="<?=show_value($input,"course_number")?>" required>
    <?= show_error($errors, "course_number") ?> 
 </div>

<div class="form-group">
    <label>Credits</label>
    <input <?=error_outline($errors,"credits")?> type="text" name="credits" value="<?=show_value($input,"credits")?>" required>
    <?= show_error($errors, "credits") ?>
</div>

  <input type="submit" name="submit_course">
</form>
