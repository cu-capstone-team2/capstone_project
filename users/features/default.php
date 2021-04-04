<h1>Welcome, <?= get_current_user_name() ?></h1>
<hr>
<div class='info-table'>
<table>
<?php if($role === STUDENT): ?>
	<?php $credits = get_credits_by_student($user["student_id"])  ?>
	<caption>Your Information</caption>
	<tr>
		<td>Your Name</td>
		<td><?= $user["full_name"] ?></td>
	</tr>
	<tr>
		<td>Username</td>
		<td><?= $user["student_username"] ?></td>
	</tr>
	<tr>
		<td>Email</td>
		<td><?= $user["student_email"] ?></td>
	</tr>
	<tr>
		<td>Major</td>
		<td><?= $user["major_name"] ?></td>
	</tr>
	<tr>
		<td>Credits</td>
		<td><?= $credits ?></td>
	</tr>
	<tr>
		<td>Classes</td>
		<td><?= count(get_classes_by_student($user["student_id"])) ?></td>
	</tr>
	<tr>
		<td>Advisor</td>
		<td><?= $user["advisor"] ?></td>
	</tr>
	<tr>
		<td>Advisor Office</td>
		<td><?php
			$advisor = get_faculty_by_id($user["faculty_id"]);
			echo $advisor["room"];
		?></td>
	</tr>
	<tr>
		<td>Advisor Email</td>
		<td><?= $advisor["faculty_email"] ?></td>
	</tr>
	<tr>
		<td>Next Appointment</td>
		<td><?= get_next_appointment_by_student($user["student_id"]) ?></td>
	</tr>
<?php else: ?>
	<caption>Your Information</caption>
	<tr>
		<td>Your Name</td>
		<td><?= $user["full_name"] ?></td>
	</tr>
	<tr>
		<td>Username</td>
		<td><?= $user["faculty_username"] ?></td>
	</tr>
	<tr>
		<td>Email</td>
		<td><?= $user["faculty_email"] ?></td>
	</tr>
	<tr>
		<td>Office</td>
		<td><?= $user["room"] ?></td>
	</tr>
	<tr>
		<td>Role</td>
		<td><?= get_role_name($role) ?></td>
	</tr>
	<?php if($role === INSTRUCTOR): ?>
	<tr>
		<td># of Classes</td>
		<td><?= classes_instructor_teaches($user["faculty_id"])  ?></td>
	</tr>
	<tr>
		<td>Advisees</td>
		<td><?= count(get_students_by_advisor($user["faculty_id"])) ?></td>
	</tr>
	<tr>
		<td>Next Appointment</td>
		<td><?= get_next_appointment_by_advisor($user["faculty_id"]) ?></td>
	</tr>
	<?php endif ?>
<?php endif ?>
</table>

<?php if($role !== STUDENT):  ?>

<table>
	<caption>Statistics</caption>
	<tr>
		<td># of Users</td>
		<td><?= count(get_all_faculty()) + count(get_all_students()) ?></td>
	</tr>
	<tr>
		<td># of Faculty Members</td>
		<td><?= count(get_all_faculty()) ?></td>
	</tr>
	<tr>
		<td># of Students</td>
		<td><?= count(get_all_students()) ?></td>
	</tr>
	<tr>
		<td># of Advisors</td>
		<td><?= count(get_all_advisors()) ?></td>
	</tr>
	<tr>
		<td># of Classes</td>
		<td><?= count(get_all_classes()) ?></td>
	</tr>

</table>

<?php endif ?>
</div>
