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
        $task = $this->taskRepository->createTask(
            $request->name,
            $request->description,
            Auth::id(),
            $request->parent_id,
            $request->status
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

        $task->fill($request->validated());
        $this->taskRepository->updateTask($task);

        return new TaskResource($task->fresh());
    }

    /**
     * Удаление задачи
     */
    public function destroy(Task $task): JsonResponse
    {
        $this->authorize('delete', $task);
        
        $this->taskRepository->deleteTask($task->id);

        return response()->json([
            'message' => 'Задача успешно удалена'
        ]);
    }
}
