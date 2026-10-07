<?php

namespace Tests\Feature;

use App\Models\Task;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TaskTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function guest_cannot_access_tasks()
    {
        $response = $this->get('/tasks');
        $response->assertRedirect('/login');
    }

    /** @test */
    public function authenticated_user_can_create_task()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $response = $this->post('/tasks', [
            'judul' => 'Test Tugas',
            'deskripsi' => 'Deskripsi',
            'deadline' => now()->addDay()->format('Y-m-d'),
        ]);

        $response->assertRedirect('/tasks');
        $this->assertDatabaseHas('tasks', ['judul' => 'Test Tugas', 'user_id' => $user->id]);
    }

    /** @test */
    public function user_can_update_and_delete_task()
    {
        $user = User::factory()->create();
        $task = Task::factory()->create(['user_id' => $user->id]);
        $this->actingAs($user);

        $this->put("/tasks/{$task->id}", [
            'judul' => 'Updated',
            'deskripsi' => 'Update desc',
            'deadline' => now()->addDays(2)->format('Y-m-d'),
            'status' => 'selesai',
        ]);

        $this->assertDatabaseHas('tasks', ['judul' => 'Updated', 'status' => 'selesai']);

        $this->delete("/tasks/{$task->id}");
        $this->assertDatabaseMissing('tasks', ['id' => $task->id]);
    }

    /** @test */
    public function user_can_toggle_task_favorite_status()
    {
        $user = User::factory()->create();
        $task = Task::factory()->create(['user_id' => $user->id, 'favorite' => false]);
        $this->actingAs($user);

        $response = $this->patch("/tasks/{$task->id}/favorite");

        $response->assertRedirect();
        $this->assertDatabaseHas('tasks', ['id' => $task->id, 'favorite' => true]);

        $this->patch("/tasks/{$task->id}/favorite");
        $this->assertDatabaseHas('tasks', ['id' => $task->id, 'favorite' => false]);
    }
}
