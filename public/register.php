<?php
require_once __DIR__ . '/../vendor/autoload.php';

use Repositories\UserRepository;
use Services\AuthService;
use DB\DBConnection;

// Инициализация компонентов
$dbConnection = DBConnection::getInstance()->connect();
$userRepository = new UserRepository($dbConnection);
$authService = new AuthService($userRepository);

// Обработка данных формы
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? null;
    $password = $_POST['password'] ?? null;

    if ($username && $password) {
        $authService->register($username, $password);
        echo "<div class='alert alert-success'>Пользователь " . htmlspecialchars($username) . " успешно зарегистрирован!</div>";
    } else {
        echo "<div class='alert alert-danger'>Пожалуйста, заполните все поля.</div>";
    }
}

include __DIR__ . '/../templates/register.php';
