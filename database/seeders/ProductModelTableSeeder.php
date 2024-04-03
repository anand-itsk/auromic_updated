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
                'raw_material_id' => '6',
                'product_id' => '7',
                'product_size_id' => '2',
                'model_code' => 'WLPS',
                'model_name' => 'Wool packer',
                'raw_material_weight_item' => '0.2',
                'wages_product' => '15',
            ),

            array(
                'raw_material_id' => '6',
                'product_id' => '7',
                'product_size_id' => '3',
                'model_code' => 'WLPM',
                'model_name' => 'Wool packer',
                'raw_material_weight_item' => '0.2',
                'wages_product' => '20',
            ),

            array(
                'raw_material_id' => '6',
                'product_id' => '7',
                'product_size_id' => '4',
                'model_code' => 'WLPL',
                'model_name' => 'Wool packer',
                'raw_material_weight_item' => '0.2',
                'wages_product' => '25',
            ),

            array(
                'raw_material_id' => '6',
                'product_id' => '7',
                'product_size_id' => '5',
                'model_code' => 'WLPX/L',
                'model_name' => 'Wool packer',
                'raw_material_weight_item' => '0.2',
                'wages_product' => '30',
            ),

            array(
                'raw_material_id' => '6',
                'product_id' => '7',
                'product_size_id' => '6',
                'model_code' => 'WLPO',
                'model_name' => 'Wool packer',
                'raw_material_weight_item' => '0.2',
                'wages_product' => '50',
            ),

            array(
                'raw_material_id' => '6',
                'product_id' => '7',
                'product_size_id' => '7',
                'model_code' => 'WLPXX/L',
                'model_name' => 'Wool packer',
                'raw_material_weight_item' => '0.2',
                'wages_product' => '40',
            ),

            array(
                'raw_material_id' => '2',
                'product_id' => '8',
                'product_size_id' => '2',
                'model_code' => 'ANGHS',
                'model_name' => 'Angel Hat',
                'raw_material_weight_item' => '0.2',
                'wages_product' => '65',
            ),

            array(
                'raw_material_id' => '2',
                'product_id' => '8',
                'product_size_id' => '3',
                'model_code' => 'ANGHM',
                'model_name' => 'Angel Hat',
                'raw_material_weight_item' => '0.2',
                'wages_product' => '75',
            ),

            array(
                'raw_material_id' => '2',
                'product_id' => '8',
                'product_size_id' => '4',
                'model_code' => 'ANGHL',
                'model_name' => 'Angel Hat',
                'raw_material_weight_item' => '0.2',
                'wages_product' => '85',
            ),

            array(
                'raw_material_id' => '2',
                'product_id' => '8',
                'product_size_id' => '2',
                'model_code' => 'JASHS',
                'model_name' => 'Jassy Hat',
                'raw_material_weight_item' => '0.5',
                'wages_product' => '30',
            ),

            array(
                'raw_material_id' => '2',
                'product_id' => '11',
                'product_size_id' => '4',
                'model_code' => 'HORSEL',
                'model_name' => 'Horse',
                'raw_material_weight_item' => '0.2',
                'wages_product' => '36',
            ),

            array(
                'raw_material_id' => '2',
                'product_id' => '11',
                'product_size_id' => '6',
                'model_code' => 'YELFXO',
                'model_name' => 'Yellow Fish',
                'raw_material_weight_item' => '0.02',
                'wages_product' => '17',
            ),

            array(
                'raw_material_id' => '2',
                'product_id' => '7',
                'product_size_id' => '3',
                'model_code' => 'MONSWM',
                'model_name' => 'Moon Sweater',
                'raw_material_weight_item' => '0.5',
                'wages_product' => '75',
            ),

            array(
                'raw_material_id' => '2',
                'product_id' => '7',
                'product_size_id' => '3',
                'model_code' => 'FVSM',
                'model_name' => 'Flo Vest Stitch',
                'raw_material_weight_item' => '0.5',
                'wages_product' => '75',
            ),

            array(
                'raw_material_id' => '2',
                'product_id' => '7',
                'product_size_id' => '3',
                'model_code' => 'TWSM',
                'model_name' => 'Twinsun Sweater',
                'raw_material_weight_item' => '0.5',
                'wages_product' => '75',
            ),

            array(
                'raw_material_id' => '2',
                'product_id' => '7',
                'product_size_id' => '3',
                'model_code' => 'TWCPM',
                'model_name' => 'Twinsun Cardy Plain',
                'raw_material_weight_item' => '0.5',
                'wages_product' => '75',
            ),
        );

        DB::table('product_models')->insert($datas);
    }
}
