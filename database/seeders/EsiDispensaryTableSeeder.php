<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EsiDispensaryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('esi_dispensaries')->delete();

        $datas = array(
            array('name' => "Not Specified", 'code' => 'NS'),
            
        );
        DB::table('esi_dispensaries')->insert($datas);
    }
}
