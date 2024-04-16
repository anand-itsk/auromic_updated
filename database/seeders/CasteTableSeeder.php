<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CasteTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('castes')->delete();
        
        $datas = array(
            array('name' => "Not Specified", 'code' => 'N/S'),
        );

        DB::table('castes')->insert($datas);
    }
}
