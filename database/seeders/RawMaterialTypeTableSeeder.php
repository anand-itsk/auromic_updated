<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RawMaterialTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('raw_material_types')->delete();

        $datas = array(
            array('name' => "Not Specified", 'code' => 'N/S'),
            array('name' => "Cotton", 'code' => 'RMT1'),
            array('name' => "Jute", 'code' => 'RMT2'),
            array('name' => "Lurex", 'code' => 'RMT3'),
            array('name' => "Organic Cotton", 'code' => 'RMT4'),
        );

        DB::table('raw_material_types')->insert($datas);
    }
}
