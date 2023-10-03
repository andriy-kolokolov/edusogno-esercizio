<?php

namespace Dao;

use Util\DbUtil;

class UserDAOImpl implements UserDAO
{
    // using bind_param() to protect application from SQL injection
    public function create(string $name, string $lastname, string $email, string $password): bool
    {
        $conn = DbUtil::getConnection();
        // check by email if the user already exists
        $checkSql = "SELECT email FROM edusogno_db.utenti WHERE email = ?";
        $checkStmt = $conn->prepare($checkSql);
        $checkStmt->bind_param("s", $email);
        $checkStmt->execute();
        $checkStmt->store_result();

        if ($checkStmt->num_rows > 0) {
            // if exists, return false
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
            return true;
        } else {
            $insertStmt->close();
            return false;
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

    public function validateUser(string $email, string $password): bool
    {
        $conn = DbUtil::getConnection();
        $stmt = $conn->prepare("SELECT email, password FROM edusogno_db.utenti WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->bind_result($dbEmail, $dbPassword);
        $stmt->fetch();
        $stmt->close();
        // verify hashed password in db
        if (password_verify($password, $dbPassword)) {
            // if password matches db record, return true
            return true;
        } else {
            return false;
        }
    }
}