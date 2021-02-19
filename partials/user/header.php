<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>College Enrollment System</title>
    <link rel="stylesheet" href="css/user.css">
    <link rel="stylesheet" href="css/input.css">
    <link rel="stylesheet" href="css/table.css">
</head>
<body>
    <header>
        <div class="brand">
            <a class="mainlink" href="user.php"><?= get_role_name($role) ?></a>
        </div>
        <nav class="main-nav">
            <p><?= $user["full_name"] ?></p>
            <a class="mainlink" href="logout.php">Logout</a>
        </nav>
    </header>
    <div class="aside">
        <div class="aside-content">
            <?php require_once("users/links/choose.php") ?>
        </div>
    </div>
    <main>
        <div class="main-content">

