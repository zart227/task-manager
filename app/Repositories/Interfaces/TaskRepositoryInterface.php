<?php

namespace App\Repositories\Interfaces;

use App\Models\Task;
use Illuminate\Database\Eloquent\Collection;

interface TaskRepositoryInterface
{
    public function createTask(
        string $name,
        string $description,
        int $userId,
        ?int $parentId,
        string $status,
        ?string $imagePath = null
    ): Task;

    public function getTaskById(int $id): ?Task;

    public function updateTask(Task $task): bool;

    public function deleteTask(int $id): bool;

    public function getTasksByUserId(int $userId): Collection;

    public function getAllTasks(): Collection;
} 