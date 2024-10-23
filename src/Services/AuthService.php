<?php
namespace Services;

use Repositories\UserRepository;

/**
 * Сервис для обработки регистрации и аутентификации пользователей.
 */
class AuthService
{
    private UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function register(string $username, string $password)
    {
        // Логика регистрации пользователя через UserRepository
        $this->userRepository->createUser([
            'username' => $username,
            'password' => password_hash($password, PASSWORD_BCRYPT),
        ]);
    }
}
