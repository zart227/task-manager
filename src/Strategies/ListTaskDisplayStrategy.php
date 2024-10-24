<?php 
namespace Arthur\TaskManager\Strategies;

use Arthur\TaskManager\Interfaces\TaskDisplayStrategyInterface;

/**
 * Паттерн Strategy для отображения задач в виде простого списка.
 */
class ListTaskDisplayStrategy implements TaskDisplayStrategyInterface
{
    public function display(array $tasks): void
    {
        foreach ($tasks as $task) {
            echo 'Название: ' . htmlspecialchars($task->getName()) . '<br>';
            echo 'Описание: ' . htmlspecialchars($task->getDescription()) . '<br>';
            echo 'Статус: ' . htmlspecialchars($task->getStatus()) . '<br><br>';
        }
    }
}
