<?php check_user([ADMIN]);

$errors = [];
$input = [];

$apply_id = isset($_GET["apply_id"])? $_GET["apply_id"] : "";

$request= get_apply_info($apply_id);
$advisors= get_all_advisors();
function validate_new_student($input){
  $errors = [];
  if(!isset($input['email']) || empty($input['email'])){
       $errors['email'] = "Email is required";
   }else if(!filter_var($input['email'], FILTER_VALIDATE_EMAIL)){
       $errors['email'] = "Email is not Valid";
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
                   delete_request($request["apply_id"]);

               }
               $input = clean_array($_POST);

 }
?>

<h3>Add Student From Apply</h3>
<hr>

<h3>Name: <?php echo $request["full_name"]?></h3>
<h3>Personal Email: <?php echo $request["email"]?></h3>
<h3>Major: <?php echo $request["major_name"]?> </h3>
<h3>Major_id: <?php echo $request["major_id"]?> </h3>
<form method="post">
  <?= show_error($errors, "email")?>
  <label>Student Email:</label>
  <input type="email" name = "email" value="<?=show_value($input,"email")?>" required>
<br>
  <label>Advisor: </label>
  <select name = "advisor" required>
    <?php foreach ($advisors as $advisor): ?>
        <option value="<?=$advisor["faculty_id"]?>"> <?=$advisor["full_name"]?> - tutors <?=$advisor["students"]?> students </option>
    <?php endforeach; ?>
  </select>

  <br>
  <input type="submit" name="submit_new_student">
</form>
