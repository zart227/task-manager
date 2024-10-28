<?php

namespace Arthur\TaskManager\Controllers;

use Arthur\TaskManager\Facades\TaskManagerFacade;
use Arthur\TaskManager\Repositories\TaskRepository;
use Arthur\TaskManager\Factories\TaskFactory;
use Arthur\TaskManager\Strategies\TreeTaskDisplayStrategy;
use Arthur\TaskManager\Strategies\ListTaskDisplayStrategy;
use Arthur\TaskManager\Interfaces\TaskDisplayStrategyInterface;

class TaskController
{
    private TaskManagerFacade $taskManager;
    private TaskDisplayStrategyInterface $displayStrategy;
    private ?int $userId;  // Переменная для хранения идентификатора пользователя

    public function setDisplayStrategy(TaskDisplayStrategyInterface $strategy)
    {
        $this->displayStrategy = $strategy;
    }

    public function __construct(TaskRepository $taskRepository, TaskFactory $taskFactory)
    {        
        $this->userId = $_SESSION['user_id'] ?? null;
   
        // Инициализация объекта TaskManagerFacade
        
        $this->taskManager = new TaskManagerFacade($taskRepository, $taskFactory);
     
        // Устанавливаем стратегию отображения задач
        $this->setDisplayStrategy(new TreeTaskDisplayStrategy());
    }

    // Метод для отображения списка задач
    public function index()
    {
        $tasks = $this->taskManager->getTasksByUserId($this->userId);

        // Передаем задачи и стратегию отображения в представление
        $displayStrategy = $this->displayStrategy;

        require_once __DIR__ . '/../../views/tasks/index.php';
    }

    // Метод для отображения задач с помощью стратегии
    public function displayTasks(array $tasks)
    {
        $this->displayStrategy->display($tasks);
    }

    // Метод для создания задачи
    public function create()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'];
            $description = $_POST['description'];
            $status = $_POST['status'];

            // Проверяем наличие parentId и приводим его к типу int, если он присутствует
            $parentId = !empty($_POST['parent_id']) ? (int)$_POST['parent_id'] : null;

            if ($this->userId) {
                $this->taskManager->createAndSaveTask($name, $description, $this->userId, $parentId, $status);
                header('Location: /tasks');
                exit();
            } else {
                echo "Ошибка: Пользователь не авторизован.";
            }
        }

        $tasks = $this->taskManager->getTasksByUserId($this->userId);
        require_once __DIR__ . '/../../views/tasks/create.php';
    }

    // Метод для редактирования задачи
    public function edit(int $taskId)
    {
        
        $task = $this->taskManager->getTaskById($taskId);
        
        if (!$task) {
            http_response_code(404);
            echo "Ошибка: задача не найдена.";
            return;
        }

        // Проверка, что задача принадлежит текущему пользователю
        if ($task->getUserId() !== $this->userId) {
            http_response_code(403);
            echo "Ошибка: у вас нет прав на редактирование этой задачи.";
            return;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'];
            $description = $_POST['description'];
            $status = $_POST['status'];
            
            $this->taskManager->updateTask($taskId, $name, $description, $status);
            header('Location: /tasks');
            exit();
        }

        //$task = $this->taskManager->getTaskById($taskId);
        require_once __DIR__ . '/../../views/tasks/edit.php';
    }

    // Метод для удаления задачи
    public function delete(int $taskId)
    {
        $task = $this->taskManager->getTaskById($taskId);

        if (!$task) {
            http_response_code(404);
            echo "Ошибка: задача не найдена.";
            return;
        }

        // Проверка, что задача принадлежит текущему пользователю
        if ($task->getUserId() !== $this->userId) {
            http_response_code(403);
            echo "Ошибка: у вас нет прав на удаление этой задачи.";
            return;
        }

        $this->taskManager->deleteTask($taskId);
        header('Location: /tasks');
        exit();
    }
}
