<?php

namespace Dao;

use Model\User;

interface UserDAO
{
    public function createGetUser(string $name, string $lastname, string $email, string $password): User|bool;

    public function update(int $userId, string $name, string $lastname, string $email, string $password): bool;

    public function delete($userId): bool;

    public function validateGetUser(string $email, string $password): ?User;

    public function getUserByPasswordResetToken($token): ?User;

    public function changePassword(string $userToken, string $newPassword): bool;
}