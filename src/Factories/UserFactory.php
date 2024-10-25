<?php
namespace Arthur\TaskManager\Factories;

use Arthur\TaskManager\Models\User;
use Arthur\TaskManager\Interfaces\UserFactoryInterface;

/**
 * Паттерн Factory Method для создания объектов User.
 * Позволяет управлять процессом создания пользователей.
 */
class UserFactory implements UserFactoryInterface
{
    public function createUser(string $username, string $password): User
    {
        return new User($username, $password);
    }
}
