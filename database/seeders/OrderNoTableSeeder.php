<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrderNoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('order_nos')->delete();

        $datas = array(
            array('last_order_number' => "ORD1", 'created_by' => 1),
            array('last_order_number' => "ORD2", 'code' => 1),

        );

        DB::table('order_nos')->insert($datas);
    }
}
