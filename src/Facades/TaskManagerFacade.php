<?php
namespace Facades;

use Repositories\TaskRepository;
use Factories\TaskFactory;

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

    public function createAndSaveTask(string $name, ?int $parentId = null)
    {
        $task = $this->taskFactory->createTask($name, $parentId);
        $this->taskRepository->createTask($task);
    }

    public function getAllTasks(): array
    {
        return $this->taskRepository->getAllTasks();
    }
}
