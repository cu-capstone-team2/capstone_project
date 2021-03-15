<?php check_user([ADMIN]) ?>


<h1>List Courses</h1>
<hr>
<a class="feature-url" href="user.php?feature=add_course">Add Course</a>

<?php

$pagination = new Pagination(PAGES_COURSES, $_GET);
$courses = get_all_courses($_GET, false, $pagination);
$input = clean_array($_GET);
$orders = ["course_n"=>"Course#","title"=>"Title"];
$majors = get_all_majors();

?>

<h3 class='total-count'><?= $pagination->get_total_rows() ?> Courses(s)</h3>


<!-- Beginning of search form -->

<button class="search-button">Search</button>

<div class="backdrop"></div>

<form method="GET" class="search-form">
	<input type="text" name="feature" value="list_courses" hidden />

    <div>
        <label>ID: </label>
        <input type="text" name="course" value="<?= show_value($input,'course') ?>"/>
    </div>
	<div>
		<label>Subject: </label>
		<select name="major">
		<option value="all">All</option>
		<?php foreach($majors as $major): ?>
			<option value="<?= $major["major_id"] ?>" <?= check_select($input,'major',$major["major_id"]) ?>><?= $major["short_name"] ?></option>
		<?php endforeach ?>
		</select>
	</div>
    <div>
        <label>Order By: </label>
        <select name="order">
            <?php foreach($orders as $key=>$value): ?>
                <option value="<?= $key ?>" <?= check_select($input,'order',$key) ?>><?= $value ?></option>
            <?php endforeach ?>
        </select>
    </div>

    <input type="submit" />
</form>

<script src="js/search_form.js"></script>

<!-- End of search form -->



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

<?php $pagination->print_all_links() ?>
