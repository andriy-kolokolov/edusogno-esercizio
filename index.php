<?php
include 'config/app.php';
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="assets/styles/main.css">
    <!--    fontawesome icons   -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
          integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
          crossorigin="anonymous" referrerpolicy="no-referrer"/>
        <link rel="icon" type="image/x-icon" href="/assets/img/favicon.png">
    <title>Edusogno</title>
</head>
<body>

<div class="page-wrapper">
    <?php
//    include 'config/debug.php'
    ?>
    <?php include 'views/includes/header.php'; ?>

    <div class="page-content">
        <div class="container">
            <!--    ROUTER VIEWS    -->
            <?php include 'router.php'; ?>
        </div>
    </div>

    <?php include 'views/includes/footer.php'; ?>

</div>

<script src="assets/js/script.js"></script>
</body>
</html>


