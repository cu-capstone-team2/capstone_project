<?php check_user([INSTRUCTOR, CHAIR]) ?>
<h1>Class Roster</h1>
<hr>

<?php
    $class = get_class_by_id($_GET["class_id"]);

    if(!$class){
        change_page("user.php?feature=teaching_schedule");
    }

    $students = get_students_by_class($class["class_id"]);



?>

<h3><?= $class["course_name"] ?>, <?= $class["time"] ?>, <?= $class["days"] ?> by <?= $class["instructor"] ?></h3>
<div class="div-table">
    <table>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Major</th>
        </tr>
        <?php foreach($students as $student): ?>
            <tr class="row">
                <td><?= $student["student_id"] ?></td>
                <td><?= $student["full_name"] ?></td>
                <td><?= $student["short_name"] ?></td>
            </tr>
		<tr>
			<td colspan="100%">
				<div class="info-shown-div">
				<div class="info-shown-div-info">
			                <p><strong>Email: </strong><?= $student["student_email"] ?></p>
			                <p><strong>Classification: </strong><?= $student["classification"] ?></p>
		       		        <p><strong>Username: </strong><?= $student["student_username"] ?></p>
		                	<p><strong>Active Status: </strong><?= $student["student_active"] ?></p>
				</div>
				<div class="info-shown-div-links">
                    <?php if($role === CHAIR || $role === INSTRUCTOR): ?>
                        <a class="feature-url" href="user.php?feature=view_schedule&student_id=<?= $student["student_id"] ?>">View Schedule</a>
                    <?php endif ?>
				</div>
				</div>
			</td>
		</tr>
        <?php endforeach; ?>
    </table>
</div>
