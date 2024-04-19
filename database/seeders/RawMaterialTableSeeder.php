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

        );

        DB::table('raw_materials')->insert($datas);
    }
}
