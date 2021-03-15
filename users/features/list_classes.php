<?php check_user([ADMIN,CHAIR,INSTRUCTOR,STUDENT]) ?>

<h1>List Classes</h1>
<hr>

<?php
$pagination = new Pagination(PAGES_CLASSES, $_GET);
$classes = get_all_classes($_GET, false, $pagination);
$times = get_all_class_time();
$days = ["MW","TR","MTWR","F","SS","MR"];
$input = clean_array($_GET);
$orders = ["course_n"=>"Course#","title"=>"Title","time"=>"Time","days"=>"Days","crn"=>"CRN"];
$majors = get_all_majors();
?>

<h3 class='total-count'><?= $pagination->get_total_rows() ?> Classes(s)</h3>

<!-- Beginning of search form -->

<button class="search-button">Search</button>

<div class="backdrop"></div>

<form method="GET" class="search-form">
    <input type="text" name="feature" value="list_classes" hidden />

    <div>
        <label>CRN: </label>
        <input type="text" name="crn" value="<?= show_value($input,'crn') ?>"/>
    </div>
    <div>
        <label>Instructor: </label>
        <input type="text" name="instructor" value="<?= show_value($input,'instructor') ?>"/>
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
        <label>Days: </label>
        <select name="days">
            <option value="all">All</option>
            <?php foreach($days as $day): ?>
                <option value="<?= $day ?>" <?= check_select($input,'days',$day) ?>><?= $day ?></option>
            <?php endforeach ?>
        </select>
    </div>
    <div>
        <label>Time: </label>
        <select name="time">
            <option value="all">All</option>
            <?php foreach($times as $time): ?>
                <option value="<?= $time["time_id"] ?>" <?= check_select($input,'time',$time["time_id"]) ?>><?= $time["time"] ?></option>
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
            <th>CRN</th>
            <th>Course</th>
            <th>Title</th>
            <th>Time</th>
            <th>Days</th>
        </tr>
        <?php foreach($classes as $class): ?>
            <tr class="row">
                <td><?= $class["class_id"] ?></td>
                <td><?= $class["course_title"] ?></td>
                <td><?= $class["course_name"] ?></td>
                <td><?= $class["time"] ?></td>
                <td><?= $class["days"] ?></td>
            </tr>
            <tr>
            <td colspan="100%">
                <div class="info-shown-div">
                <div class="info-shown-div-info">
                    <p><strong>Instructor: </strong><?= $class["instructor"] ?></p>
                    <p><strong>Location: </strong>Howell Hall</p>
                    <p><strong>Credits: </strong><?= $class["credits"] ?></p>
                    <p><strong># of Students: </strong><?= $class["students"] ?></p>
                </div>
                <div class="info-shown-div-links">
                    <?php if($role === CHAIR): ?>
                        <a class="feature-url" href="user.php?feature=class_roster&class_id=<?= $class["class_id"] ?>">Class Roster</a>
                    <?php endif ?>
                    <?php if($role === ADMIN): ?>
                        <a class="feature-url" href="user.php?feature=edit_class&class_id=<?= $class["class_id"] ?>">Edit Class</a>
                        <a class="feature-url" href="user.php?feature=delete_class&class_id=<?= $class["class_id"] ?>" onclick="return confirm('Are you sure you want to delete <?= $class["course_name"] ?>? Deleting a class will automatically unenroll every student from this class.')">Delete Class</a>
                    <?php endif ?>
                </div>
                </div>
            </td>
            </tr>
        <?php endforeach; ?>
    </table>
</div>

<?php $pagination->print_all_links() ?>