<?php

namespace Dao;

use Util\DbUtil;

require_once "Util/DbUtil.php";

class UserDAO
{
    public static function create($name, $lastname, $email, $password): bool
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

    public static function update($userId, $name, $lastname, $email, $password)
    {
        // TODO: Implement update() method.
    }

    public static function delete($userId)
    {
        // TODO: Implement delete() method.
    }

    public static function validateUser($email, $password): bool
    {
        // Get the database connection using DbUtil::getConnection()
        $conn = DbUtil::getConnection();

        // Prepare the SQL statement to fetch the user with the given email
        $stmt = $conn->prepare("SELECT email, password FROM edusogno_db.utenti WHERE email = ?");
        $stmt->bind_param("s", $email);

        // Execute the statement
        $stmt->execute();

        // Bind the result to variables
        $stmt->bind_result($dbEmail, $dbPassword);

        // Fetch the result
        $stmt->fetch();

        // Close the statement
        $stmt->close();

        // Verify the password (You should use password_hash() for storing passwords)
        if (password_verify($password, $dbPassword)) {
            // Password is correct, return true
            return true;
        } else {
            // Password is incorrect, return false
            return false;
        }
    }
}