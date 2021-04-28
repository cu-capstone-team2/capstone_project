<?php
check_user([ADMIN]);


//Initalizes dropdown data
$times_data = get_all_class_time();
$room_data = get_all_classrooms();
$days = get_all_days();
$durations = [55,75];
$courses = get_all_courses();
$instructor_data = get_all_advisors();


/*
	Validates class input form and returns errors.
	Validations:
	are all fields properly completed?
	are there any scheduling conflicts with other classes?
	is the instructor free to teach at this time?
*/
function validate_new_class($input){
	$errors = [];
	if (!isset($input['course_id']) || empty($input['course_id'])){
		$errors['course_id'] = "No course was selected";
	}
	if (!isset($input["day_id"]) || empty($input["day_id"])) {
		$errors["day_id"] = "No days were selected.";
	}
	if (!isset($input["dur_id"]) || empty($input["dur_id"])) {
		$errors["dur_id"] = "No class duration was selected.";
	}
	if (!isset($input["time_id"]) || empty($input["time_id"])) {
		$errors["time_id"] = "No timeslot was selected.";
	}
	if (!isset($input["room_id"]) || empty($input["room_id"])) {
		$errors["room_id"] = "No room was selected.";
	}
	if (!isset($input["faculty_id"]) || empty($input["faculty_id"])) {
		$errors["faculty_id"] = "No instructor was selected.";
	}

	if(empty($errors)){
		$classes = get_many_class_overlap($input["day_id"],$input["time_id"],$input["room_id"]);
		if(!empty($classes)){
			$errors["room_id"] = "Room overlaps with the following:<br>";
			foreach($classes as $class){
				$errors['room_id'] .= "CRN: {$class['class_id']}, {$class['course_name']}, {$class['time']}, {$class['days']}, {$class['room']}<BR>";
			}
		}
		$classes = get_many_class_faculty_overlap($input['faculty_id'], $input['day_id'],$input["time_id"]);
		if(!empty($classes)){
			$errors['faculty_id'] = "<BR>{$classes[0]['instructor']} already teaches classes at the following times:<br>";
			foreach($classes as $class){
				$errors['faculty_id'] .= "CRN: {$class['class_id']}, {$class['course_name']}, {$class['time']}, {$class['days']}, {$class['room']}";
			}
		}
	}

	return $errors;
}

$errors = [];
$input = [];
/*
	If no errors, class is added.
*/
if(isset($_POST["submit_new_class"])){
		$errors = validate_new_class($_POST);
		$input = clean_array($_POST);
		if(empty($errors)){
			insert_class($_POST["day_id"],$_POST["dur_id"],$_POST["time_id"],$_POST["room_id"],$_POST["course_id"],$_POST["faculty_id"]);
			echo "<h3 style='color:green'>Class created successfully.</h3>";
			$input = [];
		}
}
?>

<h1>Add Class</h1>
<hr>

<form method = "post" class="form">

	<?= show_error($errors,'overlaps') ?>
	<?= show_error($errors,'faculty_overlaps') ?>

	<div class="form-group">
		<label>Course:</label>
		<select <?= error_outline($errors, 'course_id') ?> name="course_id" id="" required>
			<option selected disabled hidden></option>
			<?php foreach($courses as $course): ?>
				<option <?= check_select($input,"course_id",$course["course_id"]) ?> value="<?= $course["course_id"] ?>"><?= $course["title"] ?> - <?= $course["course_name"] ?></option>
			<?php endforeach ?>
		</select>
		<?= show_error($errors,'course_id') ?>
	</div>

	<div class="form-group">
		<label>Days:</label>
		<select <?= error_outline($errors, 'day_id') ?> name="day_id" required>
			<option selected disabled hidden></option>
			<?php foreach ($days as $day): ?>
				<option <?= check_select($input,"day_id", $day) ?> value="<?= $day ?>"> <?php echo $day?> </option>
			<?php endforeach; ?>
		</select>
		<?= show_error($errors, 'day_id'); ?>
	</div>
	<div class="form-group">
		<label>Time:</label>
		<select <?= error_outline($errors, 'time_id') ?> name="time_id" required>
			<option selected disabled hidden></option>
			<?php foreach ($times_data as $timeslot): ?>
				<option <?= check_select($input,"time_id", $timeslot["time_id"]) ?> value="<?= $timeslot["time_id"] ?>"> <?php echo $timeslot["time"]?> </option>
			<?php endforeach; ?>
		</select>
		<?= show_error($errors, 'time_id'); ?>
	</div>
	<div class="form-group">
		<label>Duration:</label>
		<select <?= error_outline($errors, 'dur_id') ?> name="dur_id" required>
			<option selected disabled hidden></option>
			<?php foreach ($durations as $duration): ?>
				<option <?= check_select($input,"dur_id", $duration) ?> value="<?= strval($duration) ?>"> <?php echo strval($duration)?> minutes </option>
			<?php endforeach; ?>
		</select>
			<?= show_error($errors, 'dur_id'); ?>

	</div>

	<div class="form-group">
		<label>Location:</label>
		<select <?= error_outline($errors, 'room_id') ?> name="room_id" required>
			<option selected disabled hidden></option>
			<?php foreach ($room_data as $room): ?>
				<option <?= check_select($input,"room_id", $room["room_id"]) ?> value="<?= $room["room_id"] ?>"> <?php echo $room["building"]." ".$room["room_number"]?> </option>
			<?php endforeach; ?>
		</select>
			<?= show_error($errors, 'room_id'); ?>

	</div>

	<div class="form-group">
		<label>Instructor:</label>
		<select <?= error_outline($errors, 'faculty_id') ?> name="faculty_id" required>
			<option selected disabled hidden></option>
			<?php foreach ($instructor_data as $instructor): ?>
				<option <?= check_select($input,"faculty_id", $instructor["faculty_id"]) ?> value="<?= $instructor["faculty_id"] ?>"> <?php echo $instructor["full_name"]?> </option>
			<?php endforeach; ?>
		</select>
		<?= show_error($errors, 'faculty_id'); ?>
	</div>
		<input type="submit" name="submit_new_class">
</form>
