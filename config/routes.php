<?php

use Arthur\TaskManager\Controllers\TaskController;
use Arthur\TaskManager\Controllers\UserController;
use Arthur\TaskManager\Services\AuthService;
use Arthur\TaskManager\Services\SessionManager;
use Arthur\TaskManager\Repositories\UserRepository;
use Arthur\TaskManager\Repositories\TaskRepository;
use Arthur\TaskManager\Factories\TaskFactory;

// Функция маршрутизации
function handleRoute(string $requestUri)
{
    // Создаем зависимости
    $userRepository = new UserRepository();              // Репозиторий пользователя
    $authService = new AuthService($userRepository);     // Сервис авторизации
    $sessionManager = new SessionManager();              // Менеджер сессий
    $taskRepository = new TaskRepository();              // Репозиторий задач
    $taskFactory = new TaskFactory();                    // Фабрика задач

    // Создаем экземпляры контроллеров
    $userController = new UserController($authService, $sessionManager);
    
    // Проверка на авторизацию для защищенных маршрутов
    $protectedRoutes = ['/tasks', '/task/create', '/task/edit', '/task/delete'];
    foreach ($protectedRoutes as $route) {
        if (strpos($requestUri, $route) === 0 && !isset($_SESSION['user_id'])) {
            header('Location: /login');
            exit();
        }
    }
       
    $taskController = new TaskController($taskRepository, $taskFactory);

    // Выполняем маршрутизацию
    switch ($requestUri) {
        case '/':
            include __DIR__ . '/../templates/home.php';
            break;

        case '/tasks':
            $taskController->index();
            break;

        case '/task/create':
            $taskController->create();
            break;

        case (preg_match('/^\/task\/edit\/(\d+)$/', $requestUri, $matches) ? true : false):
            $taskId = (int)$matches[1];
            $taskController->edit($taskId);
            break;

        case (preg_match('/^\/task\/delete\/(\d+)$/', $requestUri, $matches) ? true : false):
            $taskId = (int)$matches[1];
            $taskController->delete($taskId);
            break;

        case '/register':
            $userController->register();
            break;

        case '/login':
            $userController->login();
            break;

        case '/logout':
            $userController->logout();
            break;

        default:
            http_response_code(404);
            include __DIR__ . '/../templates/404.php';
            break;
    }
}
