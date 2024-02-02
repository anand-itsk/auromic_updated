<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CompanyTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('company_types')->delete();

        $company_types = array(
            array('Name' => 'Not Specified', 'Code' => 'NS'),
            array('Name' => 'Master Company', 'Code' => 'MC'),
            array('Name' => 'Client Company', 'Code' => 'CC'),
            array('Name' => 'Sub-client Company', 'Code' => 'SC'),
        );
        DB::table('company_types')->insert($company_types);
    }
}
