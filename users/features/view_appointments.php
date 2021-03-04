<?php check_user([INSTRUCTOR]) ?>
<h1>View Appointments</h1>
<hr>

<?php $appointments = get_appointments_by_instructor($user["faculty_id"]) ?>

<div class="div-table">
<table>
    <tr>
        <th>ID</th>
        <th>Student</th>
        <th>Date/Time</th>
        <th>Days Away</th>
    </tr>
    <?php foreach($appointments as $appoint): ?>
    <tr class="row">
        <td><?= $appoint["student_id"] ?></td>
        <td><?= $appoint["full_name"] ?></td>
        <td><?= $appoint["date"] ?> <?= $appoint["time"] ?></td>
        <td><?= $appoint["days_away"] ?></td>
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
              </div>
          </div>
      </td>
    </tr>
    <?php endforeach; ?>
</table>
</div>