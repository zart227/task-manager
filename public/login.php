<?php
require_once __DIR__ . '/../vendor/autoload.php';

use Arthur\TaskManager\Repositories\UserRepository;
use Arthur\TaskManager\Services\AuthService;
use Arthur\TaskManager\DB\DBConnection;
use Arthur\TaskManager\Services\SessionManager;

$dbConnection = DBConnection::getInstance()->connect();
$userRepository = new UserRepository($dbConnection);
$authService = new AuthService($userRepository);
$sessionManager = new SessionManager();

$message = ''; // Для отображения сообщений

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? null;
    $password = $_POST['password'] ?? null;

    if ($username && $password) {
        $user = $authService->login($username, $password);
        if ($user) {
            // Сохраняем информацию о пользователе в сессии
            $sessionManager->startSession();
            $sessionManager->setSessionData('user_id', $user->getId());
            $sessionManager->setSessionData('username', $user->getUsername());
            
            header('Location: /tasks.php');
            exit();
        } else {
            $message = 'Неверное имя пользователя или пароль.';
        }
    } else {
        $message = 'Пожалуйста, заполните оба поля.';
    }
}

// Включаем шаблон логина
include __DIR__ . '/../templates/login.php';
