<?php check_user([ADMIN,CHAIR,SECRETARY]) ?>


<?php $students = get_all_students() ?>

<h1>List Students</h1>

<div class="div-table">

	<table>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Major</th>
            <?php if($role === CHAIR || $role === SECRETARY): ?>
                <th>Change Major</th>
            <?php endif; ?>
            <th>Advisor</th>
            <?php if($role === CHAIR || $role === SECRETARY): ?>
                <th>Change Advisor</th>
            <?php endif; ?>
            <th>Email</th>
            <th>Status</th>
            <th>PIN</th>
            <th>Username</th>
            <th>Active</th>
        </tr>
	<?php foreach($students as $student): ?>
		<tr>
            <td><?= $student["student_id"] ?></td>
            <td><?= $student["full_name"] ?></td>
            <td><?= $student["short_name"] ?></td>
            <?php if($role === CHAIR || $role === SECRETARY): ?>
                <td><a href="user.php?feature=pick_major&student_id=<?= $student["student_id"] ?>">Change Major</a></td>
            <?php endif; ?>
            <td><?= $student["advisor"] ?></td>
            <?php if($role === CHAIR || $role === SECRETARY): ?>
                <td><a href="user.php?feature=change_advisor&student_id=<?= $student["student_id"] ?>">Change Advisor</a></td>
            <?php endif; ?>
            <td><?= $student["student_email"] ?></td>
            <td><?= $student["classification"] ?></td>
            <td><?= $student["PIN"] ?></td>
            <td><?= $student["student_username"] ?></td>
            <td><?= $student["student_active"] ?></td>
		</tr>
	<?php endforeach; ?>
	</table>

</div>
<br>