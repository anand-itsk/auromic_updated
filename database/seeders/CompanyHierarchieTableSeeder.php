<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CompanyHierarchieTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('company_hierarchies')->delete();

        $company_hierarchies = array(
            array('company_id' => 5, 'parent_company_id' => 2),
            array('company_id' => 6, 'parent_company_id' => 3),
            array('company_id' => 8, 'parent_company_id' => 2),
            array('company_id' => 9, 'parent_company_id' => 6),
        );

        DB::table('company_hierarchies')->insert($company_hierarchies);
    }
}
