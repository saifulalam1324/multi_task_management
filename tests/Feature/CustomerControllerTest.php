<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Customer;
use App\Models\Service;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;

class CustomerControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function user_can_signup()
    {
        $response = $this->post(route('UserSignup'), [
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
            'phone' => '1234567890',
            'address' => '123 Street',
        ]);

        $response->assertRedirect(route('loginsignup'));
        $this->assertDatabaseHas('customers', [
            'email' => 'john@example.com'
        ]);
    }

    /** @test */
    public function user_can_login()
    {
        /** @var \App\Models\Customer&\Illuminate\Contracts\Auth\Authenticatable $customer */
        $customer = Customer::create([
            'name' => 'Jane Doe',
            'email' => 'jane@example.com',
            'password' => Hash::make('password123'),
            'phone' => '0987654321',
            'address' => '456 Street',
        ]);

        $response = $this->post(route('UserLogin'), [
            'email' => 'jane@example.com',
            'password' => 'password123'
        ]);

        $response->assertRedirect(route('Userhome'));
        $this->assertAuthenticatedAs($customer, 'customer');
    }

    /** @test */
    public function user_can_logout()
    {
        /** @var \App\Models\Customer&\Illuminate\Contracts\Auth\Authenticatable $customer */
        $customer = Customer::factory()->create();
        $this->actingAs($customer, 'customer');

        $response = $this->post(route('UserLogout'));

        $response->assertRedirect(route('Userhome'));
        $this->assertGuest('customer');
    }

    /** @test */
    public function user_can_request_service()
    {
        /** @var \App\Models\Customer&\Illuminate\Contracts\Auth\Authenticatable $customer */
        $customer = Customer::factory()->create();
        $service = Service::factory()->create();
        $this->actingAs($customer, 'customer');

        $response = $this->post(route('requestservice', $service->service_id));

        $response->assertRedirect();
        $this->assertDatabaseHas('servicerequests', [
            'c_id' => $customer->c_id,
            'service_id' => $service->service_id,
            'status' => 'pending'
        ]);
    }

    /** @test */
    public function user_can_update_profile()
    {
        /** @var \App\Models\Customer&\Illuminate\Contracts\Auth\Authenticatable $customer */
        $customer = Customer::factory()->create();
        $this->actingAs($customer, 'customer');

        $response = $this->post(route('updateprofile'), [
            'name' => 'Updated Name',
            'phone' => '1112223333',
            'address' => 'Updated Address'
        ]);

        $response->assertRedirect();
        $this->assertDatabaseHas('customers', [
            'c_id' => $customer->c_id,
            'name' => 'Updated Name',
            'phone' => '1112223333'
        ]);
    }

    /** @test */
    public function user_can_change_password()
    {
        /** @var \App\Models\Customer&\Illuminate\Contracts\Auth\Authenticatable $customer */
        $customer = Customer::factory()->create([
            'password' => Hash::make('oldpassword')
        ]);
        $this->actingAs($customer, 'customer');

        $response = $this->post(route('passchangecc'), [
            'current_password' => 'oldpassword',
            'new_password' => 'newpassword123',
            'new_password_confirmation' => 'newpassword123'
        ]);

        $response->assertRedirect();
        $this->assertTrue(Hash::check('newpassword123', $customer->fresh()->password));
    }
}
