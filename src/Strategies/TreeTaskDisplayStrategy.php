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
        $this->displayTasks($tasks);
    }

    private function displayTasks(array $tasks, ?int $parentId = null, int $level = 0): void
    {
        foreach ($tasks as $task) {
            if ($task->getParentId() === $parentId) {
                // Подключаем отдельное представление для каждой задачи
                include __DIR__ . '/../../views/tasks/task_card.php';
                
                // Рекурсивный вызов для отображения подзадач
                $this->displayTasks($tasks, $task->getId(), $level + 1);
            }
        }
    }
}
