<?php

namespace Tests\Feature;

use App\Http\Livewire\Tasks\AddTask;
use App\Http\Livewire\Tasks\TasksList;
use App\Models\Task;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Str;
use Livewire\Livewire;
use Tests\TestCase;

class TaskWebTest extends TestCase
{
    use WithFaker;

    public function test_unauthorized_tasks_page()
    {
        $response = $this->get('/tasks');
        $response->assertStatus(302);
    }

    public function test_authorized_tasks_page()
    {
        $this->actingAs($user = User::factory()->create());
        $response = $this->get('/tasks');
        $response->assertStatus(200);
    }

    public function test_livewire_components_presence()
    {
        $this->actingAs($user = User::factory()->create());
        $this->get('/tasks')
            ->assertSeeLivewire('tasks.add-task')
            ->assertSeeLivewire('tasks.task-filter')
            ->assertSeeLivewire('tasks.tasks-list');
    }

    public function test_can_create_task()
    {
        $this->actingAs($user = User::factory()->create());
        $description = $this->faker->text(100);

        Livewire::test(AddTask::class)
            ->set('description', $description)
            ->call('submit')
            ->assertEmitted('taskAdded');

        $this->assertTrue(Task::whereDescription($description)->exists());
    }

    public function test_task_validations()
    {
        $this->actingAs($user = User::factory()->create());

        Livewire::test(AddTask::class)
            ->set('description', '')
            ->call('submit')
            ->assertHasErrors(['description' => 'required']);

        $description = Str::random(160);
        Livewire::test(AddTask::class)
            ->set('description', $description)
            ->call('submit')
            ->assertHasErrors(['description' => 'max']);
    }

    public function test_list_tasks()
    {
        $this->actingAs($user = User::factory()->create());

        Task::factory([
            'user_id' => $user->id
        ])->count(1)->create();

        $tasks = Task::paginate();

        Livewire::test(TasksList::class)
            ->assertSet('tasks', null);
    }
}
