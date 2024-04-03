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
            array('raw_material_type_id' => "1", 'name' => 'Not Specifiy', 'stock' => '0'),
            array('raw_material_type_id' => "2", 'name' => '100% Cotton', 'stock' => '100'),
            array('raw_material_type_id' => "3", 'name' => '100% Jute', 'stock' => '200'),
            array('raw_material_type_id' => "4", 'name' => '100% Lurex', 'stock' => '500'),
            array('raw_material_type_id' => "5", 'name' => '100% Organic Cotton', 'stock' => '1000'),
            array('raw_material_type_id' => "6", 'name' => 'Wool/Silk', 'stock' => '50'),

        );

        DB::table('raw_materials')->insert($datas);
    }
}
