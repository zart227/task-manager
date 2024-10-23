<?php
namespace Interfaces;

use Models\User;

/**
 * Интерфейс для фабрики пользователей.
 */
interface UserFactoryInterface
{
    public function createUser(string $username, string $password): User;
}
