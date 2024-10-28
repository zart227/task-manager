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
    private string $email;

    public function __construct(int $id, string $username, string $password, string $email)
    {
        $this->id = $id;
        $this->username = $username;
        $this->password = $password;
        $this->email = $email;
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

    public function getEmail(): string
    {
        return $this->email;
    }

        // Сеттеры (если нужно будет изменять данные)
        public function setUsername(string $username): void
        {
            $this->username = $username;
        }
    
        public function setPassword(string $password): void
        {
            $this->password = $password;
        }
    
        public function setEmail(string $email): void
        {
            $this->email = $email;
        }
}
