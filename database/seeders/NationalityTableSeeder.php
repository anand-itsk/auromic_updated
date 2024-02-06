<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NationalityTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('nationalities')->delete();
        
        $datas = array(
            array('name' => "Not Specified", 'code' => 'N/S'),
            array('name' => "Indian", 'code' => 'IND'),

        );

        DB::table('nationalities')->insert($datas);
    }
}
