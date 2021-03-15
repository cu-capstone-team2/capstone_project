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
	if (empty($_POST["day_id"])) {
		$errors["day"] = "No days were selected.";
	}
	if (empty($_POST["dur_id"])) {
		$errors["dur_id"] = "No class duration was selected.";
	}
	if (empty($_POST["time_id"])) {
		$errors["time"] = "No timeslot was selected.";
	}
	if (empty($_POST["room_id"])) {
		$errors["room"] = "No room was selected.";
	}
	if (empty($_POST["instructor_id"])) {
		$errors["inst"] = "No instructor was selected.";
	}
	return $errors;
}
?>






<h1>Add Class</h1>
<hr>
<h3> <?php echo $course["course_name"] ?></h3>
<br>
<h3> <?php echo "Course ID: ".$course["course_id"] ?></h3>
<?php
if(isset($_POST["submit_new_class"])){
		$errors = validate_new_class($_POST);
		if(empty($errors)){
			insert_class($_POST["day_id"],$_POST["dur_id"],$_POST["time_id"],$_POST["room_id"],$course["course_id"],$_POST["instructor_id"]);
			echo "Class created successfully.";
		} else {
			echo "ERROR";
			foreach ($errors as $error) {
				show_error($errors,$error);
			}
		}
}
?>

<form method = "post">
		<label>Days:</label>
		<select name="day_id" required>
			<?php foreach ($days as $day): ?>
				<option value="<?= $day ?>"> <?php echo $day?> </option>
			<?php endforeach; ?>
		</select>
		<br>
		<label>Timeslot:</label>
		<select name="time_id" required>
			<?php foreach ($times_data as $timeslot): ?>
				<option value="<?= $timeslot["time_id"] ?>"> <?php echo $timeslot["time"]?> </option>
			<?php endforeach; ?>
		</select>
		<br>
		<label>Duration:</label>
		<select name="dur_id" required>
			<?php foreach ($durations as $duration): ?>
				<option value="<?= strval($duration) ?>"> <?php echo strval($duration)?> </option>
			<?php endforeach; ?>
		</select>
		<br>
		<label>Location:</label>
		<select name="room_id" required>
			<?php foreach ($room_data as $room): ?>
				<option value="<?= $room["room_id"] ?>"> <?php echo $room["building"]." ".$room["room_number"]?> </option>
			<?php endforeach; ?>
		</select>
		<br>
		<label>Instructor:</label>
		<select name="instructor_id" required>
			<?php foreach ($instructor_data as $instructor): ?>
				<option value="<?= $instructor["faculty_id"] ?>"> <?php echo $instructor["full_name"]?> </option>
			<?php endforeach; ?>
		</select>
		<br>
		<input type="submit" name="submit_new_class">
</form>
