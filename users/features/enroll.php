<?php check_user([CHAIR,INSTRUCTOR,STUDENT]) ?>
<h1>Enrollment</h1>
<hr>
<?php 
	$errors = [];
	if($role === STUDENT){
		if(!isset($_SESSION["PIN"])){
			change_page("user.php?feature=enter_pin");
		}
	}

	$s_id = isset($_GET["student_id"])? $_GET["student_id"] : "";

	if($role === STUDENT){
		$s_id = $user["student_id"];
	}
	
	$student = get_student_by_id($s_id);
	if (!$student) {
		change_page("user.php?feature=list_advisees");
	}

	// $student is the one being enrolled, only refer to $student
	// not $user from this point on.

?>

<h3>Student: <?php echo $student["full_name"]?></h3>
<h3>ID: <?php echo $student["student_id"] ?></h3>

<?php
	$credits = get_credits_by_student($student["student_id"]);

	if (isset($_POST["submit_crn"])) {
		$enrolled_crn = isset($_POST["submit_crn"])? $_POST["CRN"] : "";
		$class_to_enroll = get_class_by_id($enrolled_crn);

		if ($class_to_enroll) {
	 		$is_already_enrolled = get_enrollment_by_student_class($student["student_id"],$class_to_enroll["class_id"]);
	 		if ($is_already_enrolled != false) {
	 			$errors['enrollment'] = "Already enrolled in this class.";
	 		} else if ($credits + $class_to_enroll["credits"] > 18) {
	 			$errors['enrollment'] = "Enrolling in this class would exceed credit hour limit.";
	 		}

	 		if(empty($errors)){
	 			insert_enrollment($student["student_id"],$class_to_enroll["class_id"]);
	 			$credits = get_credits_by_student($student["student_id"]);
	 		}
	 	}
	}
	/*if (isset($_POST["submit_drop_crn"])) {
		$crn_to_be_dropped = isset($_POST["submit_drop_crn"])? $_POST["drop_CRN"] : "";
		$class_to_drop = get_class_by_id($crn_to_be_dropped);
		$is_class_enrolled = get_enrollment_by_student_class($student["student_id"],$class_to_drop["class_id"]);

		if ($is_class_enrolled) {
			delete_enrollment($student["student_id"],$class_to_drop["class_id"]);
			$credits = get_credits_by_student($student["student_id"]);
		} else {
			$errors['enrollment'] = "Class is not currently enrolled.";
		}
	}*/
	if (isset($_GET["drop"])) {
		//echo "attempting to drop class id: ".$class_to_drop;
		delete_enrollment($student["student_id"],$_GET["drop"]);
		change_page("user.php?feature=enroll&student_id={$student["student_id"]}");

	}
?>

<?php $classes = get_classes_by_student($student["student_id"]) ?>

<h1>View Student Class Schedule</h1>
<hr>

<?php if(!isset($student["student_id"])): ?>
    <h3>Schedule of <?= $student["student_firstname"] ?> <?= $student["student_lastname"] ?></h3>
<?php endif ?>

<div class="div-table">

    <table>
    <tr>
            <th>CRN</th>
            <th>Course</th>
            <th>Title</th>
            <th>Time</th>
            <th>Days</th>

        </tr>

        <?php foreach($classes as $class): ?>
            <tr class="row">
                <td><?= $class["class_id"] ?></td>
                <td><?= $class["course_title"] ?></td>
                <td><?= $class["course_name"] ?></td>
                <td><?= $class["time"] ?></td>
                <td><?= $class["days"] ?></td>
            </tr>
            <tr>
            <td colspan="100%">
                <div class="info-shown-div">
                <div class="info-shown-div-info">
                    <p><strong>Instructor: </strong><?= $class["instructor"] ?></p>
                    <p><strong>Location: </strong>Howell Hall</p>
                    <p><strong>Credits: </strong><?= $class["credits"] ?></p>
                    <p><strong># of Students: </strong><?= get_class_count($class["class_id"]) ?></p>
                </div>
                <div class="info-shown-div-links">
                	<a class="feature-url"  href="user.php?feature=enroll&student_id=<?=$student["student_id"]?>&drop=<?= $class["class_id"] ?>">Drop</a>
                </div>
            </td>
            </tr>
        <?php endforeach; ?>
    </table>
</div>

<?= show_error($errors,"enrollment") ?>
<form method="POST">
<label>Enroll in Class(Enter CRN):<br></label>
<input type="text" name="CRN" value="" required/>
<input type="submit" name="submit_crn" />
</form>

<!-- <form method="POST">
<label>Drop Class(Enter CRN):<br></label>
<input type="text" name="drop_CRN" value="" required/>
<input type="submit" name="submit_drop_crn" />
</form> -->

<?php
	if (isset($class_to_enroll) && isset($enrolled_crn)) {
		echo "Desired Class: ".$class_to_enroll["course_name"]."<br>CRN: ".$enrolled_crn."<br>";
		echo "Class Credits: ".$class_to_enroll["credits"]."<br>";
	}
	echo "Current credits: ".$credits."<br>";
?>

