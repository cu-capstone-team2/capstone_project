<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>College Enrollment System</title>
    <link rel="stylesheet" href="css/user.css">
    <link rel="stylesheet" href="css/input.css">
    <link rel="stylesheet" href="css/table.css">
    <link rel="stylesheet" href="css/search_form.css">
    <link rel="stylesheet" href="css/forms.css">
</head>
<body>
    <header>
        <div class="brand">
            <a class="mainlink" href="user.php"><?= get_role_name($role) ?></a>
        </div>
        <nav class="main-nav">
            <p><?= $user["full_name"] ?></p>
            <a class="mainlink logout" href="logout.php">Logout</a>
            <div class="toggle-button">
                <div></div>
                <div></div>
                <div></div>
            </div>
        </nav>
    </header>
    <div class="aside">
        <div class="aside-content">
            <?php require("users/links/choose.php") ?>
        </div>
    </div>
    <div class="dropdown-menu">
        <?php require("users/links/choose.php") ?>
        <a class="mainlink logout-top-right" href="logout.php">Logout</a>
    </div>
    <main>
        <div class="main-content">

