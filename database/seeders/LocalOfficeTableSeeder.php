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
            array('name' => "local_offices 1", 'code' => '1'),
            array('name' => "local_offices 2", 'code' => '2'),
            
        );
        DB::table('local_offices')->insert($company_registration_details);
    }
}
