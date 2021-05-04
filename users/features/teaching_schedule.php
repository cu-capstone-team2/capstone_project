<?php check_user([CHAIR,INSTRUCTOR]) ?>

<!--
Show teaching schedule for a specific instructor
Generate table of the classes they teach
-->

<h1>Teaching Schedule</h1>
<hr>

<?php 

// if instructor does not exist, then go to default page

$instructor_id = isset($_GET["faculty_id"])? $_GET["faculty_id"] : "";

if($role === INSTRUCTOR)
    $instructor_id = $user["faculty_id"];

$instructor = get_faculty_by_id($instructor_id);
if(!$instructor)
    change_page("user.php");

?>

<div class="who">
    <h3>For <?= $instructor["full_name"] ?></h3>
</div>

<a target="_blank" href="faculty_schedule.php?faculty_id=<?= $instructor["faculty_id"] ?>">PDF Schedule</a>

<?php $classes = get_classes_by_instructor($instructor["faculty_id"]); ?>

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
                    <p><strong>Location: </strong><?= $class["room"] ?></p>
                    <p><strong>Credits: </strong><?= $class["credits"] ?></p>
                    <p><strong># of Students: </strong><?= $class["students"] ?></p>
                </div>
                <div class="info-shown-div-links">
                    <a class="feature-url" href="user.php?feature=class_roster&class_id=<?= $class["class_id"] ?>">Class Roster</a>

                </div>
                </div>
            </td>
            </tr>
        <?php endforeach; ?>
    </table>
</div>

