<?php

namespace Dao;

interface UserDAO
{
    public function create(string $name, string $lastname, string $email, string $password): bool;

    public function update(int $userId, string $name, string $lastname, string $email, string $password): bool;

    public function delete($userId): bool;

    public function validateUser(string $email, string $password): bool;
}