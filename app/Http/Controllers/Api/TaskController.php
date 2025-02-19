<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\TaskRequest;
use App\Http\Resources\TaskResource;
use App\Models\Task;
use App\Repositories\Interfaces\TaskRepositoryInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class TaskController extends Controller
{
    private TaskRepositoryInterface $taskRepository;

    public function __construct(TaskRepositoryInterface $taskRepository)
    {
        $this->taskRepository = $taskRepository;
        $this->middleware('auth:sanctum');
    }

    /**
     * Получение списка задач текущего пользователя
     */
    public function index(): AnonymousResourceCollection
    {
        $tasks = $this->taskRepository->getTasksByUserId(Auth::id());
        return TaskResource::collection($tasks);
    }

    /**
     * Создание новой задачи
     */
    public function store(TaskRequest $request): TaskResource
    {
        $data = $request->validated();
        
        if ($request->hasFile('image')) {
            $data['image_path'] = $request->file('image')->store('tasks', 'public');
        }

        $task = $this->taskRepository->createTask(
            $data['name'],
            $data['description'],
            Auth::id(),
            $data['parent_id'] ?? null,
            $data['status'],
            $data['image_path'] ?? null
        );

        return new TaskResource($task);
    }

    /**
     * Получение информации о конкретной задаче
     */
    public function show(Task $task): TaskResource
    {
        $this->authorize('view', $task);
        
        return new TaskResource($task->load(['parent', 'children']));
    }

    /**
     * Обновление задачи
     */
    public function update(TaskRequest $request, Task $task): TaskResource
    {
        $this->authorize('update', $task);

        $data = $request->validated();

        if ($request->hasFile('image')) {
            // Удаляем старое изображение, если оно есть
            if ($task->image_path) {
                Storage::disk('public')->delete($task->image_path);
            }
            $data['image_path'] = $request->file('image')->store('tasks', 'public');
        }

        $task->fill($data);
        $this->taskRepository->updateTask($task);

        return new TaskResource($task->fresh());
    }

    /**
     * Удаление задачи
     */
    public function destroy(Task $task): JsonResponse
    {
        $this->authorize('delete', $task);
        
        // Удаляем изображение, если оно есть
        if ($task->image_path) {
            Storage::disk('public')->delete($task->image_path);
        }
        
        $this->taskRepository->deleteTask($task->id);

        return response()->json([
            'message' => 'Задача успешно удалена'
        ]);
    }
}
