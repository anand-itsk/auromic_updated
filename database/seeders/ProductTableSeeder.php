<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         DB::table('products')->delete();
        
        $datas = array(
            array('name' => "Not Specified", 'code' => 'P1'),
            array('name' => "Crocheted Scarf", 'code' => 'P2'),
            array('name' => "Crocheted Dress", 'code' => 'P3'),
            array('name' => "Finishing", 'code' => 'P4'),
            array('name' => "Crocheted Finishing", 'code' => 'P5'),
            array('name' => "Crochet HDPE Twine Bag", 'code' => 'P6'),
            array('name' => "Readymade Items", 'code' => 'P7'),
            array('name' => "Crocheted Hat", 'code' => 'P8'),
            array('name' => "Crocheted Bag", 'code' => 'P9'),
            array('name' => "Crocheted Cap", 'code' => 'P10'),
            array('name' => "Crocheted Animals", 'code' => 'P11'),
            array('name' => "Crochet Items", 'code' => 'P12'),

        );

        DB::table('products')->insert($datas);
    }
}
