<?php require_once("includes/all.php") ?>

<?php require_once("partials/home/header.php") ?>

<?php

// if key exists, then show the reset_password page
// else, show the verify page
if(isset($_GET["key"])){
  require_once("includes/form_validations/reset_password.php");
} else{
  require_once("includes/form_validations/reset_password_verify.php");
}

?>

<?php require_once("partials/home/footer.php") ?>