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
            array('state_id' => 27, 'name' => "Ariyalur",'code' => "AR"),
            array('state_id' => 27, 'name' => "Chengalpattu",'code' => "CP"),
            array('state_id' => 27, 'name' => "Chennai",'code' => "CH"),
            array('state_id' => 27, 'name' => "Coimbatore",'code' => "CB"),
            array('state_id' => 27, 'name' => "Cuddalore",'code' => "CD"),
            array('state_id' => 27, 'name' => "Dharmapuri",'code' => "DP"),
            array('state_id' => 27, 'name' => "Dindigul",'code' => "DK"),
            array('state_id' => 27, 'name' => "Erode",'code' => "ER"),
            array('state_id' => 27, 'name' => "Kallakurichi",'code' => "KK"),
            array('state_id' => 27, 'name' => "Kanchipuram",'code' => "KP"),
            array('state_id' => 27, 'name' => "Kanyakumari",'code' => "KY"),
            array('state_id' => 27, 'name' => "Karur",'code' => "KR"),
            array('state_id' => 27, 'name' => "Krishnagiri",'code' => "KG"),
            array('state_id' => 27, 'name' => "Madurai",'code' => "MD"),
            array('state_id' => 27, 'name' => "Nagapattinam",'code' => "NP"),
            array('state_id' => 27, 'name' => "Namakkal",'code' => "NK"),
            array('state_id' => 27, 'name' => "Nilgiris",'code' => "NL"),
            array('state_id' => 27, 'name' => "Perambalur",'code' => "PR"),
            array('state_id' => 27, 'name' => "Pudukkottai",'code' => "PD"),
            array('state_id' => 27, 'name' => "Ramanathapuram",'code' => "RM"),
            array('state_id' => 27, 'name' => "Ranipet",'code' => "RP"),
            array('state_id' => 27, 'name' => "Salem",'code' => "SE"),
            array('state_id' => 27, 'name' => "Sivaganga",'code' => "SG"),
            array('state_id' => 27, 'name' => "Tenkasi",'code' => "TK"),
            array('state_id' => 27, 'name' => "Thanjavur",'code' => "TJ"),
            array('state_id' => 27, 'name' => "Theni",'code' => "TH"),
            array('state_id' => 27, 'name' => "Thoothukudi (Tuticorin)",'code' => "TH"),
            array('state_id' => 27, 'name' => "Tiruchirappalli",'code' => "TP"),
            array('state_id' => 27, 'name' => "Tirunelveli",'code' => "TV"),
            array('state_id' => 27, 'name' => "Tirupathur",'code' => "TP"),
            array('state_id' => 27, 'name' => "Tiruppur",'code' => "TR"),
            array('state_id' => 27, 'name' => "Tiruvallur",'code' => "TV"),
            array('state_id' => 27, 'name' => "Tiruvannamalai",'code' => "TR"),
            array('state_id' => 27, 'name' => "Tiruvarur",'code' => "TR"),
            array('state_id' => 27, 'name' => "Vellore",'code' => "VE"),
            array('state_id' => 27, 'name' => "Viluppuram",'code' => "VL"),
            array('state_id' => 27, 'name' => "Virudhunagar",'code' => "VR"),
            array('state_id' => 23, 'name' => "Pondicherry",'code' => "PY"),
            array('state_id' => 2, 'name' => "Tirupati",'code' => "TY"),
        );
        DB::table('districts')->insert($districts);
    }
}
