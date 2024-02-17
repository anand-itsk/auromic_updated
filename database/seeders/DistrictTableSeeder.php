<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DistrictTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('districts')->delete();
        $districts = array(
            array('state_id' => 1, 'name' => "Not Specified",'code' => "NS"),
            array('state_id' => 28, 'name' => "Ariyalur",'code' => "AR"),
            array('state_id' => 28, 'name' => "Chengalpattu",'code' => "CP"),
            array('state_id' => 28, 'name' => "Chennai",'code' => "CH"),
            array('state_id' => 28, 'name' => "Coimbatore",'code' => "CB"),
            array('state_id' => 28, 'name' => "Cuddalore",'code' => "CD"),
            array('state_id' => 28, 'name' => "Dharmapuri",'code' => "DP"),
            array('state_id' => 28, 'name' => "Dindigul",'code' => "DK"),
            array('state_id' => 28, 'name' => "Erode",'code' => "ER"),
            array('state_id' => 28, 'name' => "Kallakurichi",'code' => "KK"),
            array('state_id' => 28, 'name' => "Kanchipuram",'code' => "KP"),
            array('state_id' => 28, 'name' => "Kanyakumari",'code' => "KY"),
            array('state_id' => 28, 'name' => "Karur",'code' => "KR"),
            array('state_id' => 28, 'name' => "Krishnagiri",'code' => "KG"),
            array('state_id' => 28, 'name' => "Madurai",'code' => "MD"),
            array('state_id' => 28, 'name' => "Nagapattinam",'code' => "NP"),
            array('state_id' => 28, 'name' => "Namakkal",'code' => "NK"),
            array('state_id' => 28, 'name' => "Nilgiris",'code' => "NL"),
            array('state_id' => 28, 'name' => "Perambalur",'code' => "PR"),
            array('state_id' => 28, 'name' => "Pudukkottai",'code' => "PD"),
            array('state_id' => 28, 'name' => "Ramanathapuram",'code' => "RM"),
            array('state_id' => 28, 'name' => "Ranipet",'code' => "RP"),
            array('state_id' => 28, 'name' => "Salem",'code' => "SE"),
            array('state_id' => 28, 'name' => "Sivaganga",'code' => "SG"),
            array('state_id' => 28, 'name' => "Tenkasi",'code' => "TK"),
            array('state_id' => 28, 'name' => "Thanjavur",'code' => "TJ"),
            array('state_id' => 28, 'name' => "Theni",'code' => "TH"),
            array('state_id' => 28, 'name' => "Thoothukudi (Tuticorin)",'code' => "TH"),
            array('state_id' => 28, 'name' => "Tiruchirappalli",'code' => "TP"),
            array('state_id' => 28, 'name' => "Tirunelveli",'code' => "TV"),
            array('state_id' => 28, 'name' => "Tirupathur",'code' => "TP"),
            array('state_id' => 28, 'name' => "Tiruppur",'code' => "TR"),
            array('state_id' => 28, 'name' => "Tiruvallur",'code' => "TV"),
            array('state_id' => 28, 'name' => "Tiruvannamalai",'code' => "TR"),
            array('state_id' => 28, 'name' => "Tiruvarur",'code' => "TR"),
            array('state_id' => 28, 'name' => "Vellore",'code' => "VE"),
            array('state_id' => 28, 'name' => "Viluppuram",'code' => "VL"),
            array('state_id' => 28, 'name' => "Virudhunagar",'code' => "VR"),
        );
        DB::table('districts')->insert($districts);
    }
}
