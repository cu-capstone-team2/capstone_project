<?php check_user([ADMIN]) ?>

<?php

  $rooms = get_all_office_available();

  function validate_new_faculty($input){
    $errors = [];

    if(!isset($input['first_name']) || empty($input['first_name'])){
      $errors['first_name'] = "First Name is Required";
    }else if(!ctype_alpha($input['first_name'])){
        $errors['first_name'] = "First Name can only contain characters";
    }

    if(!isset($input['last_name']) || empty($input['last_name'])){
        $errors['last_name'] = "Last Name Required";
    }else if(!ctype_alpha($input['last_name'])){
        $errors["last_name"] = "Last Name can only contain characters";
    }

    if(!isset($input['email']) || empty($input['email'])){
        $errors['email'] = "Email is required";
    }else if(!filter_var($input['email'], FILTER_VALIDATE_EMAIL)){
        $errors['email'] = "Email is not Valid";
    }

    if(!isset($input['phone']) || empty($input['phone'])){
        $errors['phone'] = "Office Phone is Required";
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

  if(isset($_POST["submit_new_faculty"])){
    $errors = validate_new_faculty($_POST);

    if(empty($errors)){
       $faculty_active = 1;
       $username = generate_username($_POST["first_name"], $_POST["last_name"]);
       $password = generate_random_password();
       $hash_password = PASSWORD_HASH($password, PASSWORD_DEFAULT);
       insert_faculty_staff($_POST["first_name"], $_POST["last_name"] ,$_POST["email"] , $_POST["phone"] ,$_POST["role"],$username,$hash_password,$faculty_active,$_POST["location"]);
       $msg = "Username:{$username} Password:{$password}";
       mail($_POST['email'], "Faculty Login Information", $msg);
      echo "<h3 style ='color:green'>Faculty Added!</h3>";
      echo "<a href ='user.php?feature=list_faculty' style = 'color:green'> Go back to Faculty</a> ";
    }
    $input = clean_array($_POST);
  }

 ?>


<h1>Add Faculty</h1>
<hr>

<form method="post">
  <?= show_error($errors, "first_name")?>
  <label>First Name:</label>
  <input type="text" name="first_name" <?=show_value($input, "first_name") ?> required>
  <br>

  <?= show_error($errors, "last_name")?>
  <label>Last Name:</label>
  <input type="text" name="last_name" <?=show_value($input,"last_name")?> required>
  <br>

  <?= show_error($errors, "email")?>
  <label>Email:</label>
  <input type="email" name="email" <?=show_value($input,"email")?> required>
  <br>

  <?= show_error($errors, "phone")?>
  <label>Phone:</label>
  <input type="text" name="phone" <?=show_value($input,"phone")?> required>
  <br>

  <?= show_error($errors, "role")?>
  <label>Faculty Role:</label>
  <select name="role" required>
      <option value="1">Instructor</option>
      <option value="2">Secretary</option>
      <option value="3">Administrator</option>
      <option value="4">Chair</option>
  </select>
  <br>

  <?= show_error($errors, "location")?>
  <label>Offices Available:</label>
  <select name="location" required>
    <?php foreach ($rooms as $room):?>
      <option value="<?=$room['room_id']?>">
  <?=$room["building"]?> <?=$room["room_number"]?>
          </option>
    <?php endforeach;?>
  </select>
  <br>
  <input type="submit" name="submit_new_faculty">
</form>
