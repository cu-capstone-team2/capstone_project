<?php require_once("includes/all.php") ?>

<?php require_once("partials/home/header.php") ?>

<?php

if(isset($_GET["key"])){
  require_once("includes/form_validations/reset_password.php");
} else{
  require_once("includes/form_validations/reset_password_verify.php");
}

?>

<?php require_once("partials/home/footer.php") ?>