<?php
namespace Interfaces;

use Models\Task;

/**
 * Интерфейс для фабрики задач.
 */
interface TaskFactoryInterface
{
    public function createTask(string $name, ?int $parentId = null): Task;
}
