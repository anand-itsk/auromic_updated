<?php

namespace Database\Seeders;
use App\Models\AuthorisedPerson;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AuthorisedPeopleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         AuthorisedPerson::factory()->count(10)->create();
         
         
        AuthorisedPerson::factory()->create([
            'name' => 'Ragul',
            
        ]);
    }
}