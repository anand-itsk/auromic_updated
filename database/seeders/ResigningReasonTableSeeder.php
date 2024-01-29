<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ResigningReasonTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('resigning_reasons')->delete();

        $datas = array(
            array('name' => 'Not Specified', 'code' => 'NS'),
        );

        DB::table('resigning_reasons')->insert($datas);
    }
}
