<?php check_user([ADMIN,CHAIR,SECRETARY]) ?>
<h1>List Students</h1>

<?php $students = get_all_students() ?>

<br>
<div class="div-table">

	<table>
        <tr>
            <th>ID</th>
            <th>Last Name</th>
            <th>First Name</th>
            <th>Email</th>
            <th>Status</th>
            <th>PIN</th>
            <th>Username</th>
            <th>Active</th>
            <th>Major</th>
            <th>Advisor</th>
        </tr>
	<?php foreach($students as $student): ?>
		<tr>
            <td><?= $student["student_id"] ?></td>
            <td><?= $student["student_lastname"] ?></td>
            <td><?= $student["student_firstname"] ?></td>
            <td><?= $student["student_email"] ?></td>
            <td><?= $student["classification"] ?></td>
            <td><?= $student["PIN"] ?></td>
            <td><?= $student["student_username"] ?></td>
            <td><?= $student["student_active"] ?></td>
            <td><?= $student["short_name"] ?></td>
            <td><?= $student["advisor"] ?></td>
		</tr>
	<?php endforeach; ?>

	</table>

</div>
<br>