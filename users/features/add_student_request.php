<?php check_user([ADMIN]);

$errors = [];
$input = [];

$apply_id = isset($_GET["apply_id"])? $_GET["apply_id"] : "";
$request= get_apply_info($apply_id);
if(!$request){
  change_page("user.php");
}
$advisors= get_all_advisors();
function validate_new_student($input){
  $errors = [];
  if(!isset($input['email']) || empty($input['email'])){
       $errors['email'] = "Email is required";
   }else if(!filter_var($input['email'], FILTER_VALIDATE_EMAIL)){
       $errors['email'] = "Email is not Valid";
   }
   if(!isset($input["advisor"]) || empty($input["advisor"])){
     $errors['advisor'] = "Advisor is required";
   }
   return $errors;
}

 if(isset($_POST["submit_new_student"])){
   $errors = validate_new_student($_POST);
      if(empty($errors)){
        $username = generate_username($request["first_name"], $request["last_name"]);
          $password = generate_random_password();
          $hash_password = PASSWORD_HASH($password, PASSWORD_DEFAULT);
          $PIN = generate_random_pin();


        insert_student($request["first_name"], $request["last_name"], $_POST["email"], "freshman", $PIN, $username, $hash_password, $request["major_id"], $_POST["advisor"]);

          $msg = "Username:{$username} Password:{$password}";

          mail($_POST['email'], "Student Login Information", $msg);
          echo "<h3 style ='color:green'>Faculty Added!</h3>";
          echo "<a href ='user.php?feature=apply_request' style = 'color:green'> Go back to Faculty</a> ";
          close_request($request["apply_id"]);
      }
      $input = clean_array($_POST);
 }
?>

<h1>Add Student Request</h1>
<hr>

<div class="who">
  <h3>Name: <?php echo $request["full_name"]?></h3>
  <h3>Personal Email: <?php echo $request["email"]?></h3>
  <h3>Major: <?php echo $request["major_name"]?></h3>
</div>

<form method="post" class="form">
 <div class="form-group">
  <label>Student Email:</label>
  <input <?= error_outline($errors,'email') ?> type="email" name = "email" value="<?=show_value($input,"email")?>" required>
  <?= show_error($errors, "email")?>
 </div>

 <div class="form-group">
  <label>Advisor: </label>
  <select <?= error_outline($errors,'advisor') ?> name = "advisor" required>
    <?php foreach ($advisors as $advisor): ?>
        <option value="<?=$advisor["faculty_id"]?>"> <?=$advisor["full_name"]?> - tutors <?=$advisor["students"]?> students </option>
    <?php endforeach; ?>
  </select>
    <?= show_error($errors,"advisor"); ?>

 </div>


  <input type="submit" name="submit_new_student">
</form>
