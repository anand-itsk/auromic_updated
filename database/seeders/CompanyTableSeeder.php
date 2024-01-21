<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CompanyTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('companies')->delete();

        $companies = array(
            array('company_type_id' => 1, 'company_code' => 'A', 'company_name' => 'A', 'state_id' => 1,'created_by' => 1, 'updated_by' => 1),
            array('company_type_id' => 1, 'company_code' => 'B', 'company_name' => 'B', 'state_id' => 1,'created_by' => 1, 'updated_by' => 1),
            array('company_type_id' => 1, 'company_code' => 'C', 'company_name' => 'C', 'state_id' => 1,'created_by' => 1, 'updated_by' => 1),
            array('company_type_id' => 2, 'company_code' => 'D', 'company_name' => 'D', 'state_id' => 1,'created_by' => 1, 'updated_by' => 1),
            array('company_type_id' => 2, 'company_code' => 'E', 'company_name' => 'E', 'state_id' => 1,'created_by' => 1, 'updated_by' => 1),
            array('company_type_id' => 2, 'company_code' => 'F', 'company_name' => 'F', 'state_id' => 1,'created_by' => 1, 'updated_by' => 1),
            array('company_type_id' => 3, 'company_code' => 'G', 'company_name' => 'G', 'state_id' => 1,'created_by' => 1, 'updated_by' => 1),
            array('company_type_id' => 3, 'company_code' => 'H', 'company_name' => 'H', 'state_id' => 1,'created_by' => 1, 'updated_by' => 1),
            array('company_type_id' => 3, 'company_code' => 'I', 'company_name' => 'I', 'state_id' => 1,'created_by' => 1, 'updated_by' => 1),
        );
        DB::table('companies')->insert($companies);
    }
}
