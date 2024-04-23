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

        

        Company::create([
            'company_code' => 'AURO',
            'company_name' => 'Auromics',
            'created_by' => 1,
            'updated_by' => 1
        ]);
    }
}
