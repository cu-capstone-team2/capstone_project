<?php check_user([ADMIN,CHAIR,SECRETARY]) ?>


<?php $students = get_all_students() ?>

<h1>List Students</h1>
<hr>

<div class="div-table">

	<table>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Major</th>
            <th>Advisor</th>
        </tr>
	<?php foreach($students as $student): ?>
		<tr class="row">
            <td><?= $student["student_id"] ?></td>
            <td><?= $student["full_name"] ?></td>
            <td><?= $student["short_name"] ?></td>
            <td><?= $student["advisor"] ?></td>
		</tr>
        <tr>
            <td colspan="100%">
                <div class="info-shown-div">
                <div class="info-shown-div-info">
                    <p><strong>Email: </strong><?= $student["student_email"] ?></p>
                    <p><strong>Classification: </strong><?= $student["classification"] ?></p>
                    <p><strong>PIN: </strong><?= $student["PIN"] ?></p>
                    <p><strong>Username: </strong><?= $student["student_username"] ?></p>
                    <p><strong>Active Status: </strong><?= $student["student_active"] ?></p>
                </div>
                <div class="info-shown-div-links">
                    <?php if($role === CHAIR || $role === SECRETARY): ?>
                        <a class="feature-url" href="user.php?feature=pick_major&student_id=<?= $student["student_id"] ?>">Change Major</a>
                    <?php endif; ?>
                    <?php if($role === CHAIR || $role === SECRETARY): ?>
                        <a class="feature-url"  href="user.php?feature=change_advisor&student_id=<?= $student["student_id"]?>">Change Advisor</a>
                    <?php endif; ?>
                    <?php if($role === INSTRUCTOR || $role === SECRETARY || $role === CHAIR): ?>
                        <a class="feature-url"  href="user.php?feature=contact_student&student_id=<?= $student["student_id"]?>">Contact Student</a>
                    <?php endif; ?>
                    <?php if($role === CHAIR): ?>
                        <a class="feature-url"  href="user.php?feature=enroll&student_id=<?= $student["student_id"] ?>">Enroll</a>
                    <?php endif; ?>
                </div>
                </div>
            </td>
        </tr>
	<?php endforeach; ?>
	</table>

</div>
<br>
