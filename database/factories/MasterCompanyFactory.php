<?php

namespace Database\Factories;

use App\Models\Company;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Company>
 */
class MasterCompanyFactory extends Factory
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
            'company_type_id' => 2,
            'company_code' => fake()->name(),
            'company_name' => Str::random(10),
            'created_by' => mt_rand(1, 10),
            'updated_by' => mt_rand(1, 10)
        ];
    }
}
