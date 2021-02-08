<?php require_once("includes/all.php") ?>

<?php $user = authenticate(); ?>

<?php $role = isset($user["role"])? $user["role"] : STUDENT ?>

<?php require_once("partials/user/header.php") ?>

<?php

switch($role){
    case ADMIN:
        require_once("users/admin/pages/home.php");
        break;
    case CHAIR:
        require_once("users/chair/pages/home.php");
        break;
    case INSTRUCTOR:
        require_once("users/instructor/pages/home.php");
        break;
    case STUDENT:
        require_once("users/student/pages/home.php");
        break;
    case SECRETARY:
        require_once("users/secretary/pages/home.php");
        break;
}

?>

<?php print_r($user) ?>
<br>

<?php require_once("partials/user/footer.php") ?>