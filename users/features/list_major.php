<?php check_user([ADMIN]);

$majors = get_all_majors();
 ?>


<h1>List Majors</h1>
<hr>

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
              <p><strong></strong></p>
              <p><strong></strong></p>
       </div>
              <div class="info-shown-div-links">
              </div>
        </div>
    </td>
  <?php endforeach;?>
</table>
</div>
