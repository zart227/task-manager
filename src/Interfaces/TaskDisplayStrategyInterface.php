<?php
namespace Arthur\TaskManager\Interfaces;

/**
 * Интерфейс для стратегий отображения задач.
 */
interface TaskDisplayStrategyInterface
{
    public function display(array $tasks): void;
}
