<?php check_user([ADMIN])?>

<?php

if(isset($_GET["delete"])){
	delete_contact($_GET["delete"]);
	change_page(link_without("delete"));
}

$pagination = new Pagination(PAGES_CONTACT, $_GET);
  $contactors = get_contact_info($_GET, false, $pagination);
  $input = clean_array($_GET);
  $cnt = 1;
 ?>
 

<h1>Contacted Us</h1>
<hr>
<h3 class='total-count'><?= $pagination->get_total_rows() ?> Contactor(s)</h3>

<button class="search-button">Search</button>
<div class="backdrop"></div>

<form method="GET" class="search-form">
    <input name="feature" value="list_contact_us" type="text" hidden/>
    <div>
        <label>Name: </label>
        <input placeholder="Ex. Alden, Robert" type="text" name="name" value="<?= show_value($input,"name") ?>" />
    </div>

    <?php if($role === ADMIN): ?>
    <div>
        <label>Status: </label>
        <select name="status">
            <option value="active" <?= check_select($input,"status",'active') ?>>Not Responded</option>
            <option value="inactive" <?= check_select($input,"status",'inactive') ?>>Responded</option>
            <option value="all" <?= check_select($input,"status",'all') ?>>Any</option>
        </select>
    </div>
    <?php endif ?>
    <div>
        <label>Order by: </label>
        <select name="order">
            <option value="name" <?= check_select($input,"order","name") ?>>Name</option>
            <option value="date" <?= check_select($input, "order", "date") ?>>Date</option>
        </select>
    </div>
    <input type="submit" value="Search" />
</form>

<script src="js/search_form.js"></script>

<!-- End of search form -->

<div class= "div-table">
  <table>
    <tr>
        <th>Contactor No.</th>
        <th>Contactor</th>
		<th>Contact Date:</th>
    </tr>

    <?php foreach($contactors as $contactor):?>
    <tr class="row">
        <td><?php echo $cnt; $cnt++;?></td>
        <td><?=$contactor["full_name"]?></td>
		<td><?=$contactor["date"]?></td>
    </tr>

    <tr>
  <td colspan="100%">
     <div class="info-shown-div">
     <div class="info-shown-div-info">
        <p><strong>Email: </strong><?=$contactor["email"]?></p>
             <p><strong>Message: </strong>"<?=$contactor["message"]?>"</p>
			 <p><strong>Status: </strong><?php if($contactor["is_Contacted"] == 1){
						echo "Responded";}
						else{
							echo "Not Responded";
						}?> </strong></p>

      </div>
		 <div class="info-shown-div-links">
			  <a class="feature-url" href="user.php?feature=contact_contactor&contact_id=<?=$contactor["ID"]?>">Contact</a>
			  <a class="feature-url" href="<?= link_without("") ?>&delete=<?=$contactor["ID"]?>" onclick="return confirm('Are you sure you want to close contact ? Closing will remove the message from the list.')">Delete Contact</a>
		 </div>
   </div>

  <?php endforeach; ?>
  </table>
</div>

<?php $pagination->print_all_links() ?>
