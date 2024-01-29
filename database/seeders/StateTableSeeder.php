<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StateTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('states')->delete();
        $states = array(
            array('country_id' => 1, 'name' => "Not Specified", 'code' => "NS"),
            array('country_id' => 101, 'name' => "Not Specified", 'code' => "NS"),
            array('country_id' => 101, 'name' => "Andhra Pradesh", 'code' => "AD"),
            array('country_id' => 101, 'name' => "Arunachal Pradesh", 'code' => "AR"),
            array('country_id' => 101, 'name' => "Assam", 'code' => "AS"),
            array('country_id' => 101, 'name' => "Bihar", 'code' => "BR"),
            array('country_id' => 101, 'name' => "Chhattisgarh", 'code' => "CT"),
            array('country_id' => 101, 'name' => "Goa", 'code' => "GO"),
            array('country_id' => 101, 'name' => "Gujarat", 'code' => "GJ"),
            array('country_id' => 101, 'name' => "Haryana", 'code' => "HR"),
            array('country_id' => 101, 'name' => "Himachal Pradesh", 'code' => "HP"),
            array('country_id' => 101, 'name' => "Jammu and Kashmir", 'code' => "JK"),
            array('country_id' => 101, 'name' => "Jharkhand", 'code' => "JH"),
            array('country_id' => 101, 'name' => "Karnataka", 'code' => "KA"),
            array('country_id' => 101, 'name' => "Kerala", 'code' => "KL"),
            array('country_id' => 101, 'name' => "Lakshadweep Islands", 'code' => "LD"),
            array('country_id' => 101, 'name' => "Madhya Pradesh", 'code' => "MP"),
            array('country_id' => 101, 'name' => "Maharashtra", 'code' => "MH"),
            array('country_id' => 101, 'name' => "Manipur", 'code' => "MN"),
            array('country_id' => 101, 'name' => "Meghalaya", 'code' => "ML"),
            array('country_id' => 101, 'name' => "Mizoram", 'code' => "MZ"),
            array('country_id' => 101, 'name' => "Nagaland", 'code' => "NL"),
            array('country_id' => 101, 'name' => "Odisha", 'code' => "OD"),
            array('country_id' => 101, 'name' => "Pondicherry", 'code' => "PY"),
            array('country_id' => 101, 'name' => "Punjab", 'code' => "PB"),
            array('country_id' => 101, 'name' => "Rajasthan", 'code' => "RJ"),
            array('country_id' => 101, 'name' => "Sikkim", 'code' => "SK"),
            array('country_id' => 101, 'name' => "Tamil Nadu", 'code' => "TN"),
            array('country_id' => 101, 'name' => "Telangana", 'code' => "TS"),
            array('country_id' => 101, 'name' => "Tripura", 'code' => "TR"),
            array('country_id' => 101, 'name' => "Uttar Pradesh", 'code' => "UP"),
            array('country_id' => 101, 'name' => "Uttarakhand", 'code' => "UK"),
            array('country_id' => 101, 'name' => "West Bengal", 'code' => "WB"),
            array('country_id' => 101, 'name' => "Delhi", 'code' => "DL"),
        );
        DB::table('states')->insert($states);
    }
}
