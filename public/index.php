<?php

// Подключаем автозагрузку классов через Composer
require_once __DIR__ . '/../vendor/autoload.php';

// Начало сессии (если требуется)
session_start();

// Проверяем, какой URL запрашивается
$requestUri = $_SERVER['REQUEST_URI'];

// Пример простой маршрутизации
switch ($requestUri) {
    case '/':
        // Главная страница
        include __DIR__ . '/../templates/home.php';
        break;
    
    case '/register':
        // Страница регистрации
        include __DIR__ . '/register.php';
        break;

    case '/login':
        // Страница входа
        include __DIR__ . '/login.php';
        break;       
    
    case '/tasks':
        // Страница задач
        include __DIR__ . '/tasks.php';
        break;

    default:
        // Страница 404 (страница не найдена)
        http_response_code(404);
        include __DIR__ . '/../templates/404.php';
        break;
}
