<?php
namespace Repositories;

use Models\Task;
use Interfaces\TaskRepositoryInterface;
use PDO;

/**
 * Репозиторий для работы с задачами.
 */
class TaskRepository implements TaskRepositoryInterface
{
    private PDO $dbConnection;

    public function __construct(PDO $dbConnection)
    {
        $this->dbConnection = $dbConnection;
    }

    public function createTask(array $data): Task
    {
        // Логика создания задачи
        return new Task($data['name'], $data['parent_id']);
    }

    public function getTaskById(int $id): ?Task
    {
        // Логика получения задачи по ID
        return null; // Пример
    }

    public function updateTask(Task $task): bool
    {
        // Логика обновления задачи
        return true; // Пример
    }

    public function deleteTask(int $id): bool
    {
        // Логика удаления задачи
        return true; // Пример
    }

    public function getTasksByUserId(int $userId): array
    {
        // Логика получения задач пользователя
        return []; // Пример
    }
}
