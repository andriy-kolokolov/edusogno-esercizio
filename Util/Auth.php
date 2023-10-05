<?php

namespace Util;

use Dao\UserDAOImpl;
use Exception;
use Model\User;

class Auth
{
    const SESSION_STATUS_SUCCESS = 'success';
    const SESSION_STATUS_FAIL = 'fail';

    public static function login(string $email, string $password): bool
    {
        // validate user
        $userDao = new UserDAOImpl();
        $user = $userDao->validateGetUser($email, $password);

        if ($user) {
            // regenerate the session ID to prevent session fixation attacks
            session_regenerate_id(true);
            $_SESSION['login_status'] = self::SESSION_STATUS_SUCCESS;
            $_SESSION['user'] = $user;
            return true;
        } else {
            $_SESSION['login_status'] = self::SESSION_STATUS_FAIL;
            return false;
        }
    }

    public static function register(string $name, string $lastname, string $email, string $password): bool
    {
        $userDao = new UserDAOImpl();
        // check if user exists, create and return User object if exists, else return false.
        $user = $userDao->createGetUser($name, $lastname, $email, $password);

        if ($user) {
            session_regenerate_id(true);
            $_SESSION['login_status'] = self::SESSION_STATUS_SUCCESS;
            $_SESSION['user'] = $user;
            return true;
        } else {
            $_SESSION['login_status'] = self::SESSION_STATUS_FAIL;
            return false;
        }
    }

    public static function logout(): void
    {
        unset($_SESSION['user']);
        session_destroy();
    }

    public static function user(): ?User
    {
        return $_SESSION['user'] ?? null;
    }

    public static function generatePasswordResetToken(User $user): ?string
    {
        try {
            $userEmail = $user->getEmail();

            $tokenLength = 32;
            $token = bin2hex(random_bytes($tokenLength));
            $timestamp = time();
            $token .= '_' . $timestamp;

            $db = DbUtil::getConnection();
            $sql = "UPDATE edusogno_db.utenti SET reset_token = ? WHERE email = ?";
            $stmt = $db->prepare($sql);
            $stmt->bind_param("ss", $token, $userEmail);
            $stmt->execute();
            $stmt->close();

            return $token;
        } catch (Exception $e) {
            echo $e->getMessage();
            return null;
        }
    }
}