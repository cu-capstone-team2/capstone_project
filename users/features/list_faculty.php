<?php check_user([ADMIN]) ?>
<h1>List Faculty</h1>

<?php $faculty = get_all_faculty()?>

<br>

<div class="div-table">
  <table>
    <tr>
      <th>ID</th>
      <td>Role</td>
      <th>Name</th>
      <th>Email</th>
      <th>Phone</th>
      <th>Room</th>
      <th>Username</th>
      <th>Active</th>
    </tr>
  <?php foreach ($faculty as $faculty): ?>
    <tr>
      <td><?=	$faculty["faculty_id"] ?></td>
      <td><?= $faculty["role"] ?></td>
      <td><?=	$faculty["full_name"] ?></td>
      <td><?=	$faculty["faculty_email"] ?></td>
      <td><?= $faculty["faculty_phone"] ?></td>
      <td><?= $faculty["room"] ?></td>
      <td><?=	$faculty["faculty_username"] ?></td>
      <td><?= $faculty["faculty_active"] ?></td>
    </tr>
  <?php endforeach; ?>
</table>
<div>
<br>
