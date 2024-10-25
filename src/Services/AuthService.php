<?php
namespace Arthur\TaskManager\Services;

use Arthur\TaskManager\Repositories\UserRepository;
use Arthur\TaskManager\Models\User;

class AuthService
{
    private UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function register(string $username, string $password, string $email): bool
    {
        // Проверяем, существует ли пользователь с таким именем
        $existingUser = $this->userRepository->getUserByUsername($username);
        if ($existingUser) {
            return false; // Пользователь уже существует
        }

        // Хешируем пароль
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Создаем нового пользователя
        $user = $this->userRepository->createUser($username, $hashedPassword, $email);

        // Если создание прошло успешно, возвращаем true
        if ($user instanceof User) {
            return true;
        }

        return false;
    }

    public function login(string $username, string $password): ?User
    {
        $user = $this->userRepository->getUserByUsername($username);
    
        if ($user && password_verify($password, $user->getPassword())) {
            return $user;
        }
    
        return null;
    }
}
