<?php check_user([ADMIN, CHAIR, SECRETARY]) ?>
 

<h1>Faculty</h1>
<hr>

<?php if($role === ADMIN): ?>
 <a class="feature-url"  href="user.php?feature=add_faculty">Add Faculty</a>
<?php endif ?>
<?php

if($role === ADMIN){
    if(isset($_GET["activate"])){
        update_faculty_active($_GET["activate"], 1);
        change_page(link_without("activate"));
    } else if(isset($_GET["deactivate"])){
		if(can_faculty_be_deactivated($_GET["deactivate"])){
			update_faculty_active($_GET["deactivate"], 0);
		}
		change_page(link_without("deactivate"));
    } else if(isset($_GET["delete"])){
		delete_all_appointments_by_faculty($_GET["delete"]);
		delete_faculty($_GET["delete"]);
		change_page(link_without("delete"));
	}
}

$pagination = new Pagination(PAGES_FACULTY, $_GET);
$faculty = get_all_faculty($_GET, false, $pagination);
$input = clean_array($_GET);
$roles = [ADMIN=>"Admin",CHAIR=>"Chair",INSTRUCTOR=>"Instructor",SECRETARY=>"Secretary"];

?>

<h3 class='total-count'><?= $pagination->get_total_rows() ?> Faculty Member(s)</h3>


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
                  <p><strong>Active Status: </strong>
                    <?php
                      if ($faculty["faculty_active"] == "1") {
                          echo "Active";
                      } else {
                          echo "Inactive";
                      }
                    ?>
                  </p>
              </div>
              <div class="info-shown-div-links">

				<?php if($faculty["faculty_active"] == "1"): ?>
					<a class="feature-url" href="user.php?feature=contact_faculty&faculty_id=<?= $faculty["faculty_id"] ?>">Contact Faculty</a>
				<?php endif ?>
                  <?php if ($role === ADMIN): ?>
                    <?php if($faculty["faculty_active"] == "0"): ?>
                        <a onclick="return confirm('Are you sure you want to activate <?= $faculty['full_name'] ?>?')" class="feature-url" href="<?= link_without("") . "&activate={$faculty["faculty_id"]}" ?>">Activate Account</a>
                        <a onclick="return confirm('Are you sure you want to permanently delete <?= $faculty['full_name'] ?> from the database? Doing so will also delete every advisor appointment.')" class="feature-url" href="<?= link_without("") . "&delete={$faculty["faculty_id"]}" ?>">Delete Account</a>
                    <?php else: ?>
    			              <a class="feature-url" href = "user.php?feature=edit_faculty&faculty_id=<?= $faculty["faculty_id"] ?>">Edit Info</a>
                        <?php if(can_faculty_be_deactivated($faculty["faculty_id"])): ?>
                          <a onclick="return confirm('Are you sure you want to deactivate <?= $faculty['full_name'] ?>?')" class="feature-url" href="<?= link_without("") . "&deactivate={$faculty["faculty_id"]}" ?>">Deactive Account</a>
                        <?php else: ?>
                          <p class="error">Cannot Deactivate</p>
                        <?php endif ?>
                    <?php endif ?>
                  <?php endif ?>
              </div>
          </div>
      </td>
    </tr>
  <?php endforeach; ?>
</table>
</div>

<?php $pagination->print_all_links() ?>
