<?php

namespace Application\Models;

class Author
{
    private ?int $id;
    private string $email;
    private string $pseudonym;
    private string $password;

    public function __construct(?int $id, string $email, string $pseudonym, string $password)
    {
        $this->id = $id;
        $this->email = $email;
        $this->pseudonym = $pseudonym;
        $this->password = $password;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getPseudonym(): string
    {
        return $this->pseudonym;
    }

    public function getPassword(): string
    {
        return $this->password;
    }
}