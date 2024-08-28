<?php

namespace App\DTO;

class UserDTO
{
    private $id;
    private $name;
    private $email;
    private $password;

    public function __construct(string $id, string $name, string $email, string $password)
    {
        $this->id       = $id;
        $this->name     = $name;
        $this->email    = $email;
        $this->password = $password;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getPassword(): string
    {
        return $this->password;
    }
}
