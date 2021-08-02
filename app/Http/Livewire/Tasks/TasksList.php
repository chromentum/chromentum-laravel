<?php

namespace App\Http\Livewire\Tasks;

use App\Models\Task;
use Livewire\Component;

class TasksList extends Component
{
    public $tasks;

    protected $listeners = ['taskAdded' => '$refresh'];

    public function render()
    {
        $this->tasks = Task::all();
        return view('livewire.tasks.tasks-list');
    }
}
