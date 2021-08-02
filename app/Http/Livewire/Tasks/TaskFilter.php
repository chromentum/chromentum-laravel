<?php

namespace App\Http\Livewire\Tasks;

use Livewire\Component;

class TaskFilter extends Component
{
    public function render()
    {
        return view('livewire.tasks.task-filter');
    }

    public function changeFilter($filter)
    {
        dd($filter);
    }
}
