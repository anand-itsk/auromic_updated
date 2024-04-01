<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrderDetailTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('order_details')->delete();

        $datas = array(
            array(
                'order_no_id' => 1,
                'order_date' => Carbon::now()->format('Y-m-d'),
                'customer_id' => 2,
                'product_model_id' => 5,
                'product_color_id' => 7,
                'quantity' => 20,
                'available_quantity' => 20,
                'delivery_date' => Carbon::create(2024, 4, 10)->format('Y-m-d'),
                'order_status_id' => 2,
                'weight_per_item' => 0.5,
                'available_weight' => 10,
                'total_raw_material' => 10
            ),

            array(
                'order_no_id' => 1,
                'order_date' => Carbon::now()->format('Y-m-d'),
                'customer_id' => 2,
                'product_model_id' => 1,
                'product_color_id' => 6,
                'quantity' => 15,
                'available_quantity' => 15,
                'delivery_date' => Carbon::create(2024, 4, 15)->format('Y-m-d'),
                'order_status_id' => 2,
                'weight_per_item' => 0.2,
                'available_weight' => 3,
                'total_raw_material' => 3
            ),

            array(
                'order_no_id' => 2,
                'order_date' => Carbon::now()->format('Y-m-d'),
                'customer_id' => 2,
                'product_model_id' => 6,
                'product_color_id' => 4,
                'quantity' => 12,
                'available_quantity' => 12,
                'delivery_date' => Carbon::create(2024, 4, 05)->format('Y-m-d'),
                'order_status_id' => 2,
                'weight_per_item' => 0.5,
                'available_weight' => 6,
                'total_raw_material' => 6
            ),

        );

        DB::table('order_details')->insert($datas);
    }
}
