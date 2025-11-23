<?php

namespace Tests\Feature;

use App\Models\Admin;
use App\Models\ServiceProvider;
use App\Models\Customer;
use App\Models\ServiceRequest;
use App\Models\Service;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class AdminControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function admin_can_signup()
    {
        $response = $this->post('/adminsignup', [
            'admin_name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => 'password123'
        ]);

        $response->assertRedirect('/adminlogin');
        $this->assertDatabaseHas('admins', [
            'email' => 'admin@example.com'
        ]);
    }

    /** @test */
    public function admin_can_login()
    {
        DB::table('admins')->insert([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('password123'),
        ]);

        $response = $this->post('/adminlogin', [
            'email' => 'admin@example.com',
            'password' => 'password123'
        ]);

        $response->assertRedirect('/adminhome');
        $this->assertAuthenticated('admin');
    }

    /** @test */
    public function admin_can_add_service()
    {
        $this->loginAsAdmin();

        $response = $this->post('/addservice', [
            'service_name' => 'Cleaning',
            'per_hour_rate' => 100,
            'description' => 'Test service'
        ]);

        $response->assertSessionHas('success');
        $this->assertDatabaseHas('services', [
            'service_name' => 'Cleaning'
        ]);
    }

    /** @test */
    public function admin_can_approve_service_request()
    {
        Mail::fake();
        $this->loginAsAdmin();

        $customer = Customer::factory()->create();
        $service = Service::factory()->create();
        $sp = ServiceProvider::factory()->create();

        $req = ServiceRequest::create([
            'c_id' => $customer->c_id,
            'service_id' => $service->service_id,
            'status' => 'pending'
        ]);

        $response = $this->post("/approveservicerequest/{$req->request_id}", [
            'sp_id' => $sp->sp_id
        ]);

        $response->assertSessionHas('success');

        $this->assertDatabaseHas('servicerequests', [
            'request_id' => $req->request_id,
            'status' => 'approved',
            'sp_id' => $sp->sp_id
        ]);
    }

    /** @test */
    public function admin_can_reject_service_request()
    {
        $this->loginAsAdmin();

        $customer = Customer::factory()->create();
        $service = Service::factory()->create();

        $req = ServiceRequest::create([
            'c_id' => $customer->c_id,
            'service_id' => $service->service_id,
        ]);

        $response = $this->post("/rejectservicerequest/{$req->request_id}");

        $response->assertSessionHas('success');

        $this->assertDatabaseMissing('servicerequests', [
            'request_id' => $req->request_id
        ]);
    }

    /** @test */
    public function admin_can_mark_payment_as_paid()
    {
        $this->loginAsAdmin();

        $customer = Customer::factory()->create();
        $service = Service::factory()->create();

        $req = ServiceRequest::create([
            'c_id'    => $customer->c_id,
            'service_id' => $service->service_id,
            'status' => 'completed',
            'payment_status' => 'pending'
        ]);

        $response = $this->post("/markaspaid/{$req->request_id}");

        $response->assertSessionHas('success');

        $this->assertDatabaseHas('servicerequests', [
            'request_id' => $req->request_id,
            'payment_status' => 'paid'
        ]);
    }

    /** @test */
    public function admin_can_remove_service_provider()
    {
        $this->loginAsAdmin();

        $sp = ServiceProvider::factory()->create();

        $response = $this->post("/removeserviceprovider/{$sp->sp_id}");

        $response->assertSessionHas('success');

        $this->assertDatabaseMissing('serviceproviders', [
            'sp_id' => $sp->sp_id
        ]);
    }

    private function loginAsAdmin()
    {
        $admin = DB::table('admins')->insert([
            'name' => 'Admin',
            'email' => 'admin@test.com',
            'password' => Hash::make('password123'),
        ]);

        $this->post('/adminlogin', [
            'email' => 'admin@test.com',
            'password' => 'password123'
        ]);
    }
}
