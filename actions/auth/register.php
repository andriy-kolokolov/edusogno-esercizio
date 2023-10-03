<?php

use Util\Auth;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // if login success/fail set accordingly : $_SESSION['login_status'] and $_SESSION['login_message']
    if (Auth::register($name, $lastname, $email, $password)) {
        header("Location: /dashboard");
    } else {
        header("Location: /register");
    }
    exit(); // ensure script will not be executed after redirect
}
