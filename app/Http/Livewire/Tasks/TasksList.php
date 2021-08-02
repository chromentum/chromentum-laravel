<?php

namespace App\Http\Livewire\Tasks;

use App\Models\Task;
use Livewire\Component;

class TasksList extends Component
{
    public $tasks;

    protected $listeners = ['taskAdded' => 'refreshTaskList'];

    public function render()
    {
        $this->tasks = Task::all();
        return view('livewire.tasks.tasks-list');
    }

    public function refreshTaskList()
    {
        $this->tasks = Task::all();
    }
}
