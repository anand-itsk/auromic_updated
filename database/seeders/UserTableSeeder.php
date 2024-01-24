<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()->count(10000)->create();

        //     DB::table('users')->delete();
        //     echo '---------------------------------------' . "\n";
        //     echo '--------User Seeding-------' . "\n";

        //     $datas = [
        //         [
        //             'name' => 'Developer',
        //             'email' => 'developer@syscorp.in',
        //             'password' => 'coconut143',
        //             'created_by' => 1,
        //             'updated_by' => 1
        //         ],
        //         [
        //             'name' => 'Admin',
        //             'email' => 'admin@auromics.com',
        //             'password' => 'notnow',
        //             'created_by' => 1,
        //             'updated_by' => 1
        //         ],
        //         [
        //             'name' => 'ragul',
        //             'email' => 'ragul@itsk.in',
        //             'password' => 'password',
        //             'created_by' => 1,
        //             'updated_by' => 1
        //         ],

        //     ];


        //     foreach ($datas as $key => $value) {
        //         $data = new User();
        //         $data->name = $value['name'];
        //         $data->email = $value['email'];
        //         $data->password = $value['password'];
        //         $data->created_by = $value['created_by'];
        //         $data->updated_by = $value['updated_by'];
        //         $data->save();
        //         echo "-------Roles Name=> $data->name --------------" . "\n";
        //     }
        // }
    }
}
