<?php

namespace Database\Seeders;

use App\Models\Company;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;


class MasterCompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        Company::factory(\Database\Factories\MasterCompanyFactory::class)->count(10)->create();


        Company::create([
            'company_code' => 'C001',
            'company_name' => 'Syscorp',
            'created_by' => 1,
            'updated_by' => 1
        ]);
    }
}
