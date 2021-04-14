<?php check_user([ADMIN]);

$errors = [];
$input = [];

$apply_id = isset($_GET["apply_id"])? $_GET["apply_id"] : "";
$request= get_apply_info($apply_id);
if(!$request){
  change_page("user.php");
}
$advisors= get_all_advisors();
$majors = get_all_majors();
function validate_new_student($input){
        $errors = [];

        if(!isset($input['first_name']) || empty($input['first_name'])){
            $errors['first_name'] = "First Name Required";
        }else if(!ctype_alpha($input['first_name'])){
            $errors['first_name'] = "First Name can only contain characters";
        }else if(strlen($input['first_name']) > 50){
            $errors['first_name'] = "Max 50 characters for First Name";
        }

        if(!isset($input['last_name']) || empty($input['last_name'])){
            $errors['last_name'] = "Last Name Required";
        }else if(!ctype_alpha($input['last_name'])){
            $errors["last_name"] = "Last Name can only contain characters";
        }else if(strlen($input['last_name']) > 50){
            $errors['last_name'] = "Max 50 characters for Last Name";
        }
        if(!isset($input['email']) || empty($input['email'])){
            $errors['email'] = "Email is required";
        }else if(!filter_var($input['email'], FILTER_VALIDATE_EMAIL)){
            $errors['email'] = "Email is not Valid";
        }else if(strlen($input['email']) > 50){
            $errors['email'] = "Max 50 characters for Email";
        }

        if(!isset($input['major_id']) || empty($input["major_id"])){
            $errors['major_id'] = "Major is incorrect";
        }

        if(!isset($input['advisor']) || empty($input["advisor"])){
            $errors['advisor'] = "Advisor is incorrect";
        }

        return $errors;
}

$student_added = false;

 if(isset($_POST["submit_new_student"])){
   $errors = validate_new_student($_POST);
      if(empty($errors)){
        $username = generate_username($_POST["first_name"], $_POST["last_name"], STUDENT);
          $password = generate_random_password();
          $hash_password = PASSWORD_HASH($password, PASSWORD_DEFAULT);
          $PIN = generate_random_pin();


        insert_student($_POST["first_name"], $_POST["last_name"], $_POST["email"], "freshman", $PIN, $username, $hash_password, $_POST["major_id"], $_POST["advisor"]);

          $msg = "Username:{$username} Password:{$password}";

          mail($_POST['email'], "Student Login Information", $msg);
          echo "<h3 style ='color:green'>Student Added!</h3>";
          close_request($request["apply_id"]);
		  $input = [];
		  $student_added = true;
      }
      $input = clean_array($_POST);
 }
?>

<h1>Add Student Request</h1>
<hr>

<?php if(!$student_added): ?>

<div class="who">
  <h3>Name: <?php echo $request["full_name"]?></h3>
  <h3>Personal Email: <?php echo $request["email"]?></h3>
  <h3>Major: <?php echo $request["major_name"]?></h3>
</div>

<form class="form" method="POST">

    <div class="form-group">
        <label>First Name</label>
        <input <?= error_outline($errors, "first_name") ?> type="text" name="first_name" value="<?=show_value($request, "first_name")?>" required>
        <?=show_error($errors, "first_name")?>
    </div>

    <div class="form-group">
        <label>Last Name</label>
        <input <?= error_outline($errors, "last_name") ?> type="text" name="last_name" value="<?=show_value($request, "last_name")?>" required>
        <?=show_error($errors, "last_name")?>
    </div>

    <div class="form-group">
        <label>Email</label>
        <input <?= error_outline($errors, "email") ?> type="email" name="email" value="<?=show_value($request, "email")?>" required>
        <?=show_error($errors, "email")?>
    </div>

    <div class="form-group">
        <label>Major</label>
        <select <?= error_outline($errors, "major_id") ?> name="major_id" required>
            <?php foreach($majors as $major): ?>
                <option <?= check_select($request,"major_id",$major["major_id"]) ?>  value="<?=$major['major_id']?>">
                    <?=$major["major_name"]?>
                </option>
            <?php endforeach; ?>
        </select>
        <?=show_error($errors, "major_id")?>
    </div>

 <div class="form-group">
  <label>Advisor: </label>
  <select <?= error_outline($errors,'advisor') ?> name = "advisor" required>
	<option selected hidden disabled></option>
    <?php foreach ($advisors as $advisor): ?>
        <option <?= check_select($input,"advisor",$advisor["faculty_id"]) ?> value="<?=$advisor["faculty_id"]?>"> <?=$advisor["full_name"]?> - tutors <?=$advisor["students"]?> students </option>
    <?php endforeach; ?>
  </select>
    <?= show_error($errors,"advisor"); ?>

 </div>


  <input type="submit" name="submit_new_student">
</form>

<?php endif ?>
