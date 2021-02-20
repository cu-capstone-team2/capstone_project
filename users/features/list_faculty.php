<?php check_user([ADMIN]) ?>
 

<h1>List Faculty</h1>
<hr>

<?php $faculty = get_all_faculty()?>


<div class="div-table">
  <table>
    <tr>
      <th>ID</th>
      <th>Name</th>
      <th>Role</th>
     </tr>

 <?php foreach ($faculty as $faculty): ?>
    <tr class="row">
      <td><?=	$faculty["faculty_id"] ?></td>
      <td><?=	$faculty["full_name"] ?></td>
      <td><?= $faculty["role"] ?></td>
    </tr>
    <tr>
      <td colspan="100%">
          <div class="info-shown-div">
              <div class="info-shown-div-info">
                  <p><strong>Email: </strong><?= $faculty["faculty_email"] ?></p>
                  <p><strong>Phone: </strong><?= $faculty["faculty_phone"] ?></p>
                  <p><strong>Location: </strong><?= $faculty["room"] ?></p>
                  <p><strong>Username: </strong><?= $faculty["faculty_username"] ?></p>
                  <p><strong>Active Status: </strong><?= $faculty["faculty_active"] ?></p>
              </div>
              <div class="info-shown-div-links">
                  <?php if ($role == ADMIN): ?>
                    <a class="feature-url" href = "user.php?feature=edit_faculty&faculty_id=<?= $faculty["faculty_id"] ?>">Edit Info</a>
                  <?php endif ?>
              </div>
          </div>
      </td>
    </tr>
  <?php endforeach; ?>
</table>
<div>
<br>
