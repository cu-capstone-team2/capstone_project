<?php check_user([ADMIN]);


/*
List all of the applications for the site
Can handle deleting requests as well
Generates a table to show applications
*/

if(isset($_GET["delete"])){
	delete_request($_GET["delete"]);
	change_page(link_without("delete"));
}


$pagination = new Pagination(PAGES_APPLY, $_GET);
$requests = get_apply_request($_GET, false, $pagination);
$input = clean_array($_GET);
$majors = get_all_majors();
$cnt = 1;


?>


<h1>Applications</h1>
<hr>
<h3 class='total-count'><?= $pagination->get_total_rows() ?> Request(s)</h3>

<button class="search-button">Search</button>

<div class="backdrop"></div>

<form method="GET" class="search-form">
    <input name="feature" value="list_apply_request" type="text" hidden/>
    <div>
        <label>Name: </label>
        <input placeholder="Ex. Alden, Robert" type="text" name="name" value="<?= show_value($input,"name") ?>" />
    </div>

    <div>
        <label>Major: </label>
        <select name="major">
          <option value="all">All</option>
      <?php foreach($majors as $major): ?>
        <option value="<?= $major["major_id"] ?>" <?= check_select($input,'major',$major["major_id"]) ?>><?= $major["short_name"] ?></option>
      <?php endforeach ?>

        </select>
    </div>
    <?php if($role === ADMIN): ?>
    <div>
        <label>Status: </label>
        <select name="status">
            <option value="active" <?= check_select($input,"status",'active') ?>>Open</option>
            <option value="inactive" <?= check_select($input,"status",'inactive') ?>>Closed</option>
            <option value="all" <?= check_select($input,"status",'all') ?>>Any</option>
        </select>
    </div>
    <?php endif ?>
    <div>
        <label>Order by: </label>
        <select name="order">
            <option value="name" <?= check_select($input,"order","name") ?>>Name</option>
            <option value="major" <?= check_select($input,"order","major") ?>>Major</option>
            <option value="date" <?= check_select($input, "order", "date") ?>>Date</option>
        </select>
    </div>
    <input type="submit" value="Search" />
</form>

<script src="js/search_form.js"></script>

<!-- End of search form -->



<div class="div-table">
  <table>
      <tr>
          <th>Request No.</th>
          <th>Requestor</th>
          <th>Major</th>
          <th>Date</th>
      </tr>
      <?php foreach($requests as $request):?>
          <tr class="row">
              <td><?php echo $cnt; $cnt++;?></td>
              <td><?=$request["full_name"]?></td>
              <td><?=$request["short_name"]?></td>
              <td><?=$request["date"]?></td>
          </tr>

          <tr>
            <td colspan="100%">
               <div class="info-shown-div">
               <div class="info-shown-div-info">
                       <p><strong>Email: </strong><?= $request["email"]?></p>
                       <p><strong>Interest: </strong><?= $request["major_name"]?></p>
					   <p><strong>Status: </strong><?php if($request["is_Completed"] == 1){
											echo "Closed";
										}else{
											echo "Open";
										}?></p>
                </div>
                       <div class="info-shown-div-links">
							<?php if($request["is_Completed"] == 0): ?>
								<a class="feature-url" href="user.php?feature=add_student_request&apply_id=<?= $request["apply_id"]?>">Add Student</a>
								<a class="feature-url" href="user.php?feature=contact_requestor&apply_id=<?=$request["apply_id"]?>">Contact</a>
							<?php endif ?>
                            <a class="feature-url" href="<?= link_without("") ?>&delete=<?=$request["apply_id"]?>" onclick="return confirm('Are you sure you want to Close <?= $request["full_name"] ?> Request? Closing will remove requestor from the list.')">Delete Request</a>
                       </div>
             </div>
          </tr>
  <?php endforeach;?>
  </table>
</div>

<?php $pagination->print_all_links() ?>
