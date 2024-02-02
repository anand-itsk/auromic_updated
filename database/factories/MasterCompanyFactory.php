<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Company>
 */
class MasterCompanyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'company_type_id' => 1,
            'company_code' => fake()->name(), 
            'company_name' => Str::random(10), 
            'created_by' => mt_rand(1, 10),
            'updated_by' => mt_rand(1, 10)
        ];
    }
}