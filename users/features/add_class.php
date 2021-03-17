<?php

check_user([ADMIN]);

$course_id = isset($_GET["course_id"])? $_GET["course_id"] : "";

	$course = get_course_by_id($course_id);

	if(!$course){
		change_page("user.php");
	}

$times_data = get_all_class_time();
$room_data = get_all_classrooms();
$days = ["MW","TR","MTWR","F","SS","MR"];
$durations = [55,75];



$instructor_data = get_all_advisors();
function validate_new_class($input){
	$errors = [];
	if (!isset($_POST["day_id"]) || empty($_POST["day_id"])) {
		$errors["day_id"] = "No days were selected.";
	}
	if (!isset($_POST["dur_id"]) || empty($_POST["dur_id"])) {
		$errors["dur_id"] = "No class duration was selected.";
	}
	if (!isset($_POST["time_id"]) || empty($_POST["time_id"])) {
		$errors["time_id"] = "No timeslot was selected.";
	}
	if (!isset($_POST["room_id"]) || empty($_POST["room_id"])) {
		$errors["room_id"] = "No room was selected.";
	}
	if (!isset($_POST["faculty_id"]) || empty($_POST["faculty_id"])) {
		$errors["faculty_id"] = "No instructor was selected.";
	}
	return $errors;
}
?>

<h1>Add Class</h1>
<hr>

<div class="who">
	<h3> <?php echo $course["course_name"] ?></h3>
	<h3> <?php echo "Course ID: ".$course["course_id"] ?></h3>
</div>


<?php

$errors = [];
$input = [];

if(isset($_POST["submit_new_class"])){
		$errors = validate_new_class($_POST);
		if(empty($errors)){
			insert_class($_POST["day_id"],$_POST["dur_id"],$_POST["time_id"],$_POST["room_id"],$course["course_id"],$_POST["faculty_id"]);
			echo "Class created successfully.";
		} else {
			foreach ($errors as $error) {
				show_error($errors,$error);
			}
		}
}
?>

<form method = "post" class="form">
	<div class="form-group">
		<label>Days:</label>
		<select <?= error_outline($errors, 'day_id') ?> name="day_id" required>
			<?php foreach ($days as $day): ?>
				<option value="<?= $day ?>"> <?php echo $day?> </option>
			<?php endforeach; ?>
		</select>
		<?= show_error($errors, 'day_id'); ?>
	</div>
	<div class="form-group">
		<label>Timeslot:</label>
		<select <?= error_outline($errors, 'time_id') ?> name="time_id" required>
			<?php foreach ($times_data as $timeslot): ?>
				<option value="<?= $timeslot["time_id"] ?>"> <?php echo $timeslot["time"]?> </option>
			<?php endforeach; ?>
		</select>
		<?= show_error($errors, 'time_id'); ?>
	</div>
	<div class="form-group">
		<label>Duration:</label>
		<select <?= error_outline($errors, 'dur_id') ?> name="dur_id" required>
			<?php foreach ($durations as $duration): ?>
				<option value="<?= strval($duration) ?>"> <?php echo strval($duration)?> </option>
			<?php endforeach; ?>
		</select>
			<?= show_error($errors, 'dur_id'); ?>

	</div>

	<div class="form-group">
		<label>Location:</label>
		<select <?= error_outline($errors, 'room_id') ?> name="room_id" required>
			<?php foreach ($room_data as $room): ?>
				<option value="<?= $room["room_id"] ?>"> <?php echo $room["building"]." ".$room["room_number"]?> </option>
			<?php endforeach; ?>
		</select>
			<?= show_error($errors, 'room_id'); ?>

	</div>

	<div class="form-group">
		<label>Instructor:</label>
		<select <?= error_outline($errors, 'faculty_id') ?> name="faculty_id" required>
			<?php foreach ($instructor_data as $instructor): ?>
				<option value="<?= $instructor["faculty_id"] ?>"> <?php echo $instructor["full_name"]?> </option>
			<?php endforeach; ?>
		</select>
		<?= show_error($errors, 'faculty_id'); ?>
	</div>
		<input type="submit" name="submit_new_class">
</form>
