<?php

check_user([ADMIN]);

$class_id = isset($_GET["class_id"])? $_GET["class_id"] : "";

	$class = get_class_by_id($class_id);

	if(!$class){
		change_page("user.php");
	} else {
		echo var_dump($class);

	}

$times_data = get_all_class_time();
$room_data = get_all_classrooms();
$days = ["MW","TR","MTWR","F","SS","MR"];
$durations = [55,75];
$instructor_data = get_all_advisors();
function validate_new_class($input){
	$errors = [];
}
?>




<h3 style="color: red">UNDER CONSTRUCTION.</h3>
<h1>Edit Class</h1>
<hr>
<h3> <?php echo $class["course_name"] ?></h3>
<br>
<?php
if(isset($_POST["submit_edit_to_class"])){
		$errors = validate_new_class($_POST);
		if(empty($errors)){

		} else {

		}
}
?>

<form method = "post">
		<label>Days - Current: <?= $class["days"] ?> / New:</label>
		<select name="day_id" required>
			<?php foreach ($days as $day): ?>
				<option value="<?= $class["days"] ?>"> <?php echo $day?> </option>
			<?php endforeach; ?>
		</select>
		<br>
		<label>Timeslot - Current: <?= $class["time_id"] ?> / New:</label>
		<select name="time_id" required>
			<?php foreach ($times_data as $timeslot): ?>
				<option value="<?= $timeslot["time_id"] ?>"> <?php echo $timeslot["time"]?> </option>
			<?php endforeach; ?>
		</select>
		<br>
		<label>Duration - Current: <?= $class["minutes"] ?> / New:</label>
		<select name="dur_id" required>
			<?php foreach ($durations as $duration): ?>
				<option value="<?= strval($duration) ?>"> <?php echo strval($duration)?> </option>
			<?php endforeach; ?>
		</select>
		<br>
		<label>Location - Current: <?= $class["room_id"] ?> / New:</label>
		<select name="room_id" required>
			<?php foreach ($room_data as $room): ?>
				<option value="<?= $room["room_id"] ?>"> <?php echo $room["building"]." ".$room["room_number"]?> </option>
			<?php endforeach; ?>
		</select>
		<br>
		<label>Instructor - Current: <?= $class["instructor"] ?> / New:</label>
		<select name="instructor_id" required>
			<?php foreach ($instructor_data as $instructor): ?>
				<option value="<?= $instructor["faculty_id"] ?>"> <?php echo $instructor["full_name"]?> </option>
			<?php endforeach; ?>
		</select>
		<br>
		<input type="submit" name="submit_edit_to_class">
</form>
