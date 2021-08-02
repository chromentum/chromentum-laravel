<?php

namespace App\Http\Livewire\Tasks;

use App\Models\Task;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class AddTask extends Component
{
    public $description;

    protected $rules = [
        'description' => 'required|max:140',
    ];

    public function render()
    {
        return view('livewire.tasks.add-task');
    }

    public function submit()
    {
        $this->validate();

        $task = new Task();
        $task->user_id = Auth::user()->id;
        $task->description = $this->description;
        if ( $task->save() ) {
            $this->description = null;
        }
    }
}
