<?php check_user([ADMIN]) ?>
<h1>Edit Course</h1>
<hr>
<?php


 $course_id  =  isset($_GET["course_id"])? $_GET["course_id"] : "";
 $course = get_course_by_id($course_id);
 
  if(!$course)
		change_page('user.php');


function validate_edit_course($input){
  $errors = [];

  if(!isset($input['course_name']) || empty($input['course_name'])){
    $errors['course_name'] = "course Name is Required";
  }
  if(!isset($input['course_number']) || empty($input['course_number'])){
   $errors['course_number'] ="course_Number is Required";
 }  
  if(!isset($input['credits'])|| empty ($input ['credits'])){

   $errors['credits'] ="credits is required";

  }
  return $errors;
}

$input = [];
$errors = [];

if(isset($_POST["submit_course"])){
  $errors =  validate_edit_course($_POST);
  if(empty($errors)){
    update_course_details($_GET["course_id"], $_POST["course_name"],$_POST["credits"], $_POST["course_number"],$_POST["major_id"]);
	 $course = get_course_by_id($course_id);
    echo "<h3 style:'color:green'>course Added!</h3>";
  }
}

?>


<form method="post" class="form">
  <div class="form-group">
    <label>course Name</label>
  
      
    <input <?=error_outline($errors,"course_name")?> type="text" name="course_name" value = "<?=show_value($course,"course_name")?>" required>
    <?= show_error($errors, "course_name") ?>
  </div>
  <div class="form-group">
    <label>Subject</label>
    <select name="major_id">
		<option disabled hidden selected></option>
		<?php $subjects = get_all_majors(); ?>
		<?php foreach($subjects as $subject): ?>
			<option <?= check_select($course,"major_id",$subject["major_id"])?> value="<?= $subject["major_id"] ?>"><?= $subject["short_name"] ?> - <?= $subject["major_name"] ?></option>
		<?php endforeach ?>
	</select>
	<?= show_error($errors, "major_id") ?>

	
  </div>
  <div class="form-group">
    <label>course_number</label>
    <input <?=error_outline($errors,"course_number")?> type="text" name="course_number" value = "<?=show_value($course,"course_number")?>" required>
    <?= show_error($errors, "course_number") ?> 
 </div>

<div class="form-group">
    <label>credits</label>
    <input <?=error_outline($errors,"credits")?> type="text" name="credits" value = "<?=show_value($course,"credits")?>" required>
    <?= show_error($errors, "credits") ?>
</div>

  <input type="submit" name="submit_course">
</form>
