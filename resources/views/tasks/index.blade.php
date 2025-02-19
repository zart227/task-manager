@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h2>Задачи</h2>
                        <div>
                            <div class="btn-group me-2">
                                <button type="button" class="btn btn-outline-primary" onclick="switchView('list')">
                                    Список
                                </button>
                                <button type="button" class="btn btn-outline-primary" onclick="switchView('tree')">
                                    Дерево
                                </button>
                            </div>
                            <a href="{{ route('tasks.create') }}" class="btn btn-primary">Создать задачу</a>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div id="list-view">
                        <x-task-list :tasks="$tasks" />
                    </div>

                    <div id="tree-view" style="display: none;">
                        <x-task-tree :tasks="$tasks" />
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
function switchView(view) {
    const listView = document.getElementById('list-view');
    const treeView = document.getElementById('tree-view');
    
    if (view === 'list') {
        listView.style.display = 'block';
        treeView.style.display = 'none';
    } else {
        listView.style.display = 'none';
        treeView.style.display = 'block';
    }

    // Сохраняем выбор пользователя
    localStorage.setItem('taskView', view);
}

// Восстанавливаем последний выбранный вид при загрузке страницы
document.addEventListener('DOMContentLoaded', function() {
    const savedView = localStorage.getItem('taskView');
    if (savedView) {
        switchView(savedView);
    }
});
</script>
@endpush
@endsection 