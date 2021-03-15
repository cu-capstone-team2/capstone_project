<?php check_user([CHAIR,SECRETARY]) ?>

<h1>List Advisors</h1>
<hr>

<?php

$pagination = new Pagination(PAGES_ADVISORS, $_GET);
$advisors = get_all_advisors($_GET, false, $pagination);
$input = clean_array($_GET);
$roles = [ADMIN=>"Admin",CHAIR=>"Chair",INSTRUCTOR=>"Instructor",SECRETARY=>"Secretary"];
?>

<h3 class='total-count'><?= $pagination->get_total_rows() ?> Advisors(s)</h3>


<!-- Beginning of search form -->

<button class="search-button">Search</button>

<div class="backdrop"></div>

<form method="GET" class="search-form">
    <input name="feature" value="list_advisors" type="text" hidden/>

    <div>
      <label>Name: </label>
      <input placeholder="Ex. Pierce, Ryan" type="text" name="name" value="<?= show_value($input,"name") ?>" />      
    </div>
    <div>
      <label>ID: </label>
      <input type="text" name="id" value="<?= show_value($input,"id") ?>" />
    </div>
    <div>
      <label>Order by: </label>
      <select name="order">
          <option value="name" <?= check_select($input,"order","name") ?>>Name</option>
          <option value="id" <?= check_select($input,"order","id") ?>>ID</option>
		  <option value="students" <?= check_select($input,"order","students") ?>># of Advisees</option>
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
                    <th># of Advisees</th>
                </tr>
                <?php foreach($advisors as $advisors): ?>
                    <tr class="row">
                        <td><?= $advisors["faculty_id"]?> </td>
                        <td><?= $advisors["full_name"]?> </td>
                        <td><?= $advisors["students"]?></td>
                    </tr>
                    <tr>
                    <td colspan="100%">
                        <div class="info-shown-div">
                            <div class="info-shown-div-info">
                                <p><strong>Email: </strong><?= $advisors["faculty_email"] ?></p>
                                <p><strong>Phone: </strong><?= $advisors["faculty_phone"] ?></p>
                                <p><strong>Location: </strong><?= $advisors["room"] ?></p>
                                <p><strong>Username: </strong><?= $advisors["faculty_username"] ?></p>
                                <p><strong>Active Status: </strong><?= $advisors["faculty_active"] ?></p>
                            </div>
                            <div class="info-shown-div-links">
                                <a class="feature-url" href="user.php?feature=list_advisees&faculty_id=<?= $advisors["faculty_id"] ?>">List Advisees</a>
                                <a class="feature-url" href="user.php?feature=contact_advisor&faculty_id=<?= $advisors["faculty_id"] ?>">Contact Advisor</a>
                            </div>

                        </div>
                    </td>
                    </tr>
                <?php endforeach; ?>
        </table>
</div>

<?php $pagination->print_all_links() ?>
