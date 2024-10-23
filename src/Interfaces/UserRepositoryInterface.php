<?php
namespace Interfaces;

use Models\User;

/**
 * Интерфейс для работы с пользователями.
 * Определяет методы для работы с объектом User.
 */
interface UserRepositoryInterface
{
    public function createUser(array $data): User;

    public function getUserById(int $id): ?User;

    public function updateUser(User $user): bool;

    public function deleteUser(int $id): bool;
}
