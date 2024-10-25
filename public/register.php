<?php
require_once __DIR__ . '/../vendor/autoload.php';

use Arthur\TaskManager\Repositories\UserRepository;
use Arthur\TaskManager\Services\AuthService;
use Arthur\TaskManager\DB\DBConnection;

// Инициализация компонентов
$dbConnection = DBConnection::getInstance()->connect();
$userRepository = new UserRepository($dbConnection);
$authService = new AuthService($userRepository);

// Обработка данных формы
$message = '';  // Переменная для сообщения
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? null;
    $password = $_POST['password'] ?? null;
    $email = $_POST['email'] ?? null;  // Добавляем email


    // Проверка длины имени пользователя, пароля и наличия email
    if (strlen($username) < 3 || strlen($password) < 6 || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $message = "Имя пользователя должно быть не менее 3 символов, пароль — не менее 6 символов, и введите корректный email.";
    } else {
        // Проверяем, существует ли пользователь с таким именем
        $existingUser = $userRepository->getUserByUsername($username);
        if ($existingUser) {
            $message = "Пользователь с таким именем уже существует. Пожалуйста, выберите другое имя.";
        } else {
            // Регистрируем пользователя
            if ($authService->register($username, $password, $email)) {
                // После успешной регистрации, перенаправляем на страницу логина
                header('Location: /login.php');
                exit();
            } else {
                $message = "Ошибка регистрации. Пользователь с таким именем уже существует или произошла другая ошибка.";
            }
        }
    }
}

// Подключаем шаблон и передаем $message
include __DIR__ . '/../templates/register.php';
