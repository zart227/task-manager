<?php
require_once __DIR__ . '/../vendor/autoload.php';

use Repositories\TaskRepository;
use DB\DBConnection;

// Инициализация компонентов
$dbConnection = DBConnection::getInstance()->connect();
$taskRepository = new TaskRepository($dbConnection);

// Получаем все задачи
$tasks = $taskRepository->getAllTasks();

include __DIR__ . '/../templates/tasks.php';
