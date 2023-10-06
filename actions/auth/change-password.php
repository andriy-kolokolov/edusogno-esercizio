<?php

use Dao\UserDAOImpl;
use Util\Auth;

if (isset($_POST['new_password'])) {

    $newPassword = $_POST['new_password'];
    $token = $_SESSION['reset-password-token'];

    $userDao = new UserDAOImpl();

    if ($userDao->changePassword($token, $newPassword)) { // returns true if success ,else return false
        unset($_SESSION['reset-password-token']);
        $_SESSION['reset-password-status'] = 'success';
        if (Auth::user()) {
            header("Location: /dashboard");
        }
    } else {
        $_SESSION['reset-password-status'] = 'fail';
    }
    header("Location: /login");

    exit();
}

