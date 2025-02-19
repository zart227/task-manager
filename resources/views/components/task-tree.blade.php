@props(['level' => 0])

<div class="task-tree">
    @foreach ($getRootTasks() as $task)
        <div class="task-item" style="margin-left: {{ $level * 20 }}px;">
            <div class="card mb-2">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="card-title mb-0">{{ $task->name }}</h5>
                        <div>
                            @switch($task->status)
                                @case('in_progress')
                                    <span class="badge bg-primary">В процессе</span>
                                    @break
                                @case('completed')
                                    <span class="badge bg-success">Завершена</span>
                                    @break
                                @case('pending')
                                    <span class="badge bg-warning">Ожидает</span>
                                    @break
                            @endswitch
                        </div>
                    </div>
                    <p class="card-text mt-2">{{ Str::limit($task->description, 100) }}</p>
                    <div class="btn-group">
                        <a href="{{ route('tasks.edit', $task) }}" class="btn btn-sm btn-primary">
                            Редактировать
                        </a>
                        <form action="{{ route('tasks.destroy', $task) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Вы уверены?')">
                                Удалить
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            @if ($getChildTasks($task->id)->isNotEmpty())
                <x-task-tree :tasks="$tasks" :level="$level + 1" />
            @endif
        </div>
    @endforeach
</div>

<style>
.task-tree {
    padding: 10px 0;
}

.task-item {
    transition: margin-left 0.3s ease;
}

.card {
    border-left: 4px solid #007bff;
}

.card-body {
    padding: 1rem;
}

.btn-group {
    margin-top: 10px;
}

.badge {
    font-size: 0.8rem;
    padding: 0.4em 0.6em;
}
</style>