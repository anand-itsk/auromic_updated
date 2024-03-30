<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductModelTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('product_models')->delete();

        $datas = array(
            array(
                'raw_material_id' => '2',
                'product_id' => '8',
                'product_size_id' => '6',
                'model_code' => 'PM1',
                'model_name' => 'Angel Hat',
                'raw_material_weight_item' => '0.2',
                'wages_product' => '65',
            ),

            array(
                'raw_material_id' => '2',
                'product_id' => '8',
                'product_size_id' => '6',
                'model_code' => 'PM2',
                'model_name' => 'Jassy Hat',
                'raw_material_weight_item' => '0.5',
                'wages_product' => '75',
            ),

            array(
                'raw_material_id' => '2',
                'product_id' => '11',
                'product_size_id' => '4',
                'model_code' => 'PM3',
                'model_name' => 'Horse',
                'raw_material_weight_item' => '0.2',
                'wages_product' => '36',
            ),

            array(
                'raw_material_id' => '2',
                'product_id' => '11',
                'product_size_id' => '6',
                'model_code' => 'PM4',
                'model_name' => 'Yellow Fish',
                'raw_material_weight_item' => '0.02',
                'wages_product' => '17',
            ),

            array(
                'raw_material_id' => '2',
                'product_id' => '7',
                'product_size_id' => '3',
                'model_code' => 'PM5',
                'model_name' => 'Moon Sweater',
                'raw_material_weight_item' => '0.5',
                'wages_product' => '75',
            ),

            array(
                'raw_material_id' => '2',
                'product_id' => '7',
                'product_size_id' => '3',
                'model_code' => 'PM6',
                'model_name' => 'Flo Vest Stitch',
                'raw_material_weight_item' => '0.5',
                'wages_product' => '75',
            ),

            array(
                'raw_material_id' => '2',
                'product_id' => '7',
                'product_size_id' => '3',
                'model_code' => 'PM7',
                'model_name' => 'Twinsun Sweater',
                'raw_material_weight_item' => '0.5',
                'wages_product' => '75',
            ),

            array(
                'raw_material_id' => '2',
                'product_id' => '7',
                'product_size_id' => '3',
                'model_code' => 'PM8',
                'model_name' => 'Twinsun Cardy Plain',
                'raw_material_weight_item' => '0.5',
                'wages_product' => '75',
            ),
        );

        DB::table('product_models')->insert($datas);
    }
}
