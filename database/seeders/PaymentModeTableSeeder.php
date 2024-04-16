<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PaymentModeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('payment_modes')->delete();

        $company_registration_details = array(
            array('name' => "Not Specified", 'code' => 'NS'),
            
        );
        DB::table('payment_modes')->insert($company_registration_details);
    }
}
