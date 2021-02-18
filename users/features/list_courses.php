<?php check_user([ADMIN]) ?>
<h1>List Courses</h1>

<?php $courses = get_all_courses() ?>

<br>
<div class="div-table">

	<table>
	<tr>
	<th>ID</th>
	<th>Title</th>
	<th>Name</th>
	<th>Credits</th>
	<?php if($role == ADMIN): ?>
		<th>Add Class</th>
	<?php endif; ?>
	</tr>
	<?php foreach($courses as $course): ?>
		<tr>
	<td><?= $course["course_id"] ?></td>
	<td><?= $course["title"] ?></td>
	<td><?= $course["course_name"] ?></td>
	<td><?= $course["credits"] ?></td>
	<?php if($role == ADMIN): ?>
		<td><a href="user.php?feature=add_class&course_id=<?= $course["course_id"] ?>">Add Class</a></td>
	<?php endif; ?>
		</tr>
	<?php endforeach; ?>

	</table>

</div>
<br>