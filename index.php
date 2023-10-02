<?php
include 'config/db_connection.php';
session_start();
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

<!--    ROUTER VIEWS    -->
<?php include 'router.php'; ?>

<?php include 'includes/footer.php'; ?>
<script src="assets/js/script.js"></script>
</body>
</html>

