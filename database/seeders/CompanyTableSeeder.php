<?php

namespace Database\Seeders;

use App\Models\Company;
use Database\Factories\ClientCompanyFactory;
use Database\Factories\MasterCompanyFactory;
use Database\Factories\SubClientCompanyFactory;
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

        MasterCompanyFactory::new()->count(10)->create();
        ClientCompanyFactory::new()->count(50)->create();
        SubClientCompanyFactory::new()->count(100)->create();




        // Company::create([
        //     'company_code' => 'C001',
        //     'company_name' => 'Syscorp',
        //     'created_by' => 1,
        //     'updated_by' => 1
        // ]);
        // DB::table('companies')->delete();

        // $companies = array(
        //     array('company_type_id' => 1, 'company_code' => 'A', 'company_name' => 'A', 'created_by' => 1, 'updated_by' => 1),
        //     array('company_type_id' => 1, 'company_code' => 'B', 'company_name' => 'B', 'created_by' => 1, 'updated_by' => 1),
        //     array('company_type_id' => 1, 'company_code' => 'C', 'company_name' => 'C', 'created_by' => 1, 'updated_by' => 1),
        //     array('company_type_id' => 2, 'company_code' => 'D', 'company_name' => 'D', 'created_by' => 1, 'updated_by' => 1),
        //     array('company_type_id' => 2, 'company_code' => 'E', 'company_name' => 'E', 'created_by' => 1, 'updated_by' => 1),
        //     array('company_type_id' => 2, 'company_code' => 'F', 'company_name' => 'F', 'created_by' => 1, 'updated_by' => 1),
        //     array('company_type_id' => 3, 'company_code' => 'G', 'company_name' => 'G', 'created_by' => 1, 'updated_by' => 1),
        //     array('company_type_id' => 3, 'company_code' => 'H', 'company_name' => 'H', 'created_by' => 1, 'updated_by' => 1),
        //     array('company_type_id' => 3, 'company_code' => 'I', 'company_name' => 'I', 'created_by' => 1, 'updated_by' => 1),
        // );
        // DB::table('companies')->insert($companies);
    }
}
