<?php

check_user([CHAIR,INSTRUCTOR,SECRETARY]);

$faculty_id = isset($_GET["faculty_id"])? $_GET["faculty_id"] : "";

if($role === INSTRUCTOR){
    $faculty_id = $user["faculty_id"];
}

$faculty = get_faculty_by_id($faculty_id);

if(!$faculty) change_page("user.php");

$advisees = get_students_by_advisor($faculty_id);

?>

<h1>List Advisees</h1>

<?php if($role !== INSTRUCTOR): ?>
    <h3> <?= COUNT($advisees) ?> Students advised by <?= $faculty["faculty_firstname"] ?> <?= $faculty["faculty_lastname"] ?></h3>
<?php endif; ?>
<div class="div-table">
    <table>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Classification</th>
            <th>PIN</th>
            <?php if($role === INSTRUCTOR): ?>
                <th>View Schedule</th>
            <?php endif ?>
            <th>Student Username</th>
            <th>Student Active</th>
            <th>Major</th>
        </tr>
        <?php foreach($advisees as $advisee): ?>
            <tr>
                <td><?= $advisee["student_id"] ?></td>
                <td><?= $advisee["full_name"] ?></td>
                <td><?= $advisee["student_email"] ?></td>
                <td><?= $advisee["PIN"] ?></td>
                <?php if($role === INSTRUCTOR): ?>
                    <td><a href="user.php?feature=view_schedule&student_id=<?= $advisee["student_id"] ?>">View Schedule</a></td>
                <?php endif; ?>
                <td><?= $advisee["student_username"] ?></td>
                <td><?= $advisee["student_active"] ?></td>
                <td><?= $advisee["short_name"] ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
</div>
