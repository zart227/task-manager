<?php
namespace Arthur\TaskManager\Interfaces;

use Arthur\TaskManager\Models\User;

/**
 * Интерфейс для фабрики пользователей.
 */
interface UserFactoryInterface
{
    public function createUser(string $username, string $password): User;
}
