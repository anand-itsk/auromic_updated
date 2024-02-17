<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AddressTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('address_types')->delete();

        $bank_details = array(
            array('name' => "Not Specified", 'code' => 'NS'),
            array('name' => "Office Address", 'code' => 'OFA'),
            array('name' => "Residential Address", 'code' => 'RA'),
            array('name' => "Permanent Address", 'code' => 'PA'),
            array('name' => "Correspondence Address", 'code' => 'CA'),
        );

        DB::table('address_types')->insert($bank_details);
    }
}
