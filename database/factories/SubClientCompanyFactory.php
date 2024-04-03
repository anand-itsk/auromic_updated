<?php

namespace Database\Factories;

use App\Models\Company;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Company>
 */
class SubClientCompanyFactory extends Factory
{

    protected $model = Company::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'company_type_id' => 4,
            'company_name' => fake()->name(),
            'company_code' => Str::random(10),
            'created_by' => mt_rand(1, 10),
            'updated_by' => mt_rand(1, 10)
        ];
    }
}
