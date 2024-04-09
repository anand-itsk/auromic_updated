<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FinisingProductModelTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('finishing_product_models')->delete();

        $datas = array(
            array(
                'product_id' => '4',
                'product_size_id' => '2',
                'model_name' => 'Pant',
                'model_code' => 'PANTS',
                'meters_one_product' => '2',
                'wages_one_product' => '75',
                'cutting_charge' => '35',
            ),
            
            array(
                'product_id' => '4',
                'product_size_id' => '3',
                'model_name' => 'Pant',
                'model_code' => 'PANTM',
                'meters_one_product' => '2.5',
                'wages_one_product' => '75',
                'cutting_charge' => '35',
            ),

            array(
                'product_id' => '4',
                'product_size_id' => '4',
                'model_name' => 'Pant',
                'model_code' => 'PANTL',
                'meters_one_product' => '3',
                'wages_one_product' => '150',
                'cutting_charge' => '40',
            ),

            array(
                'product_id' => '4',
                'product_size_id' => '5',
                'model_name' => 'Pant',
                'model_code' => 'PANTXL',
                'meters_one_product' => '2',
                'wages_one_product' => '225',
                'cutting_charge' => '35',
            ),

           

            
        );

        DB::table('finishing_product_models')->insert($datas);
    }
}
