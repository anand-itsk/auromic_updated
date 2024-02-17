<?php

namespace Database\Seeders;

use App\Models\Customer;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CustomerTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Customer::factory()->count(100)->create();

        // Customer::factory()->create([
        //     'customer_code' => 'C001',
        //     'customer_name' => 'Varun',
        //     'created_by' => 1,
        //     'updated_by' => 1
        // ]);
        // DB::table('customers')->delete();

        // $datas = array(
        //     array('customer_code' => 'CUS001', 'customer_name' => 'master customer 1'),
        //     array('customer_code' => 'CUS002', 'customer_name' => 'master customer 2'),
        //     array('customer_code' => 'CUS003', 'customer_name' => 'master customer 3'),
        //     array('customer_code' => 'CUS004', 'customer_name' => 'master customer 4'),
        // );
        // DB::table('customers')->insert($datas);
    
    }
}
