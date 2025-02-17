<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         DB::table('products')->delete();
        
        $datas = array(
            array('name' => "Not Specified", 'code' => 'P1'),
        );

        DB::table('products')->insert($datas);
    }
}
