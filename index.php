<?php
session_start();
require_once "autoload.php"; // to automate use of 'require' where needed

if (!isset($_SESSION['migrations_completed'])) {
    \Util\DbUtil::runMigrations();
    // Set a session variable to indicate that migrations have been completed
    $_SESSION['migrations_completed'] = true;
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="assets/styles/main.css">
    <!--    <link rel="icon" type="image/x-icon" href="/assets"> todo -->
    <title>Edusogno</title>
</head>
<body>

<?php include 'includes/header.php'; ?>

<main class="main-content-wrapper">
    <div class="container">
        <!--    ROUTER VIEWS    -->
        <?php include 'router.php'; ?>
    </div>
</main>

<?php include 'includes/footer.php'; ?>

<script src="assets/js/script.js"></script>
</body>
</html>


