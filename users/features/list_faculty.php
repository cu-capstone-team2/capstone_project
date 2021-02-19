<?php check_user([ADMIN]) ?>
 

<h1>List Faculty</h1>

<?php $faculty = get_all_faculty()?>


<div class="div-table">
  <table>
    <tr>
      <th>ID</th>
      <th>Role</th>
      <th>Name</th>
      <th>Email</th>
      <th>Phone</th>
      <th>Room</th>
      <th>Username</th>
      <th>Active</th>
      
     <?php if($role == ADMIN): ?>
              <th>Edit Info</th>
       <?php endif; ?>
      
     </tr>

 <?php foreach ($faculty as $faculty): ?>
    <tr>
      <td><?=	$faculty["faculty_id"] ?></td>
      <td><?=   $faculty["role"] ?></td>
      <td><?=	$faculty["full_name"] ?></td>
      <td><?=	$faculty["faculty_email"] ?></td>
      <td><?=   $faculty["faculty_phone"] ?></td>
      <td><?=   $faculty["room"] ?></td>
      <td><?=	$faculty["faculty_username"] ?></td>
      <td><?= $faculty["faculty_active"] ?></td>
      <?php if ($role == ADMIN): ?>

                 <td><a href = "user.php?feature=edit_faculty&faculty_id=<?= $faculty["faculty_id"] ?>">Edit Info</a></td>
      <?php endif ?>
    </tr>

  <?php endforeach; ?>
</table>
<div>
<br>
