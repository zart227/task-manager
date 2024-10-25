<?php
namespace Arthur\TaskManager\Interfaces;

use Arthur\TaskManager\Models\Task;

/**
 * Интерфейс для работы с задачами.
 * Определяет методы для работы с объектом Task.
 */
interface TaskRepositoryInterface
{
    public function createTask(string $name, string $description, int $userId, ?int $parentId, string $status): Task;

    public function getTaskById(int $id): ?Task;

    public function updateTask(Task $task): bool;

    public function deleteTask(int $id): bool;

    public function getTasksByUserId(int $userId): array;

    public function getAllTasks(): array;
}
