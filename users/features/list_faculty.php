<?php check_user([ADMIN]) ?>
 

<h1>List Faculty</h1>
<hr>

<a class="feature-url"  href="user.php?feature=add_faculty">Add Faculty</a>

<?php
$faculty = get_all_faculty($_GET);
$input = clean_array($_GET);
$roles = [ADMIN=>"Admin",CHAIR=>"Chair",INSTRUCTOR=>"Instructor",SECRETARY=>"Secretary"];

?>

<!-- Beginning of search form -->

<button class="search-button">Search</button>

<div class="backdrop"></div>

<form method="GET" class="search-form">
    <input name="feature" value="list_faculty" type="text" hidden/>

    <div>
      <label>Name: </label>
      <input placeholder="Ex. Pierce, Ryan" type="text" name="name" value="<?= show_value($input,"name") ?>" />      
    </div>
    <div>
      <label>ID: </label>
      <input type="text" name="id" value="<?= show_value($input,"id") ?>" />
    </div>
    <div>
      <label>Role: </label>
      <select name="role">
        <option value="all">All</option>
        <?php foreach($roles as $key=>$value): ?>
          <option value="<?= $key ?>" <?= check_select($input,"role",$key) ?>><?= $value ?></option>
        <?php endforeach ?>
      </select>
    </div>
    <div>
      <label>Order by: </label>
      <select name="order">
          <option value="role" <?= check_select($input,"order","role") ?>>Role</option>
          <option value="name" <?= check_select($input,"order","name") ?>>Name</option>
          <option value="id" <?= check_select($input,"order","id") ?>>ID</option>
      </select>
    </div>

    <input type="submit" />
</form>

<script src="js/search_form.js"></script>

<!-- End of search form -->




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

