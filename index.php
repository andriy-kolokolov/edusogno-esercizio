<?php
include 'config/app.php';
include 'config/debug.php'
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

<?php include 'views/includes/header.php'; ?>

<main class="main-content-wrapper">
    <div class="container">
        <!--    ROUTER VIEWS    -->
        <?php include 'router.php'; ?>
    </div>
</main>

<?php include 'views/includes/footer.php'; ?>

<script src="assets/js/script.js"></script>
</body>
</html>


