<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrderStatusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('order_statuses')->delete();
        
        $datas = array(
            array('name' => "Not Specified", 'code' => 'N/S'),
            array('name' => "Open", 'code' => 'OP'),
            array('name' => "Complete", 'code' => 'CP'),
            array('name' => "Pending", 'code' => 'PE'),

        );

        DB::table('order_statuses')->insert($datas);
    }
}
