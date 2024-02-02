<?php

namespace Database\Factories;
use App\Models\AuthorisedPerson;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\AuthorisedPerson>
 */
class AuthorisedPersonFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    
     protected $model = AuthorisedPerson::class;


     
   public function definition()
    {
        return [
             'name' => fake()->name(),
           
        ];
    }
}