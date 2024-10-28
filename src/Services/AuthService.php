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

     /**
     * Регистрация пользователя с проверкой уникальности имени и email.
     *
     * @param string $username
     * @param string $password
     * @param string $email
     * @return bool Возвращает true при успешной регистрации, иначе false.
     */
    public function register(string $username, string $password, string $email): bool
    {
        // Проверяем, существует ли пользователь с таким именем
        $existingUser = $this->userRepository->getUserByUsername($username);
        if ($existingUser) {
            return false; // Пользователь уже существует
        }

        // Проверка существующего email
        if ($this->userRepository->getUserByEmail($email)) {
            return false;
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

    /**
     * Авторизация пользователя.
     *
     * @param string $username
     * @param string $password
     * @return User|null Возвращает пользователя при успешной авторизации, иначе null.
     */

    public function login(string $username, string $password): ?User
    {
        $user = $this->userRepository->getUserByUsername($username);
    
        if ($user && password_verify($password, $user->getPassword())) {
            return $user;
        }
    
        return null;
    }


    /**
     * Проверка, существует ли пользователь с данным именем.
     *
     * @param string $username
     * @return bool
     */
    public function userExists(string $username): bool
    {
        return $this->userRepository->getUserByUsername($username) !== null;
    }

    /**
     * Проверка, существует ли пользователь с данным email.
     *
     * @param string $email
     * @return bool
     */
    public function emailExists(string $email): bool
    {
        return $this->userRepository->getUserByEmail($email) !== null;
    }
}
