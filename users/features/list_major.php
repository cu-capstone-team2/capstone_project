<?php check_user([ADMIN]);

if(isset($_GET["delete"]) ){
	if(can_major_be_deleted($_GET["delete"])){
		delete_applies_by_major($_GET["delete"]);
		delete_major($_GET["delete"]);
	}
	change_page(link_without("delete"));
}


$majors = get_all_majors();

 ?>


<h1>Majors</h1>
<hr>
<a class="feature-url" href="user.php?feature=add_major">Add Major</a>

<div class="div-table">
<table>
    <tr>
        <th>ID</th>
        <th>Major Name</th>
        <th>Abbreviation</th>
    </tr>

    <?php foreach($majors as $major):?>
      <tr class="row">
      <td><?=$major["major_id"]?></td>
      <td><?=$major["major_name"]?></td>
      <td><?=$major["short_name"]?></td>
    </tr>

    <td colspan="100%">

      <div class="info-shown-div">
      <div class="info-shown-div-info">
              <p><strong>Students: </strong><?= get_major_students($major["major_id"]) ?></p>
              <p><strong>Courses: </strong><?= get_major_courses($major["major_id"]) ?></p>
              <p><strong>Classes: </strong><?= get_major_classes($major["major_id"]) ?></p>
       </div>
          <div class="info-shown-div-links">
			<?php if(can_major_be_deleted($major["major_id"])): ?>
				<a onclick="return confirm('Are you sure you want to delete <?= $major["major_name"] ?> as a major? Doing so will delete all applications for this major.')" class='feature-url' href="user.php?feature=list_major&delete=<?= $major['major_id'] ?>">Delete</a>
			<?php else: ?>
				<p class='error'>Cannot Delete</p>
			<?php endif ?>
          </div>
        </div>
    </td>
  <?php endforeach;?>
</table>
</div>
