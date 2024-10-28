<?php

// Подключаем автозагрузку классов через Composer
require_once __DIR__ . '/../vendor/autoload.php';

// Запуск сессии
session_start();

// Подключаем маршруты
require_once __DIR__ . '/../config/routes.php';

// Получаем URI запроса
$requestUri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// Обработка маршрута
handleRoute($requestUri);
