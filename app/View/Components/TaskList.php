<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\Database\Eloquent\Collection;

class TaskList extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public Collection $tasks
    ) {}

    /**
     * Get the view / contents that represent the component.
     */
    public function render()
    {
        return view('components.task-list');
    }
}
