<?php
namespace Interfaces;

use Models\Task;

/**
 * Интерфейс для работы с задачами.
 * Определяет методы для работы с объектом Task.
 */
interface TaskRepositoryInterface
{
    public function createTask(array $data): Task;

    public function getTaskById(int $id): ?Task;

    public function updateTask(Task $task): bool;

    public function deleteTask(int $id): bool;

    public function getTasksByUserId(int $userId): array;
}
