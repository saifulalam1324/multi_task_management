<?php

namespace Tests\Feature;

use App\Models\Serviceprovider;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ServiceproviderTest extends TestCase
{
   use RefreshDatabase;

    /** @test */
    public function service_provider_can_be_created()
    {
        $provider = Serviceprovider::create([
            'name' => 'Provider One',
            'email' => 'provider1@example.com',
            'phone' => '01700000000',
            'password' => bcrypt('secret123'),
            'service_type' => 'Cleaning',
            'address' => 'Dhaka, Bangladesh',
            'image_url' => 'ASSATS/PICTURE/banner.png',
        ]);
        $this->assertDatabaseHas('serviceproviders', [
            'email' => 'provider1@example.com',
            'name'  => 'Provider One'
        ]);
        $this->assertEquals(false, $provider->approve_status);
        $this->assertNotNull($provider->sp_id);
    }
}
