<?php

namespace App\Http\Livewire\Tasks;

use App\Models\Task;
use Livewire\Component;
use Livewire\WithPagination;

class TasksList extends Component
{
    use WithPagination;

    protected $tasks;
    protected $filter = 'all';

    protected $listeners = [
        'taskAdded' => '$refresh',
        'taskUpdated' => '$refresh',
        'taskDeleted' => '$refresh',
        'filterTasks' => 'filterTasks',
    ];

    public function render()
    {
        if ($this->filter === "all") {
            $this->tasks = Task::paginate();
        } elseif ($this->filter === "completed") {
            $this->tasks = Task::whereNotNull('completed_at')->paginate();
        } elseif ($this->filter === "not-completed") {
            $this->tasks = Task::whereNull('completed_at')->paginate();
        }

        return view('livewire.tasks.tasks-list', [
            'tasks' => $this->tasks,
        ]);
    }

    public function filterTasks($filter)
    {
        $this->filter = $filter;
    }

    public function markTask(Task $task, $mark = true)
    {
        $task->completed_at = $mark ? now() : null;

        if ($task->save()) {
            $this->emit('taskUpdated');
        }
    }

    public function deleteTask(Task $task)
    {
        if ($task->delete()) {
            $this->emit('taskDeleted');
        }
    }
}
