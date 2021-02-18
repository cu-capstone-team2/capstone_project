<?php
check_user([STUDENT,INSTRUCTOR]);

$student_id = isset($_GET["student_id"])? $_GET["student_id"] : "";

if(isset($user["student_id"]))
    $student_id = $user["student_id"];

$student = get_student_by_id($student_id);
if(!$student)
    change_page("user.php");
?>

<?php $classes = get_classes_by_student($student["student_id"]) ?>

<h1>View Student Class Schedule</h1>

<?php if(!isset($user["student_id"])): ?>
    <h3>Schedule of <?= $student["student_firstname"] ?> <?= $student["student_lastname"] ?></h3>
<?php endif ?>

<div class="div-table">

    <table>
        <tr>
            <td>CRN</td>
            <td>Course</td>
            <td>Title</td>
            <td>Time</td>
            <td>Days</td>
            <td>Credits</td>
            <td>Instructor</td>
        </tr>

        <?php foreach($classes as $class): ?>
            <tr>
                <td><?= $class["class_id"] ?></td>
                <td><?= $class["course_title"] ?></td>
                <td><?= $class["course_name"] ?></td>
                <td><?= $class["time"] ?></td>
                <td><?= $class["days"] ?></td>
                <td><?= $class["credits"] ?></td>
                <td><?= $class["instructor"] ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
</div>


