<?php

use Dao\UserDAOImpl;

if (isset($_POST['new_password'])) {

    $newPassword = $_POST['new_password'];
    $token = $_SESSION['reset-password-token'];

    $userDao = new UserDAOImpl();

    if ($userDao->changePassword($token, $newPassword)) { // returns true if success ,else return false
        unset($_SESSION['reset-password-token']);
        $_SESSION['reset-password-status'] = 'success';
    } else {
        $_SESSION['reset-password-status'] = 'fail';
    }
    header("Location: /login");

    exit();
}

