<?php

namespace App\Http\Livewire\Tasks;

use App\Models\Task;
use Livewire\Component;
use Livewire\WithPagination;

class TasksList extends Component
{
    use WithPagination;

    protected $tasks;

    protected $listeners = [
        'taskAdded' => '$refresh',
        'taskUpdated' => '$refresh',
        'taskDeleted' => '$refresh',
        'filterTasks' => 'filterTasks',
    ];

    public function render()
    {
        $this->tasks = Task::paginate();
        return view('livewire.tasks.tasks-list', [
            'tasks' => $this->tasks,
        ]);
    }

    public function filterTasks($marked = true)
    {
        if ($marked) {
            $this->tasks = Task::whereNotNull('completed')->paginate();
        } else {
            $this->tasks = Task::whereNull('completed')->paginate();
        }
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
