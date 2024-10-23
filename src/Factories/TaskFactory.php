<?php
namespace Factories;

use Models\Task;
use Interfaces\TaskFactoryInterface;

/**
 * Паттерн Factory Method для создания объектов Task.
 * Делегирует создание объектов задач фабричным методам.
 */
class TaskFactory implements TaskFactoryInterface
{
    public function createTask(string $name, ?int $parentId = null): Task
    {
        return new Task($name, $parentId);
    }
}
