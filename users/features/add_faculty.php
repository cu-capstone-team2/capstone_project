
<?php check_user([ADMIN]) ?>

<?php

  $rooms = get_all_office_available();

  
  /*
    Validates add_faculty input form data and returns any errors.
    Validations:
    Are all fields completed?
    Are all inputs sanitized?
    Are all input lengths respected?

  */
  function validate_new_faculty($input){
    $errors = [];

    if(!isset($input['first_name']) || empty($input['first_name'])){
      $errors['first_name'] = "First Name is Required";
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

    if(!isset($input['phone']) || empty($input['phone'])){
        $errors['phone'] = "Office Phone is Required";
    }else if(strlen($input['phone']) > 14){
        $errors['phone'] = "Max 14 characters for Phone";
    }

    if(!isset($input['role'])){
        $errors['role'] = "Role is Required";
    }


    if(!isset($input['location'])){
        $errors['location'] = "Location is Required";
    }

    return $errors;
  }

  $input = [];
  $errors = [];

  /*
    if no errors then faculty is added, username and password generated and hashed,
    and then an email is containing the login information is sent to the faculty members
    email.
  */
  if(isset($_POST["submit_new_faculty"])){
    $errors = validate_new_faculty($_POST);
	$input = clean_array($_POST);
    if(empty($errors)){
       $faculty_active = 1;
       $username = generate_username($_POST["first_name"], $_POST["last_name"]);
       $password = generate_random_password();
       $hash_password = PASSWORD_HASH($password, PASSWORD_DEFAULT);
       insert_faculty_staff($_POST["first_name"], $_POST["last_name"] ,$_POST["email"] , $_POST["phone"] ,$_POST["role"],$username,$hash_password,$faculty_active,$_POST["location"]);
       $msg = "Username:{$username}\nPassword:{$password}";
       mail($_POST['email'], "Faculty Login Information", $msg);
      echo "<h3 style ='color:green'>Faculty Added</h3>";
		$input = [];
    }
  }

 ?>


<h1>Add Faculty</h1>
<hr>

<form method="post" class="form">

  <div class="form-group">
	<label>First Name</label>
    <input <?= error_outline($errors, "first_name") ?> type="text" name="first_name" value="<?=show_value($input, "first_name") ?>" required>
        <?= show_error($errors, "first_name")?>
  </div>

  <div class="form-group">
  <label>Last Name</label>
  <input <?=error_outline($errors, "last_name")?> type="text" name="last_name" value="<?=show_value($input,"last_name")?>" required>
    <?= show_error($errors, "last_name")?>
</div>

  <div class="form-group">
  <label>Email</label>
  <input <?=error_outline($errors, "email")?> type="email" name="email" value="<?=show_value($input,"email")?>" required>
    <?= show_error($errors, "email")?>
  </div>

 <div class="form-group">
  <label>Phone - format: 555-555-5555</label>
  <input <?=error_outline($errors, "phone")?> type="tel" name="phone" pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}" value="<?=show_value($input,"phone")?>" required>
    <?= show_error($errors, "phone")?>
</div>

  <div class="form-group">
  <label>Faculty Role:</label>
  <select <?= error_outline($errors, "role") ?>name="role" required>
			<option selected disabled hidden></option>
      <option <?= check_select($input,"role","1") ?> value="1">Instructor</option>
      <option <?= check_select($input,"role","2") ?> value="2">Secretary</option>
      <option <?= check_select($input,"role","3") ?> value="3">Administrator</option>
      <option <?= check_select($input,"role","4") ?> value="4">Chair</option>
  </select>
    <?= show_error($errors, "role")?>
</div>

<div class="form-group">
  <label>Offices Available:</label>
  <select <?=error_outline($errors, "location") ?> name="location" required>
		<option selected disabled hidden></option>
    <?php foreach ($rooms as $room):?>
      <option <?= check_select($input,"location",$room["room_id"]) ?> value="<?=$room['room_id']?>">
  <?=$room["building"]?> <?=$room["room_number"]?>
          </option>
    <?php endforeach;?>
  </select>
    <?= show_error($errors, "location")?>
</div>

  <input type="submit" name="submit_new_faculty">
</form>
