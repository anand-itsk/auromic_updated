<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class RawMaterialTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
     public function run(): void
    {
         DB::table('raw_materials')->delete();
        
        $datas = array(
            array('raw_material_type_id' => "2", 'name' => 'Cotton', 'stock' => '10'),
             array('raw_material_type_id' => "2", 'name' => 'Slik', 'stock' => '11'),

        );

        DB::table('raw_materials')->insert($datas);
    }
}
