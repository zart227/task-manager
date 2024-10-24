<?php
namespace Arthur\TaskManager\Facades;

use Arthur\TaskManager\Repositories\TaskRepository;
use Arthur\TaskManager\Factories\TaskFactory;

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

    public function createAndSaveTask(string $name, string $description, int $userId, ?int $parentId = null, string $status = 'in_progress')
    {
        $task = $this->taskFactory->createTask($name, $description, $userId, $parentId, $status);
        $this->taskRepository->createTask([
            'name' => $name,
            'description' => $description,
            'user_id' => $userId,
            'parent_id' => $parentId,
            'status' => $status
        ]);
    }

    public function getAllTasks(): array
    {
        return $this->taskRepository->getAllTasks();
    }
}
