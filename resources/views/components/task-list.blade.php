<div class="task-list">
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Название</th>
                    <th>Описание</th>
                    <th>Статус</th>
                    <th>Родительская задача</th>
                    <th>Действия</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($tasks as $task)
                    <tr>
                        <td>{{ $task->id }}</td>
                        <td>{{ $task->name }}</td>
                        <td>{{ Str::limit($task->description, 50) }}</td>
                        <td>
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
                        </td>
                        <td>
                            @if($task->parent)
                                {{ $task->parent->name }}
                            @else
                                -
                            @endif
                        </td>
                        <td>
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
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>