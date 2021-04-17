<?php check_user([INSTRUCTOR]) ?>
<h1>Appointments</h1>
<hr>
<a class="feature-url" href="user.php?feature=add_appointment">Add Appoint.</a>

<?php

if(isset($_GET["cancel"])){
    delete_appointment($user["faculty_id"], $_GET["cancel"]);
    $link = link_without("cancel");
    change_page($link);
} else if(isset($_GET["finished"])){
    update_appointments_by_student_finished($user["faculty_id"], $_GET["finished"]);
    $link = link_without("finished");
    change_page($link);
}

update_appointments_finished($user["faculty_id"]);

$pagination = new Pagination(PAGES_APPOINTMENTS, $_GET, $user["faculty_id"]);
$appointments = get_appointments_by_instructor($user["faculty_id"], $_GET, false, $pagination);
$input = clean_array($_GET);

?>

<h3 class='total-count'><?= $pagination->get_total_rows() ?> Appointment(s)</h3>

<!-- Beginning of search form -->

<button class="search-button">Search</button>

<div class="backdrop"></div>

<form method="GET" class="search-form">
    <input name="feature" value="view_appointments" type="text" hidden/>
    <div>
        <label>Name: </label>
        <input placeholder="Ex. Alden, Robert" type="text" name="name" value="<?= show_value($input,"name") ?>" />
    </div>
    <div>
        <label>ID: </label>
        <input type="text" name="id" value="<?= show_value($input,"id") ?>" />
    </div>
    <div>
        <label>Appointments: </label>
        <select name="appointments">
            <option value="0" <?= check_select($input,"appointments","0") ?>>Incomplete</option>
            <option value="1" <?= check_select($input,"appointments","1") ?>>Completed</option>
            <option value="all" <?= check_select($input,"appointments","all") ?>>All</option>

        </select>
    </div>
    <div>
        <label>Order by: </label>
        <select name="order">
            <option value="time" <?= check_select($input,"order","time") ?>>Time</option>
            <option value="name" <?= check_select($input,"order","name") ?>>Name</option>
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
        <th>Student</th>
        <th>Date/Time</th>
        <th>Days Away</th>
        <th>Status</th>
    </tr>
    <?php foreach($appointments as $appoint): ?>
    <tr class="row">
        <td><?= $appoint["student_id"] ?></td>
        <td><?= $appoint["full_name"] ?></td>
        <td><?= $appoint["date"] ?> <?= $appoint["time"] ?></td>
        <td><?= $appoint["days_away"] ?></td>
        <td><?= $appoint["status"] ?></td>
    </tr>
    <tr>
      <td colspan="100%">
          <div class="info-shown-div">
            <div class="info-show-div-info">
                <p><strong>Comments: </strong><?= $appoint["comments"] ?></p>
            </div>
              <div class="info-shown-div-links">
                  <a class="feature-url" href="user.php?feature=enroll&student_id=<?= $appoint["student_id"] ?>">Enroll</a>
                  <a class="feature-url" href="user.php?feature=contact_student&student_id=<?= $appoint["student_id"] ?>">Contact Student</a>
                  <a class="feature-url" href="user.php?feature=view_schedule&student_id=<?= $appoint["student_id"] ?>">View Schedule</a>
                    <?php if($appoint["is_finished"] === "0"): ?>
			<a class="feature-url" href="user.php?feature=edit_appointment&appoint=<?= $appoint["appointment_id"] ?>">Edit Appointment</a>
                        <a onClick="return confirm('Are you sure you want to mark this appointment as complete?')" class="feature-url" href="<?= link_without("") . "&finished={$appoint["appointment_id"]}" ?>">Mark as Complete</a>
                        <a onClick="return confirm('Are you sure you want to cancel your appointment with <?= $appoint["full_name"] ?>?')" class="feature-url" href="<?= link_without("") . "&cancel={$appoint["appointment_id"]}" ?>">Cancel</a>
                    <?php endif ?>
              </div>
          </div>
      </td>
    </tr>
    <?php endforeach; ?>
</table>
</div>

<?php $pagination->print_all_links() ?>
