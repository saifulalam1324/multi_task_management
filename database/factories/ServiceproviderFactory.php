<?php

namespace Database\Factories;

use App\Models\Serviceprovider;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Serviceprovider>
 */
class ServiceproviderFactory extends Factory
{
    protected $model = Serviceprovider::class;

    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->email(),
            'phone' => $this->faker->numerify('01#########'),
            'password' => bcrypt('password'),
            'service_type' => 'Cleaning',
            'address' => $this->faker->address(),
            'approve_status' => false,
            'image_url' => 'default.jpg',
            'status' => 'active'
        ];
    }
}
