<?php

namespace App\Http\Livewire\Tasks;

use App\Models\Task;
use Livewire\Component;
use Livewire\WithPagination;

class TasksList extends Component
{
    use WithPagination;

    protected $tasks;

    protected $listeners = ['taskAdded' => '$refresh'];

    public function render()
    {
        $tasks = Task::paginate();
        return view('livewire.tasks.tasks-list', [
            'tasks' => $tasks,
        ]);
    }
}
