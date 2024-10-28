<?php
namespace Arthur\TaskManager\Factories;

use Arthur\TaskManager\Models\Task;
use Arthur\TaskManager\Interfaces\TaskFactoryInterface;

/**
 * Паттерн Factory Method для создания объектов Task.
 * Делегирует создание объектов задач фабричным методам.
 */
class TaskFactory implements TaskFactoryInterface
{
    public function createTask(string $name, string $description, int $userId, ?int $parentId = null, string $status = 'in_progress'): Task
    {
        return new Task($name, $description, $userId, $parentId, $status);
    }
}
