<?php

namespace Model;

class User
{

    private string $role;
    private string $name;
    private string $lastname;
    private string $email;
    private string $hashedPassword;
    private ?string $resetToken;

    public function __construct($role, $name, $lastname, $email, $hashedPassword)
    {
        $this->role = $role;
        $this->name = $name;
        $this->lastname = $lastname;
        $this->email = $email;
        $this->hashedPassword = $hashedPassword;
        $this->resetToken = null;
    }

    public function getRole(): string
    {
        return $this->role;
    }

    public function setRole(string $role): void
    {
        $this->role = $role;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getLastname(): string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): void
    {
        $this->lastname = $lastname;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function getHashedPassword(): string
    {
        return $this->hashedPassword;
    }

    public function setHashedPassword(string $hashedPassword): void
    {
        $this->hashedPassword = $hashedPassword;
    }

    public function getResetToken(): ?string
    {
        return $this->resetToken;
    }

    public function setResetToken(?string $resetToken): void
    {
        $this->resetToken = $resetToken;
    }
}