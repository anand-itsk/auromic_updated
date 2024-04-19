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

        );

        DB::table('product_colors')->insert($datas);
    }
}
