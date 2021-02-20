<?php check_user([ADMIN]) ?>


<h1>List Courses</h1>
<hr>

<?php $courses = get_all_courses() ?>

<div class="div-table">

	<table>
	<tr>
		<th>ID</th>
		<th>Title</th>
		<th>Name</th>
	</tr>
	<?php foreach($courses as $course): ?>
		<tr class="row">
			<td><?= $course["course_id"] ?></td>
			<td><?= $course["title"] ?></td>
			<td><?= $course["course_name"] ?></td>

		</tr>
		<td colspan="100%">
			<div class="info-shown-div">
				<div class="info-shown-div-info">
					<p><strong>Credits: </strong><?= $course["credits"] ?></p>
				</div>
				<div class="info-shown-div-links">
					<?php if($role === ADMIN): ?>
						<a href="user.php?feature=add_class&course_id=<?= $course["course_id"] ?>">Add Class</a>
					<?php endif; ?>
				</div>
			</div>
		</td>
		</tr>
	<?php endforeach; ?>

	</table>

</div>
<br>
