<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductColorTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('product_colors')->delete();

        $datas = array(
            array('name' => "Not Specified", 'code' => 'N/S'),
            array('name' => "Pink", 'code' => 'PC'),
            array('name' => "Red", 'code' => 'RC'),
            array('name' => "Yello", 'code' => 'YC'),
            array('name' => "Blue", 'code' => 'BC'),
            array('name' => "Green", 'code' => 'GC'),
            array('name' => "C Mix", 'code' => 'MC'),

        );

        DB::table('product_colors')->insert($datas);
    }
}
