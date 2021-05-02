<?php check_user([ADMIN,CHAIR,SECRETARY]) ?>

<?php 

/*
List all students in a table
admin can activate and deactivate students
*/

if($role === ADMIN){
    // activate and deactive accounts if admin
    if(isset($_GET["activate"])){
        update_student_active($_GET["activate"], 1);
        change_page(link_without("activate"));
    } else if(isset($_GET["deactivate"])){
        update_student_active($_GET["deactivate"], 0);
		delete_appointments_students_upcoming($_GET["deactivate"], 0);
        change_page(link_without("deactivate"));
    } else if(isset($_GET["delete"])){
		delete_all_appointments_by_student($_GET["delete"]);
		delete_student($_GET["delete"]);
		change_page(link_without("delete"));
	}
}

$pagination = new Pagination(PAGES_STUDENTS, $_GET);
$students = get_all_students($_GET, false, $pagination);
$input = clean_array($_GET);
$majors = get_all_majors();

?>

<h1>Students</h1>
<hr>

<?php if($role === ADMIN): ?>
    <a class="feature-url"  href="user.php?feature=add_student">Add Student</a>
<?php endif; ?>

<h3 class='total-count'><?= $pagination->get_total_rows() ?> Students(s)</h3>

<!-- Beginning of search form -->

<button class="search-button">Search</button>

<div class="backdrop"></div>

<form method="GET" class="search-form">
    <input name="feature" value="list_students" type="text" hidden/>
    <div>
        <label>Name: </label>
        <input placeholder="Ex. Alden, Robert" type="text" name="name" value="<?= show_value($input,"name") ?>" />
    </div>
    <div>
        <label>ID: </label>
        <input type="text" name="id" value="<?= show_value($input,"id") ?>" />
    </div>
    <div>
	<div>
		<label>Major: </label>
		<select name="major">
		<option value="all">All</option>
		<?php foreach($majors as $major): ?>
			<option value="<?= $major["major_id"] ?>" <?= check_select($input,'major',$major["major_id"]) ?>><?= $major["short_name"] ?></option>
		<?php endforeach ?>
		</select>
	</div>
    </div>
    <?php if($role === ADMIN): ?>
    <div>
        <label>Status: </label>
        <select name="status">
            <option value="active" <?= check_select($input,"status",'active') ?>>Active</option>
            <option value="inactive" <?= check_select($input,"status",'inactive') ?>>Inactive</option>
            <option value="all" <?= check_select($input,"status",'all') ?>>Any</option>
        </select>
    </div>
    <?php endif ?>
    <div>
        <label>Order by: </label>
        <select name="order">
            <option value="name" <?= check_select($input,"order","name") ?>>Name</option>
            <option value="id" <?= check_select($input,"order","id") ?>>ID</option>
            <option value="major" <?= check_select($input,"order","major") ?>>Major</option>
        </select>
    </div>
    <input type="submit" value="Search" />
</form>

<script src="js/search_form.js"></script>

<!-- End of search form -->

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
                    <p><strong>Classification: </strong><?= ucfirst($student["classification"]) ?></p>
                    <p><strong>PIN: </strong><?= $student["PIN"] ?></p>
                    <p><strong>Username: </strong><?= $student["student_username"] ?></p>
                    <p><strong>Active Status: </strong>
                        <?php 
                            if ($student["student_active"] == "1") {
                                echo "Active";
                            } else {
                                echo "Inactive";
                            }
                        ?>
                    </p>
                </div>
                <div class="info-shown-div-links">
                    <?php if($role === CHAIR || $role === SECRETARY): ?>
                        <a class="feature-url" href="user.php?feature=pick_major&student_id=<?= $student["student_id"] ?>">Change Major</a>
                    <?php endif; ?>
                    <?php if($role === CHAIR || $role === SECRETARY): ?>
                        <a class="feature-url"  href="user.php?feature=change_advisor&student_id=<?= $student["student_id"]?>">Change Advisor</a>
                    <?php endif; ?>
                    <?php if($role === ADMIN || $role === INSTRUCTOR || $role === SECRETARY || $role === CHAIR): ?>
                        <a class="feature-url"  href="user.php?feature=contact_student&student_id=<?= $student["student_id"]?>">Contact Student</a>
                    <?php endif; ?>
                    <?php if($role === CHAIR): ?>
                        <a class="feature-url"  href="user.php?feature=enroll&student_id=<?= $student["student_id"] ?>">Enroll</a>
                        <a class="feature-url"  href="user.php?feature=view_schedule&student_id=<?= $student["student_id"] ?>">View Schedule</a>                        
                    <?php endif; ?>
                    <?php if($role === ADMIN): ?>
                        <?php if($student["student_active"] == "0"): ?>
                            <a onclick="return confirm('Are you sure you want to activate <?= $student['full_name'] ?>?')" class="feature-url" href="<?= link_without("") . "&activate={$student["student_id"]}" ?>">Activate Account</a>
							<a onclick="return confirm('Are you sure you want to permenantly delete <?= $student['full_name'] ?>? All archived appointments will also be deleted.')" class='feature-url' href="<?= link_without("") . "&delete={$student['student_id']}"?>">Delete Account</a>
                        <?php else: ?>
                            <a class="feature-url"  href="user.php?feature=edit_student&student_id=<?= $student["student_id"] ?>">Edit Student</a>
                            <a onclick="return confirm('Are you sure you want to deactivate <?= $student['full_name'] ?>? The student will not be able to login and will be unenrolled from all courses. Also, upcoming appointments with advisors will be cancelled.')" class="feature-url" href="<?= link_without("") . "&deactivate={$student["student_id"]}" ?>">Deactive Account</a>
                        <?php endif ?>
                    <?php endif; ?>
                </div>
                </div>
            </td>
        </tr>
	<?php endforeach; ?>
	</table>
</div>
<?php $pagination->print_all_links() ?>

<br>
