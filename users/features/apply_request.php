<?php check_user([ADMIN]);

$requests = get_apply_request();

$cnt = 1;
?>

<h1>Apply Request</h1>
<hr>

<div class="div-table">
  <table>
      <tr>
          <th>Request No.</th>
          <th>Requestor</th>
          <th>Major</th>

      </tr>
      <?php foreach($requests as $request):?>
          <tr class="row">
              <td><?php echo $cnt; $cnt++;?></td>
              <td><?=$request["full_name"]?></td>
              <td><?=$request["short_name"]?></td>

          </tr>

          <tr>
            <td colspan="100%">
               <div class="info-shown-div">
               <div class="info-shown-div-info">
                       <p><strong>Email: </strong><?= $request["email"]?></p>
                       <p><strong>Major of Intrest: </strong><?= $request["major_name"]?></p>
                </div>
                       <div class="info-shown-div-links">
                            <a class="feature-url" href="user.php?feature=add_student_request&apply_id=<?= $request["apply_id"]?>">Add Student</a>
                            <a class="feature-url" href="user.php?feature=contact_requestor&apply_id=<?=$request["apply_id"]?>">Contact</a>
                            <a class="feature-url" href="user.php?feature=delete_request&apply_id=<?=$request["apply_id"]?>" onclick="return confirm('Are you sure you want to delete <?= $request["full_name"] ?>? Deleting will remove requestor from the system.')">Delete Request</a>
                       </div>

             </div>
          </tr>
  <?php endforeach;?>
  </table>
</div>
