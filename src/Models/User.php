<?php
namespace Arthur\TaskManager\Models;

/**
 * Класс, представляющий пользователя.
 */
class User
{
    private int $id;
    private string $username;
    private string $password;

    public function __construct(string $username, string $password, int $id = 0)
    {
        $this->id = $id;
        $this->username = $username;
        $this->password = $password;
    }

    // Геттеры
    public function getId(): int
    {
        return $this->id;
    }

    public function getUsername(): string
    {
        return $this->username;
    }

    public function getPassword(): string
    {
        return $this->password;
    }
}
