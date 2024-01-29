<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EmployeeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('employees')->delete();

        $datas = array(
            array('company_id' => 1, 'employee_code' => 'EMP1', 'employee_name' => 'Master Employee 1', 'resigning_reason_id' => 1),
            array('company_id' => 2, 'employee_code' => 'EMP2', 'employee_name' => 'Master Employee 2', 'resigning_reason_id' => 1),
            array('company_id' => 2, 'employee_code' => 'EMP3', 'employee_name' => 'Master Employee 3', 'resigning_reason_id' => 1),
            array('company_id' => 3, 'employee_code' => 'EMP4', 'employee_name' => 'Master Employee 4', 'resigning_reason_id' => 1),
            array('company_id' => 3, 'employee_code' => 'EMP5', 'employee_name' => 'Master Employee 5', 'resigning_reason_id' => 1),
            array('company_id' => 3, 'employee_code' => 'EMP6', 'employee_name' => 'Master Employee 6', 'resigning_reason_id' => 1),
            array('company_id' => 4, 'employee_code' => 'EMP7', 'employee_name' => 'Master Employee 7', 'resigning_reason_id' => 1),
            array('company_id' => 4, 'employee_code' => 'EMP8', 'employee_name' => 'Master Employee 8', 'resigning_reason_id' => 1),
            array('company_id' => 4, 'employee_code' => 'EMP9', 'employee_name' => 'Master Employee 9', 'resigning_reason_id' => 1),
            array('company_id' => 4, 'employee_code' => 'EMP10', 'employee_name' => 'Master Employee 10', 'resigning_reason_id' => 1),
        );
        DB::table('employees')->insert($datas);
    }
}
