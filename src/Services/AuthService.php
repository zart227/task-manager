<?php
namespace Arthur\TaskManager\Services;

use Arthur\TaskManager\Repositories\UserRepository;
use Arthur\TaskManager\Factories\UserFactory;

/**
 * Сервис для регистрации и аутентификации пользователей.
 */
class AuthService
{
    private UserRepository $userRepository;
    private UserFactory $userFactory;

    public function __construct(UserRepository $userRepository, UserFactory $userFactory)
    {
        $this->userRepository = $userRepository;
        $this->userFactory = $userFactory;
    }

    public function register(string $username, string $password)
    {
        // Создание пользователя через фабрику
        $user = $this->userFactory->createUser($username, $password);
        $this->userRepository->createUser($user);
    }
}
