<?php

check_user([ADMIN]);

$class_id = isset($_GET["class_id"])? $_GET["class_id"] : "";

$class = get_class_by_id($class_id);
//echo var_dump($class);
if(!$class){
	change_page("user.php");
}

$times_data = get_all_class_time();
$room_data = get_all_classrooms();
$days = get_all_days();
$durations = [55,75];
$instructor_data = get_all_advisors();

function validate_new_class($input){
	global $class;
	$errors = [];
	if (!isset($input["room_id"]) || empty($input["room_id"])) {
		$errors["room_id"] = "No room was selected.";
	}
	if (!isset($input["faculty_id"]) || empty($input["faculty_id"])) {
		$errors["faculty_id"] = "No instructor was selected.";
	}

	if(empty($errors)){
		$classes = get_many_class_overlap($class["days"],$class["time_id"],$input["room_id"],$class["class_id"]);
		if(!empty($classes)){
			$errors["overlaps"] = "<BR>Overlap with the following classes:<br>";
			foreach($classes as $classe){
				$errors['overlaps'] .= "CRN: {$classe['class_id']}, {$classe['course_name']}, {$classe['time']}, {$classe['days']}, {$classe['room']}<BR>";
			}
		}
		$classes = get_many_class_faculty_overlap($input['faculty_id'], $class['days'],$class["time_id"],$class["class_id"]);
		if(!empty($classes)){
			$errors['faculty_overlaps'] = "<BR>{$classes[0]['instructor']} already teaches classes at the following times:<br>";
			foreach($classes as $classe){
				$errors['faculty_overlaps'] .= "CRN: {$classe['class_id']}, {$classe['course_name']}, {$classe['time']}, {$classe['days']}, {$classe['room']}";
			}
		}
	}

	return $errors;
}
?>


<?php

$errors = [];
$input = [];

if(isset($_POST["submit_edit_to_class"])){
		$errors = validate_new_class($_POST);
		if(empty($errors)){
			$attrs = [$class["days"],$class["time_id"],$class["minutes"],$_POST["room_id"],$_POST["faculty_id"]];
			update_class_details($class["class_id"], $attrs);
			$class = get_class_by_id($class_id);
			echo "<h3 style='color:green'>Successfully edited class.</h3>";
		}
}
?>

<h1>Edit Class</h1>
<hr>

<div class="who">
    <h3>CRN: <?= $class["class_id"] ?></h3>
    <h3><?= $class["course_name"] ?></h3>
    <h3><?= $class["time"] ?>, <?= $class["days"] ?>, <?= $class["room"] ?></h3>
    <h3>with <?= $class["instructor"] ?></h3>
</div>


<form method = "post" class="form">
	<!--
	<div class="form-group">
        <label>Days</label>
        <select <?= error_outline($errors, "days") ?> name="days" required>
            <?php foreach ($days as $day): ?>
                <option <?= check_select($class,"days",$day) ?>  value="<?=$day?>">
                    <?=$day?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>

	<div class="form-group">
        <label>Timeslot</label>
        <select <?= error_outline($errors, "time_id") ?> name="time_id" required>
            <?php foreach($times_data as $timeslot): ?>
                <option <?= check_select($class,"time_id",$timeslot["time_id"]) ?>  value="<?=$timeslot['time_id']?>">
                    <?=$timeslot["time"]?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>

	<div class="form-group">
        <label>Duration</label>
        <select <?= error_outline($errors, "minutes") ?> name="minutes" required>
            <?php foreach ($durations as $duration): ?>
                <option <?= check_select($class,"minutes",$duration) ?>  value="<?= strval($duration)?>">
                    <?= strval($duration)?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>
	-->

	<?= show_error($errors, "overlaps") ?>
	<?= show_error($errors, "faculty_overlaps") ?>

	<div class="form-group">
        <label>Location</label>
        <select <?= error_outline($errors, "room_id") ?> name="room_id" required>
            <?php foreach($room_data as $room): ?>
                <option <?= check_select($class,"room_id",$room["room_id"]) ?>  value="<?= $room["room_id"]?>">
                    <?=$room["building"]." ".$room["room_number"]?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>

	<div class="form-group">
        <label>Instructor</label>
        <select <?= error_outline($errors, "faculty_id") ?> name="faculty_id" required>
            <?php foreach($instructor_data as $instructor): ?>
                <option <?= check_select($class,"faculty_id",$instructor["faculty_id"]) ?>  value="<?=$instructor["faculty_id"]?>">
                    <?=$instructor["full_name"]?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>

	<input type="submit" name="submit_edit_to_class">
</form>
