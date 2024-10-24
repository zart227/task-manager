<?php
namespace Arthur\TaskManager\Repositories;

use Arthur\TaskManager\Models\User;
use Arthur\TaskManager\Interfaces\UserRepositoryInterface;
use PDO;

/**
 * Репозиторий для работы с пользователями.
 */
class UserRepository implements UserRepositoryInterface
{
    private PDO $dbConnection;

    public function __construct(PDO $dbConnection)
    {
        $this->dbConnection = $dbConnection;
    }

    public function createUser(array $data): User
    {
        // Реализация создания пользователя
        $stmt = $this->dbConnection->prepare('INSERT INTO users (username, password) VALUES (:username, :password)');
        $stmt->execute([
            'username' => $data['username'],
            'password' => password_hash($data['password'], PASSWORD_BCRYPT),
        ]);
        return new User($data['username'], $data['password'], $this->dbConnection->lastInsertId());
    }

    public function getUserById(int $id): ?User
    {
        // Логика получения пользователя по ID
        return null; // Пример
    }

    public function updateUser(User $user): bool
    {
        // Логика обновления данных пользователя
        return true; // Пример
    }

    public function deleteUser(int $id): bool
    {
        // Логика удаления пользователя
        return true; // Пример
    }
}
