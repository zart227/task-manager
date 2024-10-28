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
            // Подключаем отдельное представление для каждой задачи
            include __DIR__ . '/../../views/tasks/task_card.php';
        }
    }
}
