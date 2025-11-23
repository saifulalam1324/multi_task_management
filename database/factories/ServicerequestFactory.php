<?php

namespace Database\Factories;

use App\Models\Customer;
use App\Models\Service;
use App\Models\Servicerequest;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Servicerequest>
 */
class ServicerequestFactory extends Factory
{protected $model = Servicerequest::class;

    public function definition()
    {
        return [
            'c_id' => Customer::factory(),
            'service_id' => Service::factory(),
            'status' => 'pending',
            'payment_status' => 'pending'
        ];
    }
}
