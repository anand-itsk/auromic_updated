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
            array('company_id' => 1, 'employee_code' => 'EMP1', 'employee_name' => 'Santha .K', 'resigning_reason_id' => 1),
            array('company_id' => 3, 'employee_code' => 'EMP2', 'employee_name' => 'Manjula .N', 'resigning_reason_id' => 1),
            array('company_id' => 3, 'employee_code' => 'EMP3', 'employee_name' => 'Valli .P', 'resigning_reason_id' => 1),
            array('company_id' => 3, 'employee_code' => 'EMP4', 'employee_name' => 'Selvi .M', 'resigning_reason_id' => 1),
            array('company_id' => 3, 'employee_code' => 'EMP5', 'employee_name' => 'Devi .S', 'resigning_reason_id' => 1),
            array('company_id' => 3, 'employee_code' => 'EMP6', 'employee_name' => 'Kalaiselvi .K', 'resigning_reason_id' => 1),
            array('company_id' => 4, 'employee_code' => 'EMP7', 'employee_name' => 'Anusuya .A', 'resigning_reason_id' => 1),
            array('company_id' => 4, 'employee_code' => 'EMP8', 'employee_name' => 'Visalatchi .R', 'resigning_reason_id' => 1),
            array('company_id' => 4, 'employee_code' => 'EMP9', 'employee_name' => 'Selvarani .R', 'resigning_reason_id' => 1),
            array('company_id' => 4, 'employee_code' => 'EMP10', 'employee_name' => 'Buvaneswary .V', 'resigning_reason_id' => 1),
            array('company_id' => 5, 'employee_code' => 'EMP11', 'employee_name' => 'Kayathri .S', 'resigning_reason_id' => 1),
            array('company_id' => 5, 'employee_code' => 'EMP12', 'employee_name' => 'Ponni .M', 'resigning_reason_id' => 1),
            array('company_id' => 5, 'employee_code' => 'EMP13', 'employee_name' => 'Parimala .P', 'resigning_reason_id' => 1),
            array('company_id' => 5, 'employee_code' => 'EMP14', 'employee_name' => 'Nagammal .A', 'resigning_reason_id' => 1),
            array('company_id' => 5, 'employee_code' => 'EMP15', 'employee_name' => 'Latha .V', 'resigning_reason_id' => 1),
        );
        DB::table('employees')->insert($datas);
    }
}
