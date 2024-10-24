<?php
namespace Arthur\TaskManager\Interfaces;

/**
 * Интерфейс для подключения к базе данных.
 * Определяет метод для создания подключения.
 */
interface DBConnectionInterface
{
    /**
     * Подключение к базе данных.
     * @return \PDO
     */
    public function connect(): \PDO;
}
