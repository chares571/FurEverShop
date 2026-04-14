<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminAccessTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_access_admin_dashboard(): void
    {
        $admin = User::factory()->admin()->create();

        $response = $this->actingAs($admin)->get(route('admin.dashboard'));

        $response->assertOk();
    }

    public function test_shopper_cannot_access_admin_dashboard(): void
    {
        $shopper = User::factory()->create();

        $response = $this->actingAs($shopper)->get(route('admin.dashboard'));

        $response->assertForbidden();
    }
}
