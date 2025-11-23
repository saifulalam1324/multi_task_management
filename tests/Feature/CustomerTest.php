<?php

namespace Tests\Feature;

use App\Models\Customer;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CustomerTest extends TestCase
{
   use RefreshDatabase;

    /** @test */
    public function customer_can_be_created()
    {
        $customer = Customer::create([
            'name' => 'John',
            'email' => 'john@example.com',
            'phone' => '1234567890',
            'password' => bcrypt('123456'),
            'address' => '123 Main St',
        ]);

        $this->assertDatabaseHas('customers', [
            'email' => 'john@example.com',
        ]);
    }
}
