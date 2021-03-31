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
			$errors["overlaps"] = "<BR>Overlap with the following classes:<br>";
			foreach($classes as $class){
				$errors['overlaps'] .= "CRN: {$class['class_id']}, {$class['course_name']}, {$class['time']}, {$class['days']}, {$class['room']}<BR>";
			}
		}
		$classes = get_many_class_faculty_overlap($input['faculty_id'], $input['day_id'],$input["time_id"]);
		if(!empty($classes)){
			$errors['faculty_overlaps'] = "<BR>{$classes[0]['instructor']} already teaches classes at the following times:<br>";
			foreach($classes as $class){
				$errors['faculty_overlaps'] .= "CRN: {$class['class_id']}, {$class['course_name']}, {$class['time']}, {$class['days']}, {$class['room']}";
			}
		}
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
			echo "<h3 style='color:green'>Class created successfully.</h3>";
			$input = [];
		}
		$input = clean_array($_POST);
}
?>

<form method = "post" class="form">

	<?= show_error($errors,'overlaps') ?>
	<?= show_error($errors,'faculty_overlaps') ?>

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
		<label>Timeslot:</label>
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
