<?php check_user([CHAIR,INSTRUCTOR,SECRETARY]) ?>

<h1>List Advisees</h1>

<?php $advisees = get_students_by_advisor($user["faculty_id"]) ?>

<div class="div-table">
    <table>
        <tr>
            <th>Student ID</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Classification</th>
            <th>PIN</th>
            <th>Student Username</th>
            <th>Student Active</th>
            <th>Major</th>
        </tr>
        <?php foreach($advisees as $advisee): ?>
            <tr>
                <td><?= $advisee["student_id"] ?></td>
                <td><?= $advisee["student_firstname"] ?></td>
                <td><?= $advisee["student_lastname"] ?></td>
                <td><?= $advisee["student_email"] ?></td>
                <td><?= $advisee["PIN"] ?></td>
                <td><?= $advisee["student_username"] ?></td>
                <td><?= $advisee["student_active"] ?></td>
                <td><?= $advisee["short_name"] ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
</div>
