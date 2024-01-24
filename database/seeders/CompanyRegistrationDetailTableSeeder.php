<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CompanyRegistrationDetailTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('company_registration_details')->delete();

        $company_registration_details = array(
            array('company_id' => 1, 'pf_type' => 'Category 1', 'pf_date' => Carbon::now()->format('Y-m-d'), 'created_by' => 1, 'updated_by' => 1),
            
        );
        DB::table('company_registration_details')->insert($company_registration_details);
    }
}
