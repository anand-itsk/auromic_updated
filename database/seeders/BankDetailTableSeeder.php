<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BankDetailTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('bank_details')->delete();

        $bank_details = array(
            array('bank_name' => "State bank of India", 'account_number' => '1845215059', 'branch_name' => 'Pondicherry', 'ifsc_code' => 'SBI00398S23'),
            array('bank_name' => "Indian Bank", 'account_number' => '1545215059', 'branch_name' => 'Pondicherry', 'ifsc_code' => 'SBI00398S23'),
            array('bank_name' => "State bank of India", 'account_number' => '5845215059', 'branch_name' => 'Pondicherry', 'ifsc_code' => 'SBI00398S23'),
            array('bank_name' => "Indian Bank", 'account_number' => '3845215059', 'branch_name' => 'Pondicherry', 'ifsc_code' => 'SBI00398S23'),
        );

        DB::table('bank_details')->insert($bank_details);
    }
}
