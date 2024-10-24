<?php
require_once __DIR__ . '/../vendor/autoload.php';

use Arthur\TaskManager\Facades\TaskManagerFacade;
use Arthur\TaskManager\Repositories\TaskRepository;
use Arthur\TaskManager\Factories\TaskFactory;
use Arthur\TaskManager\DB\DBConnection;
use Arthur\TaskManager\Strategies\TreeTaskDisplayStrategy; // или ListTaskDisplayStrategy

// Инициализация компонентов
$dbConnection = DBConnection::getInstance()->connect();
$taskRepository = new TaskRepository($dbConnection);
$taskFactory = new TaskFactory();
$taskManager = new TaskManagerFacade($taskRepository, $taskFactory);

// Получаем все задачи через фасад
$tasks = $taskManager->getAllTasks();

// Выбираем стратегию отображения (древовидную или списочную)
$displayStrategy = new TreeTaskDisplayStrategy();
$displayStrategy->display($tasks);
