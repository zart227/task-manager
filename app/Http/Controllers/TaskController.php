<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Repositories\Interfaces\TaskRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class TaskController extends Controller
{
    private TaskRepositoryInterface $taskRepository;

    public function __construct(TaskRepositoryInterface $taskRepository)
    {
        $this->taskRepository = $taskRepository;
        $this->middleware('auth');
    }

    /**
     * Отображение списка задач
     */
    public function index(): View
    {
        $tasks = $this->taskRepository->getTasksByUserId(Auth::id());
        return view('tasks.index', compact('tasks'));
    }

    /**
     * Показ формы создания задачи
     */
    public function create(): View
    {
        $tasks = $this->taskRepository->getTasksByUserId(Auth::id());
        return view('tasks.create', compact('tasks'));
    }

    /**
     * Сохранение новой задачи
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'parent_id' => 'nullable|exists:tasks,id',
            'status' => 'required|in:in_progress,completed,pending'
        ]);

        $this->taskRepository->createTask(
            $validated['name'],
            $validated['description'],
            Auth::id(),
            $validated['parent_id'] ?? null,
            $validated['status']
        );

        return redirect()->route('tasks.index')->with('success', 'Задача успешно создана');
    }

    /**
     * Показ формы редактирования задачи
     */
    public function edit(Task $task): View
    {
        $this->authorize('update', $task);
        return view('tasks.edit', compact('task'));
    }

    /**
     * Обновление задачи
     */
    public function update(Request $request, Task $task)
    {
        $this->authorize('update', $task);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'status' => 'required|in:in_progress,completed,pending'
        ]);

        $task->fill($validated);
        $this->taskRepository->updateTask($task);

        return redirect()->route('tasks.index')->with('success', 'Задача успешно обновлена');
    }

    /**
     * Удаление задачи
     */
    public function destroy(Task $task)
    {
        $this->authorize('delete', $task);
        
        $this->taskRepository->deleteTask($task->id);
        return redirect()->route('tasks.index')->with('success', 'Задача успешно удалена');
    }
}
