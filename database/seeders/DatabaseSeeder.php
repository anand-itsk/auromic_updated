<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            CountryTableSeeder::class,
            StateTableSeeder::class,
            DistrictTableSeeder::class,
            PermissionGroupTableSeeder::class,
            PermissionTableSeeder::class,
            RoleTableSeeder::class,
            UserTableSeeder::class
        ]);
    }
}
