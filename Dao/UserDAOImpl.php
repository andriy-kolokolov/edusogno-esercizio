<?php

namespace Dao;

use Exception;
use Model\User;
use mysqli;
use Util\DbUtil;

class UserDAOImpl implements UserDAO
{
    /**
     * @throws Exception
     */
    public function createGetUser(string $name, string $lastname, string $email, string $password): User|bool
    {
        $conn = DbUtil::getConnection();
        // check by email if the user already exists
        $checkSql = "SELECT email FROM edusogno_db.utenti WHERE email = ?";
        $checkStmt = $conn->prepare($checkSql);
        // using bind_param() to protect from SQL injection
        $checkStmt->bind_param("s", $email);
        $checkStmt->execute();
        $checkStmt->store_result();

        if ($checkStmt->num_rows > 0) {
            // if user exists, return false
            $checkStmt->close();
            return false;
        }

        // insert new user
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $insertSql = "INSERT INTO edusogno_db.utenti (nome, cognome, email, password) VALUES (?, ?, ?, ?)";
        $insertStmt = $conn->prepare($insertSql);
        $insertStmt->bind_param("ssss", $name, $lastname, $email, $hashedPassword);

        if ($insertStmt->execute()) {
            $insertStmt->close();
            return new User($name, $lastname, $email, $hashedPassword);
        } else {
            $insertStmt->close();
            throw new Exception('Error occurred inserting user in database');
        }
    }

    public function create(string $name, string $lastname, string $email, string $password): void
    {
        try {
            $conn = DbUtil::getConnection();
            // check by email if the user already exists
            $checkSql = "SELECT email FROM edusogno_db.utenti WHERE email = ?";
            $checkStmt = $conn->prepare($checkSql);
            // using bind_param() to protect from SQL injection
            $checkStmt->bind_param("s", $email);
            $checkStmt->execute();
            $checkStmt->store_result();

            if ($checkStmt->num_rows > 0) {
                $checkStmt->close();
            }

            // insert new user
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            $insertSql = "INSERT INTO edusogno_db.utenti (nome, cognome, email, password) VALUES (?, ?, ?, ?)";
            $insertStmt = $conn->prepare($insertSql);
            $insertStmt->bind_param("ssss", $name, $lastname, $email, $hashedPassword);

            $insertStmt->close();
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function update(int $userId, string $name, string $lastname, string $email, string $password): bool
    {
        return 0;
    }

    public function delete($userId): bool
    {
        return 0;
    }

    public function validateGetUser(string $email, string $password): ?User
    {
        try {
            $conn = DbUtil::getConnection();
            $stmt = $conn->prepare("SELECT nome, cognome, email, password FROM edusogno_db.utenti WHERE email = ?");
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $stmt->bind_result($name, $lastname, $dbEmail, $hashedDbPassword);
            $stmt->fetch();
            $stmt->close();
            // verify hashed password in db
            if (password_verify($password, $hashedDbPassword)) {
                return new User($name, $lastname, $dbEmail, $hashedDbPassword);
            } else {
                return null;
            }
        } catch (Exception $e) {
            echo $e->getMessage();
            return null;
        }
    }

    public function getByEmail(string $email): ?User
    {
        try {
            $conn = DbUtil::getConnection();
            $stmt = $conn->prepare("SELECT nome, cognome, email, password FROM edusogno_db.utenti WHERE email = ?");
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $stmt->bind_result($name, $lastname, $email, $hashedPassword);

            if ($stmt->fetch()) {
                $stmt->execute();
                $stmt->close();
                return new User($name, $lastname, $email, $hashedPassword);
            } else {
                $stmt->close();
                return null;
            }
        } catch (Exception $e) {
            echo $e->getMessage();
            return null;
        }
    }

    public function getUserByPasswordResetToken($token): ?User
    {
        try {
            $conn = DbUtil::getConnection();

            $query = "SELECT * FROM edusogno_db.utenti WHERE reset_token = ?";
            $stmt = $conn->prepare($query);
            $stmt->bind_param('s', $token);
            $stmt->execute();
            $result = $stmt->get_result();

            /// Check if a user with the token exists
            if ($result->num_rows === 1) {
                $userData = $result->fetch_assoc();
                $stmt->close();

                return new User(
                    $userData['nome'],
                    $userData['cognome'],
                    $userData['email'],
                    $userData['password']
                );
            } else {
                // token is invalid or not found
                $stmt->close();
                return null;
            }
        } catch (Exception $e) {
            echo $e->getMessage();
            return null;
        }
    }

    public function changePassword(string $userToken, string $newPassword): bool
    {
        $userDao = new UserDAOImpl();
        $userEmail = $userDao
            ->getUserByPasswordResetToken($userToken)
            ->getEmail();

        try {
            $conn = new mysqli('localhost','root', 'root', 'edusogno_db'); // todo tofix using dbutil::getConnection throws exception

            $newHashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
            $updateSql = "UPDATE edusogno_db.utenti SET password = ? WHERE email = ?";
            $updateStmt = $conn->prepare($updateSql);
            $updateStmt->bind_param("ss", $newHashedPassword, $userEmail);
            $updateStmt->execute();
            $updateStmt->close();

            // remove the token from the database
            $updateTokenSql = "UPDATE edusogno_db.utenti SET reset_token = NULL WHERE reset_token = ?";
            $updateTokenStmt = $conn->prepare($updateTokenSql);
            $updateTokenStmt->bind_param("s", $userToken);
            $updateTokenStmt->execute();
            $updateTokenStmt->close();

            return true;

        } catch (Exception $e) {
            echo $e->getMessage();
            return false;
        }
    }
}