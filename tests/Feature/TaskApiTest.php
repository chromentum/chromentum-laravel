<?php

namespace Tests\Feature;

use App\Models\Task;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TaskApiTest extends TestCase
{
    use WithFaker;

    public function test_unauthorized_task_list()
    {
        $response = $this->json('GET', '/api/tasks');
        $response->assertStatus(401);
    }

    public function test_task_list()
    {
        $user = User::factory()->create();

        $tasks = Task::factory([
            'user_id' => $user->id
        ])->count(10)->create();

        $response = $this->actingAs($user,'api')
            ->json('GET', '/api/tasks');

        $response->assertStatus(200)
            ->assertJson([
                'data' => true
            ])
            ->assertJsonCount(10, 'data');
    }

    public function test_unauthorized_task_store()
    {
        $response = $this->json('POST', '/api/tasks');
        $response->assertStatus(401);
    }

    public function test_task_store()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user,'api')
            ->json('POST', '/api/tasks');

        $response->assertStatus(422)
            ->assertJson([
                'message' => true,
                'errors' => [
                    'description' => true
                ]
            ]);

        $payload = [
            'description' => $this->faker->text
        ];

        $response = $this->actingAs($user,'api')
            ->json('POST', '/api/tasks', $payload);

        $response->assertStatus(201);
    }

    public function test_unauthorized_task_show()
    {
        $user = User::factory()->create();

        Task::factory([
            'user_id' => $user->id
        ])->count(10)->create();

        $response = $this->json('GET', '/api/tasks/' . Task::inRandomOrder()->first()->id);
        $response->assertStatus(401);

        $unathorizedUser = User::factory()->create();
        $response = $this->actingAs($unathorizedUser, 'api')
            ->json('GET', '/api/tasks/' . Task::inRandomOrder()->first()->id);
        $response->assertStatus(403);
    }

    public function test_task_show() {
        $user = User::factory()->create();

        Task::factory([
            'user_id' => $user->id
        ])->count(10)->create();

        $task = Task::inRandomOrder()->first();

        $response = $this->actingAs($user, 'api')
            ->json('GET', '/api/tasks/' . $task->id);

        $response->assertStatus(200)
            ->assertJson([
                'data' => [
                    'id' => $task->id,
                    'description' => $task->description,
                    'date' => $task->created_at->format('d M Y'),
                    'completed' => $task->completed_at !== null ? true : false,
                ]
            ]);
    }

    public function test_unauthorized_task_update()
    {
        $user = User::factory()->create();

        Task::factory([
            'user_id' => $user->id
        ])->count(10)->create();

        $response = $this->json('PUT', '/api/tasks/' . Task::inRandomOrder()->first()->id);
        $response->assertStatus(401);

        $unathorizedUser = User::factory()->create();
        $response = $this->actingAs($unathorizedUser, 'api')
            ->json('PUT', '/api/tasks/' . Task::inRandomOrder()->first()->id);
        $response->assertStatus(403);
    }

    public function test_task_update() {
        $user = User::factory()->create();

        Task::factory([
            'user_id' => $user->id
        ])->count(10)->create();

        $task = Task::inRandomOrder()->first();

        $payload = [
            'description' => $this->faker->text,
            'completed' => true
        ];

        $response = $this->actingAs($user, 'api')
            ->json('PUT', '/api/tasks/' . $task->id, $payload);

        $response->assertStatus(200);

        $updatedTask = Task::find($task->id);

        $this->assertDatabaseHas('tasks', [
            'id' => $updatedTask->id,
            'description' => $updatedTask->description,
            'completed_at' => $updatedTask->completed_at
        ]);
    }

    public function test_unauthorized_task_delete()
    {
        $user = User::factory()->create();

        Task::factory([
            'user_id' => $user->id
        ])->count(10)->create();

        $response = $this->json('DELETE', '/api/tasks/' . Task::inRandomOrder()->first()->id);
        $response->assertStatus(401);

        $unathorizedUser = User::factory()->create();
        $response = $this->actingAs($unathorizedUser, 'api')
            ->json('DELETE', '/api/tasks/' . Task::inRandomOrder()->first()->id);
        $response->assertStatus(403);
    }

    public function test_task_delete() {
        $user = User::factory()->create();

        Task::factory([
            'user_id' => $user->id
        ])->count(10)->create();

        $task = Task::inRandomOrder()->first();

        $response = $this->actingAs($user, 'api')
            ->json('DELETE', '/api/tasks/' . $task->id);

        $response->assertStatus(200);

        $this->assertDeleted($task);
    }
}
