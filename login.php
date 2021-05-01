<?php require_once("includes/all.php") ?>

<?php require_once("partials/home/header.php") ?>

<?php

$errors = [];
$input = [];

// If the submit button is set, then validate the form.
// If no errors, then login the user
if(isset($_POST["submit_login"])){
    $errors = validate_login($_POST);
    if(empty($errors)){
        login_user($_POST);
        change_page('user.php');
    }
    $input = clean_array($_POST);
} else{
    logout();
}

?>

<!-- 
	LOGIN FORM
	includes username, password, and role as input
-->
<div class="form__login login">
    <?= show_error($errors,"login") ?>

    <h1>Login</h1>
    <form action="<?= action() ?>" method="POST">

        <div class="container__input">
            <input type="text" name="username" value="<?= show_value($input,'username') ?>" autocomplete="off" required />
            <label>Username</label>
        </div>

        <div class="container__input">
            <input type="password" name="password" value="<?= show_value($input,"password") ?>" autocomplete="off" required />
            <label>Password</label>    
        </div>

        <div class="container__select">
            <select name="role" required>
                <option hidden disabled selected></option>
                <option value="student" <?= check_select($input,'role','student') ?>>Student</option>
                <option value="faculty" <?= check_select($input,'role','faculty') ?>>Faculty/Staff</option>
            </select>
            <label>Role</label>
        </div>
        <input type="submit" name="submit_login" value="Login">
        <a href="reset_password.php">Forgot your password?</a>
    </form>
</div>

<script>
document.querySelector('input').focus();
</script>

<?php require_once("partials/home/footer.php") ?>