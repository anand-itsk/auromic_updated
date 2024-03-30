<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSizeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('product_sizes')->delete();
        
        $datas = array(
            array('name' => "Not Specified", 'code' => 'N/S'),
            array('name' => "Small", 'code' => 'S'),
            array('name' => "Medium", 'code' => 'M'),
            array('name' => "Large", 'code' => 'L'),
            array('name' => "Extra Large", 'code' => 'XL'),
            array('name' => "Other", 'code' => 'O'),

        );

        DB::table('product_sizes')->insert($datas);
    }
}
