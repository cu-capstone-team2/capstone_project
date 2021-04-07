<?php check_user([ADMIN]) ?>

<?php


	$faculty_id  =  isset($_GET["faculty_id"])? $_GET["faculty_id"] : "";
 	$faculty = get_faculty_by_id($faculty_id);
 
  	if(!$faculty){
		  change_page('user.php');
    }

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

    return $errors;
  }


  $input = [];
  $errors = [];

  if(isset($_POST["submit_new_faculty"])){
    $errors = validate_new_faculty($_POST);

    if(empty($errors)){
       update_faculty_details($faculty_id,$_POST["first_name"], $_POST["last_name"] ,$_POST["email"] , $_POST["phone"] ,$_POST["role"]);
        $faculty = get_faculty_by_id($faculty_id);
	echo "<h3 style ='color:green'>Faculty Edited!</h3>";
    }
    $input = clean_array($_POST);
  }

 ?>


<h1>Edit Faculty</h1>
<hr>

<div class="who">
	<h3>ID: <?= $faculty["faculty_id"] ?></h3>
	<h3>Name: <?= $faculty["full_name"] ?></h3>
</div>

<form method="post" class="form">
  <div class="form-group">
	<label>First Name</label>
    <input <?= error_outline($errors, "first_name") ?> type="text" name="first_name" value="<?= show_value($faculty, "faculty_firstname") ?>"	required>
        <?= show_error($errors, "first_name")?>
  </div>

  <div class="form-group">
  <label>Last Name</label>
  <input <?=error_outline($errors, "last_name")?> type="text" name="last_name" value="<?=show_value($faculty,"faculty_lastname") ?>" required>
    <?= show_error($errors, "last_name")?>
</div>

  <div class="form-group">
  <label>Email</label>
  <input <?=error_outline($errors, "email")?> type="email" name="email" value="<?=show_value($faculty,"faculty_email") ?>" required>
    <?= show_error($errors, "email")?>
  </div>

 <div class="form-group">
  <label>Phone - format: 555-555-5555</label>
  <input <?=error_outline($errors, "phone")?> type="tel" name="phone" pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}" value="<?=show_value($faculty,"faculty_phone") ?>" required>
    <?= show_error($errors, "phone")?>
</div>

  <div class="form-group">
  <label>Faculty Role:</label>
  <select <?= error_outline($errors, "role") ?>name="role" required>
			<option selected disabled hidden></option>
      <option <?= check_select($faculty,"role",INSTRUCTOR) ?> value="<?= INSTRUCTOR ?>">Instructor</option>
      <option <?= check_select($faculty,"role",SECRETARY) ?> value="<?= SECRETARY ?>">Secretary</option>
      <option <?= check_select($faculty,"role",ADMIN) ?> value="<?= ADMIN ?>">Administrator</option>
      <option <?= check_select($faculty,"role",CHAIR) ?> value="<?= CHAIR ?>">Chair</option>
  </select>
    <?= show_error($errors, "role")?>
</div>

	<input type="submit" name="submit_new_faculty">
</form>
