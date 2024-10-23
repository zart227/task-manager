<?php
namespace Strategies;

use Interfaces\TaskDisplayStrategyInterface;

/**
 * Паттерн Strategy для отображения задач в виде дерева.
 * Позволяет изменять алгоритм отображения задач.
 */
class TreeTaskDisplayStrategy implements TaskDisplayStrategyInterface
{
    public function display(array $tasks): void
    {
        // Логика древовидного отображения задач
        function displayTasks(array $tasks, ?int $parentId = null, int $level = 0): void {
            foreach ($tasks as $task) {
                if ($task->getParentId() === $parentId) {
                    echo str_repeat('&nbsp;', $level * 4) . htmlspecialchars($task->getName()) . '<br>';
                    displayTasks($tasks, $task->getId(), $level + 1);
                }
            }
        }
        
        displayTasks($tasks);
    }
}
