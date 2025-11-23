<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Serviceprovider;
use App\Models\Servicerequest;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class ServiceproviderControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function serviceprovider_can_login()
    {
        $sp = Serviceprovider::create([
            'name' => 'Jane Vendor',
            'email' => 'jane@example.com',
            'phone' => '0987654321',
            'service_type' => 'Electrician',
            'address' => '456 Street',
            'password' => Hash::make('password123'),
            'approve_status' => 1,
            'image_url' => 'image/avatar.jpg'
        ]);

        $response = $this->post(route('ServiceproviderLogin'), [
            'email' => 'jane@example.com',
            'password' => 'password123'
        ]);

        $response->assertRedirect(route('serviceproviderhome'));
        $this->assertAuthenticatedAs($sp, 'serviceprovider');
    }

    /** @test */
    public function serviceprovider_can_logout()
    {
        /** @var Serviceprovider $sp */
        $sp = Serviceprovider::factory()->create();
        $this->actingAs($sp, 'serviceprovider');

        $response = $this->post(route('ServiceproviderLogout'));
        $response->assertRedirect(route('serviceproviderlogin'));
        $this->assertGuest('serviceprovider');
    }

    /** @test */
    public function serviceprovider_can_start_and_complete_task()
    {
        /** @var Serviceprovider $sp */
        $sp = Serviceprovider::factory()->create();
        /** @var Servicerequest $request */
        $request = Servicerequest::factory()->create([
            'sp_id' => $sp->sp_id,
            'status' => 'approved'
        ]);

        $this->actingAs($sp, 'serviceprovider');
        $responseStart = $this->post(route('workstarted', $request->request_id));
        $responseStart->assertRedirect(route('tasks'));
        $this->assertDatabaseHas('servicerequests', [
            'request_id' => $request->request_id,
            'status' => 'started'
        ]);
        $responseDone = $this->post(route('workdone', $request->request_id));
        $responseDone->assertRedirect(route('tasks'));
        $this->assertDatabaseHas('servicerequests', [
            'request_id' => $request->request_id,
            'status' => 'done'
        ]);
    }

    /** @test */
    public function serviceprovider_can_change_password()
    {
        /** @var Serviceprovider $sp */
        $sp = Serviceprovider::factory()->create([
            'password' => Hash::make('oldpassword')
        ]);
        $this->actingAs($sp, 'serviceprovider');

        $response = $this->post(route('Passchangec'), [
            'current_password' => 'oldpassword',
            'new_password' => 'newpassword123',
            'new_password_confirmation' => 'newpassword123'
        ]);

        $response->assertRedirect();
        $this->assertTrue(Hash::check('newpassword123', $sp->fresh()->password));
    }

    /** @test */
    public function serviceprovider_can_set_status_active_and_inactive()
    {
        /** @var Serviceprovider $sp */
        $sp = Serviceprovider::factory()->create();
        $this->actingAs($sp, 'serviceprovider');
        $responseActive = $this->post(route('statusactive'));
        $responseActive->assertRedirect(route('serviceproviderprofile'));
        $this->assertDatabaseHas('serviceproviders', [
            'sp_id' => $sp->sp_id,
            'status' => 'active'
        ]);
        $responseInactive = $this->post(route('statusinactive'));
        $responseInactive->assertRedirect(route('serviceproviderprofile'));
        $this->assertDatabaseHas('serviceproviders', [
            'sp_id' => $sp->sp_id,
            'status' => 'inactive'
        ]);
    }
}
