<?php check_user([CHAIR,INSTRUCTOR,STUDENT]) ?>
<h1>Enroll</h1>
<hr>
<?php 

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
                </div>
                </div>
            </td>
            </tr>
        <?php endforeach; ?>
    </table>
</div>

<form method="POST">
<label>Enter CRN:</label>
<input type="text" name="CRN" value="" required/>
<input type="submit" name="submit_crn" />
</form>

<?php 
$enrolled_crn = isset($_POST["submit_crn"])? $_POST["CRN"] : "nothing";
?>