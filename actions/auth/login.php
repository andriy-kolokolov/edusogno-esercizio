<?php

use Util\Auth;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // if login success/fail set accordingly : $_SESSION['login_status'] and $_SESSION['login_message']
    if (Auth::login($email, $password)) {
        header("Location: /dashboard");
    } else {
        header("Location: /login");
    };
    exit(); // ensure script will not be executed after redirect
}
