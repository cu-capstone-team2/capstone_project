<?php check_user([ADMIN]) ?>
<h1>List Courses</h1>

<?php $courses = get_all_courses() ?>

<br>
<div class="div-table">

	<table>
	<tr>
	<th>ID</th>
	<th>Name</th>
	<th>Credits</th>
	<th>Title</th>
	</tr>
	<?php foreach($courses as $course): ?>
		<tr>
	<td><?= $course["course_id"] ?></td>
	<td><?= $course["course_name"] ?></td>
	<td><?= $course["credits"] ?></td>
	<td><?= $course["title"] ?></td>
		</tr>
	<?php endforeach; ?>

	</table>

</div>
<br>