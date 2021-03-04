<?php check_user([ADMIN,CHAIR,SECRETARY]) ?>

<?php 

$students = get_all_students($_GET);
$input = clean_array($_GET);

?>

<h1>List Students</h1>
<hr>

<?php if($role === ADMIN): ?>
    <a class="feature-url"  href="user.php?feature=add_student">Add Student</a>
<?php endif; ?>

<form method="GET">
    <input name="feature" value="list_students" type="text" hidden/>
    <label>Name: </label>
    <input placeholder="Ex. Alden, Robert" type="text" name="name" value="<?= show_value($input,"name") ?>" />
    <label>ID: </label>
    <input type="text" name="id" value="<?= show_value($input,"id") ?>" />
    <label>Major: </label>
    <select name="major">
        <option value="all" <?= check_select($input,"major","all") ?>>All Students</option>
        <option value="it" <?= check_select($input,"major","it") ?>>IT Students</option>
        <option value="cs" <?= check_select($input,"major","cs") ?>>CS Students</option>
    </select>
    <label>Order by: </label>
    <select name="order">
        <option value="name" <?= check_select($input,"order","name") ?>>Name</option>
        <option value="id" <?= check_select($input,"order","id") ?>>ID</option>
        <option value="major" <?= check_select($input,"order","major") ?>>Major</option>
    </select>
    <br>
    <input type="submit" />
</form>

<div class="div-table">
	<table>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Major</th>
            <th>Advisor</th>
        </tr>
	<?php foreach($students as $student): ?>
		<tr class="row">
            <td><?= $student["student_id"] ?></td>
            <td><?= $student["full_name"] ?></td>
            <td><?= $student["short_name"] ?></td>
            <td><?= $student["advisor"] ?></td>
		</tr>
        <tr>
            <td colspan="100%">
                <div class="info-shown-div">
                <div class="info-shown-div-info">
                    <p><strong>Email: </strong><?= $student["student_email"] ?></p>
                    <p><strong>Classification: </strong><?= $student["classification"] ?></p>
                    <p><strong>PIN: </strong><?= $student["PIN"] ?></p>
                    <p><strong>Username: </strong><?= $student["student_username"] ?></p>
                    <p><strong>Active Status: </strong><?= $student["student_active"] ?></p>
                </div>
                <div class="info-shown-div-links">
                    <?php if($role === CHAIR || $role === SECRETARY): ?>
                        <a class="feature-url" href="user.php?feature=pick_major&student_id=<?= $student["student_id"] ?>">Change Major</a>
                    <?php endif; ?>
                    <?php if($role === CHAIR || $role === SECRETARY): ?>
                        <a class="feature-url"  href="user.php?feature=change_advisor&student_id=<?= $student["student_id"]?>">Change Advisor</a>
                    <?php endif; ?>
                    <?php if($role === INSTRUCTOR || $role === SECRETARY || $role === CHAIR): ?>
                        <a class="feature-url"  href="user.php?feature=contact_student&student_id=<?= $student["student_id"]?>">Contact Student</a>
                    <?php endif; ?>
                    <?php if($role === CHAIR): ?>
                        <a class="feature-url"  href="user.php?feature=enroll&student_id=<?= $student["student_id"] ?>">Enroll</a>
                        <a class="feature-url"  href="user.php?feature=view_schedule&student_id=<?= $student["student_id"] ?>">View Schedule</a>                        
                    <?php endif; ?>
		    <?php if($role === ADMIN): ?>
			<a class="feature-url"  href="user.php?feature=edit_student&student_id=<?= $student["student_id"] ?>">Edit Student</a>

		    <?php endif; ?>
                </div>
                </div>
            </td>
        </tr>
	<?php endforeach; ?>
	</table>

</div>
<br>
