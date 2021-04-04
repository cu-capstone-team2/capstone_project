<?php require_once("includes/all.php")?>
<?php require_once("partials/home/header.php")?>

<?php
      $error = [];
      $input = [];

      function validate_contact($input){
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

          if(!isset($input['message']) || strlen($input["message"]) > 255){
          $errors['message'] = "Over 255 Characters";
      }
        return $errors;

      }

      	 if(isset($_POST["submit_contact"])){
            $error = validate_contact($_POST);
			$input = clean_array($_POST);
             if(empty($error)){
		             insert_contact($_POST["first_name"],$_POST["last_name"], $_POST["email"],$_POST["message"]);
		               echo "<h3 style ='color:green'>Message Sent!</h3>";
                 echo "<a href ='index.php' style = 'color:green'> Go back to Home</a> ";
					$input = [];
               }
          }
 ?>

<div class = "form__login login">
  <h1>Contact Us</h1>
  <form action="<?=action()?>" method="post">
      <div class = "container__input">
          <input type="text" name="first_name" value="<?=show_value($input,'first_name')?>">
            <label>First Name</label>
			<?= show_error($error, 'first_name') ?>
      </div>

      <div class="container__input">
          <input type="text" name = "last_name"value="<?=show_value($input, 'last_name')?>">
          <label>Last Name</label>
		  	<?= show_error($error, 'last_name') ?>
      </div>

      <div class="container__input">
        <input type="email" name= "email"value="<?=show_value($input, 'email')?>">
        <label>Personal Email</label>
			<?= show_error($error, 'email') ?>
      </div>

      <div class="container__input">
  
        <textarea id= "message" name="message" rows="4" cols="46" required><?= show_value($input, 'message')?></textarea>
        <label>Message (Max:255)</label>
		   <?= show_error($error, 'message') ?>
      </div>
      <p>Character Count: <span id="char-count">0</span></p>
      <input type="submit" name = "submit_contact">
  </form>
</div>
<script>
document.querySelector('input').focus();
</script>

<script>
const charCount = document.querySelector('#char-count');
const comments = document.querySelector('#message');

const updateCharCount = (e) => {
    if(comments.value.length > 255){
        comments.value = comments.value.substring(0,255);
    }
    charCount.innerHTML = comments.value.length;
}

updateCharCount();
comments.oninput = updateCharCount;


</script>
<?php require_once("partials/home/footer.php") ?>
