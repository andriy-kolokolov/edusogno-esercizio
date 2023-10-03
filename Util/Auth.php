<?php

namespace Util;

use Dao\UserDAOImpl;

class Auth
{
    const SESSION_STATUS_SUCCESS = 'success';
    const SESSION_STATUS_FAIL = 'fail';

    public static function login(string $email, string $password): bool
    {
        // validate user
        $userDao = new UserDAOImpl();
        $isValidUser = $userDao->validateUser($email, $password);

        if ($isValidUser) {
            // regenerate the session ID to prevent session fixation attacks
            session_regenerate_id(true);
            $_SESSION['login_status'] = self::SESSION_STATUS_SUCCESS;
            $_SESSION['login_message'] = "login success, user authenticated";
            return true;
        } else {
            $_SESSION['login_status'] = self::SESSION_STATUS_FAIL;
            $_SESSION['login_message'] = "Invalid email or password. Please try again.";
            return false;
        }
    }

    public static function register(string $name, string $lastname, string $email, string $password): bool
    {
        $userDao = new UserDAOImpl();
        // return true if success, else return false if user already exists
        $userCreated = $userDao->create($name, $lastname, $email, $password);

        if ($userCreated) {
            session_regenerate_id(true);
            $_SESSION['login_status'] = self::SESSION_STATUS_SUCCESS;
            $_SESSION['login_message'] = "Hello, " . $name . ' ' . $lastname . ". Welcome to your dashboard!";
            return true;
        } else {
            $_SESSION['login_status'] = self::SESSION_STATUS_FAIL;
            $_SESSION['login_message'] = "User with email " . $email . " already exists. Try another one :) .";
            return false;
        }
    }
}