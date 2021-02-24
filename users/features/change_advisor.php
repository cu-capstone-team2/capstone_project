<?php check_user([CHAIR, SECRETARY]) ?>

<?php
$student_id = isset($_GET["student_id"])? $_GET["student_id"] : "";
$student = get_student_by_id($student_id);
if(!$student){
		change_page("user.php?feature=list_students");
}
$advisors = get_all_advisors();//retreive all adivsors

function validate_new_advisors($input){
	$errors = [];
	if(!isset($input['faculty_id'])){
		$errors['faculty_id'] = "Advisor is Incorrect";
	}
	return $errors;
}

$errors = [];
$input = [];

if(isset($_POST["submit_new_advisors"])){
		$errors = validate_new_advisors($_POST);
		if(empty($errors)){
			update_student_advisor($student_id, $_POST["faculty_id"]);
			$student = get_student_by_id($student_id);
			echo "<h3 style='color:green'>Advisor Changed!</h3>";
			echo "<a href = 'user.php?feature=list_students'>Go back to Students";
		}
}

?>
<h1>Change Advisor</h1>
<hr>
<h3>for <?= "{$student["student_firstname"]} {$student["student_lastname"]}" ?>, ID = <?= $student["student_id"] ?></h3>
<form method = "post">
	<label>New Advisor</label>
	<select name="faculty_id" required>
		<?php foreach ($advisors as $advisor): ?>
			<option value="<?= $advisor["faculty_id"]?>" <?=check_select($student,"faculty_id",$advisor["faculty_id"])?>>
			 <?=$advisor["full_name"] ?>
		</option>
	<?php endforeach; ?>
	</select>
	<input type="submit" name="submit_new_advisors">
</form>
