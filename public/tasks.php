<?php
require_once __DIR__ . '/../vendor/autoload.php';

use Facades\TaskManagerFacade;
use Repositories\TaskRepository;
use Factories\TaskFactory;
use DB\DBConnection;
use Strategies\TreeTaskDisplayStrategy; // или ListTaskDisplayStrategy

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
