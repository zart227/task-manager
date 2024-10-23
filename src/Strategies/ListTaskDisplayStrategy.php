<?php
namespace Strategies;

use Interfaces\TaskDisplayStrategyInterface;

/**
 * Паттерн Strategy для отображения задач в виде простого списка.
 */
class ListTaskDisplayStrategy implements TaskDisplayStrategyInterface
{
    public function display(array $tasks): void
    {
        foreach ($tasks as $task) {
            echo htmlspecialchars($task->getName()) . '<br>';
        }
    }
}
