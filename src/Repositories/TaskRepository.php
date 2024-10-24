<?php
namespace Arthur\TaskManager\Repositories;

use Arthur\TaskManager\Models\Task;
use Arthur\TaskManager\Interfaces\TaskRepositoryInterface;
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
        $query = "INSERT INTO tasks (name, description, user_id, parent_id, status, created_at, updated_at)
                  VALUES (:name, :description, :user_id, :parent_id, :status, NOW(), NOW())";

        $statement = $this->dbConnection->prepare($query);
        $statement->execute([
            'name' => $data['name'],
            'description' => $data['description'],
            'user_id' => $data['user_id'],
            'parent_id' => $data['parent_id'],
            'status' => $data['status']
        ]);

        $id = $this->dbConnection->lastInsertId();
        return new Task($data['name'], $data['description'], $data['user_id'], $data['parent_id'], $data['status'], '', '', $id);
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

    public function getAllTasks(): array
    {
        $query = $this->dbConnection->query("SELECT * FROM tasks");
        $tasks = $query->fetchAll(PDO::FETCH_ASSOC);

        $taskObjects = [];
        foreach ($tasks as $taskData) {
            $taskObjects[] = new Task(
                $taskData['name'],
                $taskData['description'],
                $taskData['user_id'],
                $taskData['parent_id'],
                $taskData['status'],
                $taskData['created_at'],
                $taskData['updated_at'],
                $taskData['id']
            );
        }

        return $taskObjects;
    }
}
