<?php check_user([ADMIN]) ?>


<h1>List Courses</h1>
<hr>
<a class="feature-url" href="user.php?feature=add_course">Add Course</a>

<!-- Beginning of search form -->

<button class="search-button">Search</button>

<div class="backdrop"></div>

<form method="GET" class="search-form">
    <input name="feature" value="list_faculty" type="text" hidden/>
		<h3 style="color: red">Feature not finished, yet</h3>
    <input type="submit" />
</form>

<script src="js/search_form.js"></script>

<!-- End of search form -->

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
						<a class="feature-url" href="user.php?feature=add_class&course_id=<?= $course["course_id"] ?>">Add Class</a>
					<?php endif; ?>
				</div>
			</div>
		</td>
		</tr>
	<?php endforeach; ?>

	</table>

</div>
<br>
<!-- <a class="feature-url" href="user.php?feature=add_course&course_id=<?= $course["course_id"] ?>">Add Course</a> -->

<br>
