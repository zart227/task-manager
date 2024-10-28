<?php
namespace Arthur\TaskManager\Facades;

use Arthur\TaskManager\Repositories\TaskRepository;
use Arthur\TaskManager\Factories\TaskFactory;
use Arthur\TaskManager\Models\Task;

/**
 * Паттерн Facade для управления задачами.
 * Упрощает взаимодействие с репозиториями и фабриками.
 */
class TaskManagerFacade
{
    private TaskRepository $taskRepository;
    private TaskFactory $taskFactory;

    public function __construct(TaskRepository $taskRepository, TaskFactory $taskFactory)
    {
        $this->taskRepository = $taskRepository;
        $this->taskFactory = $taskFactory;
    }

    public function createAndSaveTask(
        string $name, 
        string $description, 
        int $userId, 
        ?int $parentId = null, 
        string $status = 'in_progress'
    )
    {
        // Создаем задачу с использованием TaskFactory (если нужно)
        $task = $this->taskFactory->createTask(
            $name, 
            $description, 
            $userId, 
            $parentId, 
            $status
        );

        // Передаем отдельные параметры в createTask
        $this->taskRepository->createTask(
            $name, 
            $description, 
            $userId, 
            $parentId, 
            $status
        );
    }

    public function getAllTasks(): array
    {
        return $this->taskRepository->getAllTasks();
    }

    public function getTaskById(int $id): ?Task
    {
        return $this->taskRepository->getTaskById($id);
    }

    public function getTasksByUserId(int $userId): array
    {
        return $this->taskRepository->getTasksByUserId($userId);
    }

    public function updateTask(int $taskId, string $name, string $description, string $status): bool
    {
        $task = $this->getTaskById($taskId);
        if (!$task) {
            return false;
        }

        $task->setName($name);
        $task->setDescription($description);
        $task->setStatus($status);

        return $this->taskRepository->updateTask($task);
    }

    public function deleteTask(int $id): bool
    {
        return $this->taskRepository->deleteTask($id);
    }
}
