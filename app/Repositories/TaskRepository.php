<?php

namespace App\Repositories;

use App\Models\Task;
use App\Repositories\Interfaces\TaskRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class TaskRepository implements TaskRepositoryInterface
{
    public function createTask(string $name, string $description, int $userId, ?int $parentId, string $status): Task
    {
        return Task::create([
            'name' => $name,
            'description' => $description,
            'user_id' => $userId,
            'parent_id' => $parentId,
            'status' => $status
        ]);
    }

    public function getTaskById(int $id): ?Task
    {
        return Task::find($id);
    }

    public function updateTask(Task $task): bool
    {
        return $task->save();
    }

    public function deleteTask(int $id): bool
    {
        return Task::destroy($id) > 0;
    }

    public function getTasksByUserId(int $userId): Collection
    {
        return Task::where('user_id', $userId)->get();
    }

    public function getAllTasks(): Collection
    {
        return Task::all();
    }
} 