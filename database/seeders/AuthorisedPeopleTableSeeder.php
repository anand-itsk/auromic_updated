<?php

namespace Database\Seeders;

use App\Models\AuthorisedPerson;
use Database\Factories\AuthorisedPersonFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AuthorisedPeopleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        AuthorisedPersonFactory::new()->count(5)->create();
    }
}
