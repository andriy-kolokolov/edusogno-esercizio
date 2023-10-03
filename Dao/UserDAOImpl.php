<?php

namespace Dao;

use Exception;
use Model\User;
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
        $conn = DbUtil::getConnection();
        $stmt = $conn->prepare("SELECT nome, cognome, email, password FROM edusogno_db.utenti WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->bind_result($name, $lastname, $dbEmail, $hashedDbPassword);
        $stmt->fetch();
        $stmt->close();
        // verify hashed password in db
        if (password_verify($password, $hashedDbPassword)) {
            // if password matches db record, return User object
            return new User($name, $lastname, $dbEmail, $hashedDbPassword);
        } else {
            return null;
        }
    }
}