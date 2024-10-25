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

    public function createUser(string $username, string $password, string $email): User
    {
        $stmt = $this->dbConnection->prepare('INSERT INTO users (username, password, email) VALUES (:username, :password, :email)');
        $stmt->execute([
            'username' => $username,
            'password' => $password,
            'email' => $email
        ]);
    
        return new User($this->dbConnection->lastInsertId(), $username, $password, $email);
    }

    public function getUserById(int $id): ?User
    {
        // Получаем пользователя по ID
        $stmt = $this->dbConnection->prepare('SELECT * FROM users WHERE id = :id');
        $stmt->execute(['id' => $id]);
    
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
    
        if ($data) {
            return new User(
                $data['id'],
                $data['username'],
                $data['password'],
                $data['email']  // Передаем email как четвертый аргумент
            );
        }
    
        return null;
    }


    public function getUserByUsername(string $username): ?User
    {
        $stmt = $this->dbConnection->prepare('SELECT * FROM users WHERE username = :username');
        $stmt->execute(['username' => $username]);
        $userData = $stmt->fetch(PDO::FETCH_ASSOC);
    
        if ($userData) {
            return new User(
                $userData['id'],
                $userData['username'],
                $userData['password'],
                $userData['email']  // Передаем email как четвертый аргумент
            );
        }
    
        return null;  // Если пользователь не найден
    }

    public function updateUser(User $user): bool
    {
        // Логика обновления данных пользователя
        $stmt = $this->dbConnection->prepare('UPDATE users SET username = :username, password = :password WHERE id = :id');
        return $stmt->execute([
            'username' => $user->getUsername(),
            'password' => $user->getPassword(),
            'id' => $user->getId(),
        ]);
    }

    public function deleteUser(int $id): bool
    {
        // Удаление пользователя
        $stmt = $this->dbConnection->prepare('DELETE FROM users WHERE id = :id');
        return $stmt->execute(['id' => $id]);
    }
}
