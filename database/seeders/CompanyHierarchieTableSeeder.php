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
            array('company_id' => 4, 'parent_company_id' => 3),
        );

        DB::table('company_hierarchies')->insert($company_hierarchies);
    }
}
