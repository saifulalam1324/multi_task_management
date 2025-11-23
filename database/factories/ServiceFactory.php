<?php

namespace Database\Factories;

use App\Models\Service;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Service>
 */
class ServiceFactory extends Factory
{
    protected $model = Service::class;

    public function definition()
    {
        return [
            'service_name' => $this->faker->word(),
            'per_hour_rate' => $this->faker->numberBetween(100, 500),
            'description' => $this->faker->sentence(),
        ];
    }
}
