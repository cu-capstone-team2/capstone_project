<?php check_user([CHAIR, SECRETARY]) ?>

<?php
$student_id = isset($_GET["student_id"])? $_GET["student_id"] : "";
$student = get_student_by_id($student_id);
if(!$student){
		change_page("user.php");
}
/*
    Validates input form data and returns errors if any.
    Validations:
    Is advisor field completed?
*/
function validate_new_advisors($input){
	$errors = [];

	if(!isset($input['faculty_id']) || empty($input["faculty_id"])){
		$errors['faculty_id'] = "Advisor is Incorrect";
	}		
return $errors;
}

$errors = [];
$input = [];
/*
	If no errors, change is submitted.
*/
if(isset($_POST["submit_new_advisors"])){
		$errors = validate_new_advisors($_POST);
		if(empty($errors)){
			update_student_advisor($student_id, $_POST["faculty_id"]);
			$student = get_student_by_id($student_id);
			echo "<h3 style='color:green'>Advisor Changed!</h3>";
		}	
}

$advisors = get_all_advisors();//retreive all adivsors

?>
<h1>Change Advisor</h1>
<hr>
<div class="who">
	<h3>for <?= "{$student["student_firstname"]} {$student["student_lastname"]}" ?>, ID = <?= $student["student_id"] ?></h3>
</div>
<form method = "post" class="form">
	<div class="form-group">
		<label>New Advisor</label>
		<select <?= error_outline($errors, 'faculty_id') ?> name="faculty_id" required>
			<?php foreach ($advisors as $advisor): ?>
				<option value="<?= $advisor["faculty_id"]?>" <?=check_select($student,"faculty_id",$advisor["faculty_id"])?>>
					<?=$advisor["full_name"] ?> - Advises <?=$advisor["students"] ?> Student(s)
			</option>
		<?php endforeach; ?>
		</select>
		<?= show_error($errors, 'faculty_id') ?>
	</div>
	<input type="submit" name="submit_new_advisors">
</form>
