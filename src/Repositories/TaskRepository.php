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

    public function createTask(string $name, string $description, int $userId, ?int $parentId, string $status): Task
    {
        $query = "INSERT INTO tasks (name, description, user_id, parent_id, status, created_at, updated_at)
                  VALUES (:name, :description, :user_id, :parent_id, :status, NOW(), NOW())";

        $statement = $this->dbConnection->prepare($query);
        $statement->execute([
            'name' => $name,
            'description' => $description,
            'user_id' => $userId,
            'parent_id' => $parentId,
            'status' => $status
        ]);

        $id = $this->dbConnection->lastInsertId();
        return new Task($name, $description, $userId, $parentId, $status, '', '', $id);
    }

    public function getTaskById(int $id): ?Task
    {
        $stmt = $this->dbConnection->prepare('SELECT * FROM tasks WHERE id = :id');
        $stmt->execute(['id' => $id]);

        $taskData = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($taskData) {
            return new Task(
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

        return null; // Если задача не найдена
    }

    public function updateTask(Task $task): bool
    {
        $stmt = $this->dbConnection->prepare('UPDATE tasks SET name = :name, description = :description, user_id = :user_id, parent_id = :parent_id, status = :status, updated_at = NOW() WHERE id = :id');
        return $stmt->execute([
            'name' => $task->getName(),
            'description' => $task->getDescription(),
            'user_id' => $task->getUserId(),
            'parent_id' => $task->getParentId(),
            'status' => $task->getStatus(),
            'id' => $task->getId(),
        ]);
    }

    public function deleteTask(int $id): bool
    {
        $stmt = $this->dbConnection->prepare('DELETE FROM tasks WHERE id = :id');
        return $stmt->execute(['id' => $id]);
    }

    public function getTasksByUserId(int $userId): array
    {
        $stmt = $this->dbConnection->prepare('SELECT * FROM tasks WHERE user_id = :user_id');
        $stmt->execute(['user_id' => $userId]);
        $tasks = $stmt->fetchAll(PDO::FETCH_ASSOC);

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
