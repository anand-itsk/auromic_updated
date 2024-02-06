<?php

namespace Database\Factories;
use App\Models\AuthorisedPerson;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\AuthorisedPerson>
 */
class AuthorisedPersonFactory extends Factory
{

    protected $model = AuthorisedPerson::class;
    private static $companyId = 1;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
     
   public function definition()
    {
        return [
            'company_id' => self::$companyId++,
             'name' => fake()->name(),
        ];
    }
}