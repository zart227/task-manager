<?php
namespace Arthur\TaskManager\Interfaces;

use Arthur\TaskManager\Models\Task;

/**
 * Интерфейс для фабрики задач.
 */
interface TaskFactoryInterface
{
    public function createTask(string $name, string $description, int $userId, ?int $parentId = null, string $status = 'in_progress'): Task;
}
