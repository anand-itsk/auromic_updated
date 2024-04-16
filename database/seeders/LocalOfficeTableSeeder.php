<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LocalOfficeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('local_offices')->delete();

        $company_registration_details = array(
            array('name' => "Not Specified", 'code' => 'NS'),
            
        );
        DB::table('local_offices')->insert($company_registration_details);
    }
}
