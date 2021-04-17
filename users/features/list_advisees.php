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

<h1>Advisees</h1>
<hr>

<?php if($role !== INSTRUCTOR): ?>
    <div class="who">
        <h3><?= COUNT($advisees) ?> Students advised by <?= $faculty["faculty_firstname"] ?> <?= $faculty["faculty_lastname"] ?></h3>
    </div>
<?php endif; ?>
<div class="div-table">
    <table>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Major</th>
        </tr>
        <?php foreach($advisees as $advisee): ?>
            <tr class="row">
                <td><?= $advisee["student_id"] ?></td>
                <td><?= $advisee["full_name"] ?></td>
                <td><?= $advisee["short_name"] ?></td>
            </tr>
            <tr>
            <td colspan="100%">
                <div class="info-shown-div">
                <div class="info-shown-div-info">
                    <p><strong>Email: </strong><?= $advisee["student_email"] ?></p>
                    <p><strong>Classification: </strong><?= $advisee["classification"] ?></p>
                    <p><strong>PIN: </strong><?= $advisee["PIN"] ?></p>
                    <p><strong>Username: </strong><?= $advisee["student_username"] ?></p>
                </div>
                <div class="info-shown-div-links">
                    <?php if($role === INSTRUCTOR || $role === CHAIR): ?>
                        <a class="feature-url" href="user.php?feature=view_schedule&student_id=<?= $advisee["student_id"] ?>">View Schedule</a>
                        <a class="feature-url" href="user.php?feature=enroll&student_id=<?= $advisee["student_id"] ?>">Enroll</a>
                    <?php endif ?>
                    <?php if($role === SECRETARY || $role === CHAIR ||$role === INSTRUCTOR): ?>
                        <a class="feature-url" href="user.php?feature=contact_student&student_id=<?=$advisee["student_id"]?>">Contact Student</a>
                    <?php endif ?>
                    <?php if($role === CHAIR || $role === SECRETARY): ?>
                        <a class="feature-url" href="user.php?feature=change_advisor&student_id=<?= $advisee["student_id"] ?>">Change Advisor</a>
                    <?php endif ?>
                </div>
                </div>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
</div>
