<?php require_once("includes/all.php") ?>

<?php require_once("partials/home/header.php") ?>

<?php
		$error = [];
		$input = [];

		$requests = get_apply_request();
		$majors = get_all_majors();
		
		// function to make sure input from user is correct
		// return errors if any
		function validate_apply($input){
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
			}else if(!!get_apply_by_email($input['email'])){
				$errors['email'] = "A request with that email has already been sent";
			}

			if(!isset($input['major']) || empty($input['major'])){
				$errors['major'] = "Major is required";
			}
				return $errors;
		}



		// if form was submitted, check if validated.
		// if so, then insert application and tell the user it was submitted successfully
	 if(isset($_POST["submit_apply"])){
   		$error = validate_apply($_POST);
		$input = clean_array($_POST);
             if(empty($error)){
				insert_apply($_POST["first_name"],$_POST["last_name"], $_POST["email"],$_POST["major"]);
				echo "<h3 style ='color:green'>Request Made!</h3>";
                echo "<a href ='index.php' style = 'color:green'> Go back to Home</a> ";	 
				$input = [];
			}
	 }


?>

<div class="form__login login">
	<h1>Apply Now!</h1>

<!--
	APPLICATION FORM
-->
	
<form action="<?= action()?>" method="post">
    <div class="container__input">
		<input type="text" name="first_name" value="<?= show_value($input, 'first_name')?>">
		<label>First Name</label>
		<?= show_error($error, 'first_name') ?>
	</div>

    <div class="container__input">
		<input type="text" name = "last_name"value="<?=show_value($input, 'last_name')?>">
		<label>Last Name</label>
		<?= show_error($error, 'last_name') ?>
	</div>

    <div class="container__input">
		<input type="email" name= "email" value="<?=show_value($input, 'email')?>">
		<label>Personal Email</label>
		<?= show_error($error, 'email') ?>
	</div>
    <div class="container__select">
	<select name="major" required>
	  	<option hidden disabled selected></option>
	  <?php foreach($majors as $major):?>
		<option <?= check_select($input,"major",$major["major_id"]) ?> value ="<?=$major['major_id']?>"><?=$major["short_name"]?> - <?=$major["major_name"]?></option>
	  <?php endforeach; ?>
	</select>
	<label>Major of Interest</label>
	<?= show_error($error, 'major') ?>

	</div>

	<input type="submit" name="submit_apply">

</form>
</div>


<script>
document.querySelector('input').focus();
</script>


<?php require_once("partials/home/footer.php") ?>
