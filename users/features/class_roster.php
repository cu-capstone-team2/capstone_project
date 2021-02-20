<?php check_user([INSTRUCTOR]) ?>
<h1>Class Roster</h1>
<hr>

<?php 
    $classes = get_class_by_id($_GET["class_id"]); 

    if(!$classes){
        change_page("user.php?feature=teaching_schedule");
    }

    $students = get_students_by_class($classes["class_id"]);
?>

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
				</div>
				</div>
			</td>
		</tr>
        <?php endforeach; ?>
    </table>
</div>
