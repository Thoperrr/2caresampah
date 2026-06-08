<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Client;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AdminClientManagementTest extends TestCase
{
    use RefreshDatabase;

    protected $adminUser;

    protected function setUp(): void
    {
        parent::setUp();

        // Membuat user admin
        $this->adminUser = User::factory()->create([
            'role' => 'admin',
        ]);
    }

    /** @test */
    public function admin_can_view_client_index_page()
    {
        $this->actingAs($this->adminUser)
            ->get(route('admin.clients.index'))
            ->assertStatus(200)
            ->assertViewIs('admin.clients.index');
    }

    /** @test */
    public function admin_can_activate_a_client()
    {
        $client = Client::factory()->create(['status' => 0]);

        $response = $this->actingAs($this->adminUser)
            ->post(route('admin.clients.activate', $client->id));

        $response->assertRedirect(route('admin.clients.index'));
        $this->assertDatabaseHas('clients', [
            'id' => $client->id,
            'status' => 1,
        ]);
    }

    /** @test */
    public function admin_can_deactivate_a_client()
    {
        $client = Client::factory()->create(['status' => 1]);

        $response = $this->actingAs($this->adminUser)
            ->post(route('admin.clients.deactivate', $client->id));

        $response->assertRedirect(route('admin.clients.index'));
        $this->assertDatabaseHas('clients', [
            'id' => $client->id,
            'status' => 0,
        ]);
    }

    /** @test */
    public function admin_can_delete_a_client()
    {
        $client = Client::factory()->create();

        $response = $this->actingAs($this->adminUser)
            ->delete(route('admin.clients.destroy', $client->id));

        $response->assertRedirect(route('admin.clients.index'));
        $this->assertDatabaseMissing('clients', [
            'id' => $client->id,
        ]);
    }

    /** @test */
    public function non_admin_cannot_access_client_management_routes()
    {
        $user = User::factory()->create(['role' => 'client']);

        $response = $this->actingAs($user)->get(route('admin.clients.index'));
        $response->assertStatus(403); // atau redirect tergantung middleware

        $client = Client::factory()->create();

        $response = $this->actingAs($user)->post(route('admin.clients.activate', $client->id));
        $response->assertStatus(403);

        $response = $this->actingAs($user)->post(route('admin.clients.deactivate', $client->id));
        $response->assertStatus(403);

        $response = $this->actingAs($user)->delete(route('admin.clients.destroy', $client->id));
        $response->assertStatus(403);
    }
}
