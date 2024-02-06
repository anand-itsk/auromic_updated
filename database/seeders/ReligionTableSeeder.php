<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ReligionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('religions')->delete();

        $datas = array(
            array('name' => "Not Specified", 'code' => 'N/S'),
            array('name' => "Religion 1", 'code' => 'R1'),

        );

        DB::table('religions')->insert($datas);
    }
}
