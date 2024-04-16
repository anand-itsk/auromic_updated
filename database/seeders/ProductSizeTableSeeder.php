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

        );

        DB::table('product_sizes')->insert($datas);
    }
}
