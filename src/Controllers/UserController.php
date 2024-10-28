<?php

namespace Arthur\TaskManager\Controllers;

use Arthur\TaskManager\Services\AuthService;
use Arthur\TaskManager\Services\SessionManager;
use Arthur\TaskManager\Models\User;

class UserController
{
    private AuthService $authService;
    private SessionManager $sessionManager;

    public function __construct(AuthService $authService, SessionManager $sessionManager)
    {
        $this->authService = $authService;
        $this->sessionManager = $sessionManager;
    }

    /**
     * Регистрация пользователя.
     */
    public function register()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'] ?? null;
            $password = $_POST['password'] ?? null;
            $email = $_POST['email'] ?? null;

            if (strlen($username) < 3 || strlen($password) < 6) {
                $message = "Имя пользователя должно быть не менее 3 символов, а пароль — не менее 6 символов.";
            } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $message = "Введите корректный адрес электронной почты.";
            } elseif ($this->authService->userExists($username)) {
                $message = "Пользователь с таким именем уже существует. Пожалуйста, выберите другое имя.";
            } elseif ($this->authService->emailExists($email)) {
                $message = "Пользователь с таким email уже зарегистрирован. Пожалуйста, выберите другой email.";
            } else {
                $user = $this->authService->register($username, $password, $email);
                if ($user instanceof User) {
                    $message = "Пользователь успешно зарегистрирован! Пожалуйста, войдите.";
                    header('Location: /login');  // Перенаправление на страницу логина после успешной регистрации
                    exit;
                } else {
                    $message = "Ошибка при регистрации. Попробуйте еще раз позже.";
                }
            }
        }

        include __DIR__ . '/../../views/users/register.php';
    }


    /**
     * Авторизация пользователя.
     */
    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'] ?? null;
            $password = $_POST['password'] ?? null;

            $user = $this->authService->login($username, $password);

            if ($user) {
                $this->sessionManager->startSession();
                $this->sessionManager->setSessionData('user_id', $user->getId());
                header('Location: /tasks');  // Перенаправление на список задач после входа
                exit;
            } else {
                $message = "Неверное имя пользователя или пароль.";
            }
        }

        include __DIR__ . '/../../views/users/login.php';
    }

    /**
     * Выход из системы.
     */
    public function logout()
    {
        $this->sessionManager->destroySession();
        header('Location: /login');
        exit;
    }
}
