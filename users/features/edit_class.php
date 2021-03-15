<?php

check_user([ADMIN]);

$class_id = isset($_GET["class_id"])? $_GET["class_id"] : "";

	$class = get_class_by_id($class_id);

	if(!$class){
		change_page("user.php");
	} else {

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




<h1>Edit Class</h1>
<hr>
<h3> <?php echo $class["course_name"] ?></h3>
<br>
<?php
if(isset($_POST["submit_edit_to_class"])){
		echo var_dump($_POST);
		$errors = validate_new_class($_POST);
		if ($class["days"] != $_POST["days"]) {

			echo "<br>days changed";
		}
		if ($class["time_id"] != $_POST["time_id"]) {

			echo "<br>timeslot changed";
		}
		if ($class["minutes"] != $_POST["minutes"]) {

			echo "<br>duration changed";
		}
		if ($class["room_id"] != $_POST["room_id"]) {
			echo "<br>room changed";
		}
		if ($class["faculty_id"] != $_POST["faculty_id"]) {
			echo "<br>instructor changed:".$class["faculty_id"]." to ".$_POST["faculty_id"];

		}

		$attrs = [$_POST["days"],$_POST["time_id"],
		$_POST["minutes"],$_POST["room_id"],$_POST["faculty_id"]];
		echo var_dump($attrs);
		if(empty($errors)){
			update_class_details($class["class_id"], $attrs);
			change_page("user.php?feature=edit_class&class_id=".$class["class_id"]);
		} else {

		}
}
?>

<form method = "post">
		<label>Days - Current: <?= $class["days"] ?> / New:</label>
		<select name="days" required>
				<option value="<?= $class["days"] ?>"> <?php echo "Unchanged"?> </option>
			<?php foreach ($days as $day): ?>
				<option value="<?= $day ?>"> <?php echo $day?> </option>
			<?php endforeach; ?>
		</select>
		<br>
		<label>Timeslot - Current: <?= get_timeslot_by_id($class["time_id"])["time_"] ?> / New:</label>
		<select name="time_id" required>
			<option value="<?= $class["time_id"] ?>"> <?php echo "Unchanged"?> </option>
			<?php foreach ($times_data as $timeslot): ?>
				<option value="<?= $timeslot["time_id"] ?>"> <?php echo $timeslot["time"]?> </option>
			<?php endforeach; ?>
		</select>
		<br>
		<label>Duration - Current: <?= $class["minutes"] ?> / New:</label>
		<select name="minutes" required>
			<option value="<?= $class["minutes"] ?>"> <?php echo "Unchanged"?> </option>
			<?php foreach ($durations as $duration): ?>
				<option value="<?= strval($duration) ?>"> <?php echo strval($duration)?> </option>
			<?php endforeach; ?>
		</select>
		<br>
		<label>Location - Current: <?= get_room_by_id($class["room_id"])["building"]." ".get_room_by_id($class["room_id"])["room_number"] ?> / New:</label>
		<select name="room_id" required>
			<option value="<?= $class["room_id"] ?>"> <?php echo "Unchanged"?> </option>
			<?php foreach ($room_data as $room): ?>
				<option value="<?= $room["room_id"] ?>"> <?php echo $room["building"]." ".$room["room_number"]?> </option>
			<?php endforeach; ?>
		</select>
		<br>
		<label>Instructor - Current: <?= $class["instructor"] ?> / New:</label>
		<select name="faculty_id" required>
			<option value="<?= $class["faculty_id"] ?>"> <?php echo "Unchanged"?> </option>
			<?php foreach ($instructor_data as $instructor): ?>
				<option value="<?= $instructor["faculty_id"] ?>"> <?php echo $instructor["full_name"]?> </option>
			<?php endforeach; ?>
		</select>
		<br>
		<input type="submit" name="submit_edit_to_class">
</form>
