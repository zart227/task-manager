<?php
namespace Arthur\TaskManager\Strategies;

use Arthur\TaskManager\Interfaces\TaskDisplayStrategyInterface;

/**
 * Паттерн Strategy для отображения задач в виде дерева.
 * Позволяет изменять алгоритм отображения задач.
 */
class TreeTaskDisplayStrategy implements TaskDisplayStrategyInterface
{
    public function display(array $tasks): void
    {
        function displayTasks(array $tasks, ?int $parentId = null, int $level = 0): void {
            foreach ($tasks as $task) {
                if ($task->getParentId() === $parentId) {
                    echo str_repeat('&nbsp;', $level * 4) . 'Название: ' . htmlspecialchars($task->getName()) . '<br>';
                    echo str_repeat('&nbsp;', $level * 4) . 'Описание: ' . htmlspecialchars($task->getDescription()) . '<br>';
                    echo str_repeat('&nbsp;', $level * 4) . 'Статус: ' . htmlspecialchars($task->getStatus()) . '<br><br>';
                    displayTasks($tasks, $task->getId(), $level + 1);
                }
            }
        }
        
        displayTasks($tasks);
    }
}
