<?php

namespace Tests\Feature;

use App\Models\Admin;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AdminTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function admin_can_be_created()
    {
        $admin = Admin::create([
            'name' => 'Admin One',
            'email' => 'admin@example.com',
            'password' => bcrypt('123456'),
        ]);
        $this->assertDatabaseHas('admins', [
            'email' => 'admin@example.com',
        ]);
    }
}
