<?php
check_user([STUDENT,INSTRUCTOR,CHAIR]);
/*
    This page displays a students schedule.
    It also allows viewing a PDF of the schedule for printing.
*/
$student_id = isset($_GET["student_id"])? $_GET["student_id"] : "";

if(isset($user["student_id"]))
    $student_id = $user["student_id"];

$student = get_student_by_id($student_id);
if(!$student)
    change_page("user.php");
?>

<?php $classes = get_classes_by_student($student["student_id"]) ?>

<h1>View Student Class Schedule</h1>
<hr>

<div class="who">
<?php if(!isset($user["student_id"])): ?>
    <h3>Schedule of <?= $student["student_firstname"] ?> <?= $student["student_lastname"] ?></h3>
<?php endif ?>

<?php $total_credits = get_credits_by_student($student["student_id"]); ?>

    <h3>Total Credits: <?= $total_credits ?></h3>
</div>

<a target="_blank" href="student_schedule.php?student_id=<?= $student["student_id"] ?>">PDF Schedule</a>

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
                    <p><strong>Location: </strong><?= $class["room"] ?></p>
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


