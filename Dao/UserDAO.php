<?php

namespace Dao;

use Util\DbUtil;

require "Util/DbUtil.php";

class UserDAO
{
    public static function create($name, $lastname, $email, $password): bool
    {
        $conn = DbUtil::getConnection();
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $sql = "INSERT INTO edusogno_db.utenti (nome, cognome, email, password) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssss", $name, $lastname, $email, $hashedPassword);

        if ($stmt->execute()) {
            $stmt->close();
            return true;
        } else {
            $stmt->close();
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
}