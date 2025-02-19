<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\Database\Eloquent\Collection;

class TaskTree extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public Collection $tasks
    ) {}

    /**
     * Получить корневые задачи (без родителей)
     */
    public function getRootTasks(): Collection
    {
        return $this->tasks->whereNull('parent_id');
    }

    /**
     * Получить дочерние задачи для заданной задачи
     */
    public function getChildTasks(int $parentId): Collection
    {
        return $this->tasks->where('parent_id', $parentId);
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render()
    {
        return view('components.task-tree');
    }
}
