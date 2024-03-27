<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CompanyBankDetailTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('company_bank_details')->delete();

        $company_bank_details = array(
            array('company_id' => 1, 'bank_detail_id' => 1),
            array('company_id' => 3, 'bank_detail_id' => 1),
            array('company_id' => 4, 'bank_detail_id' => 1),
        );

        DB::table('company_bank_details')->insert($company_bank_details);
    }
}
