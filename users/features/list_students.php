<?php check_user([ADMIN,CHAIR,SECRETARY]) ?>


<?php $students = get_all_students() ?>

<h1>List Students</h1>

<div class="div-table">

	<table>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Major</th>
            <th>Advisor</th>
            <th>Email</th>
            <th>Status</th>
            <th>PIN</th>
            <th>Username</th>
            <th>Active</th>
            <?php if($role === CHAIR || $role === SECRETARY): ?>
                <th>Change Major</th>
            <?php endif; ?>
            <?php if($role === CHAIR || $role === SECRETARY): ?>
                <th>Change Advisor</th>
            <?php endif; ?>
            <?php if($role === INSTRUCTOR || $role === SECRETARY ||$role === CHAIR): ?>
				<th>Contact Student</th>
			<?php endif;?>
        </tr>
	<?php foreach($students as $student): ?>
		<tr>
            <td><?= $student["student_id"] ?></td>
            <td><?= $student["full_name"] ?></td>
            <td><?= $student["short_name"] ?></td>
            <td><?= $student["advisor"] ?></td>
            <td><?= $student["student_email"] ?></td>
			<td><?= $student["classification"] ?></td>
            <td><?= $student["PIN"] ?></td>
            <td><?= $student["student_username"] ?></td>
            <td><?= $student["student_active"] ?></td>
            <?php if($role === CHAIR || $role === SECRETARY): ?>
                <td><a href="user.php?feature=pick_major&student_id=<?= $student["student_id"] ?>">Major</a></td>
            <?php endif; ?>
            <?php if($role === CHAIR || $role === SECRETARY): ?>
                <td><a href="user.php?feature=change_advisor&student_id=<?= $student["student_id"]?>">Advisor</a></td>
            <?php endif; ?>
	        <?php if($role === INSTRUCTOR || $role === SECRETARY ||$role === CHAIR): ?>
	            <td><a href="user.php?feature=contact_student&student_id=<?= $student["student_id"]?>">Contact</a> </td>
			<?php endif; ?>
            <?php if($role === CHAIR): ?>
                <td><a href="user.php?feature=enroll&student_id=<?= $student["student_id"] ?>">Enroll</a> </td>
            <?php endif; ?>
		</tr>
	<?php endforeach; ?>
	</table>

</div>
<br>
