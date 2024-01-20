<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PermissionGroup;


class PermissionGroupTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissionGroup = [
            [
                'name' => 'Menus'
            ],
            [
                'name' => 'Settings'
            ],
            [
                'name' => 'Profile'
            ],
            [
                'name'  => 'Master Company'
            ],
             [
                'name'  => 'Client Company'
            ],
            [
                'name'  => 'Sub-client Company'
            ],
            

        ];

        echo '---------------------------------------' . "\n";
        echo '--------Permission Group Seeding-------' . "\n";

        foreach ($permissionGroup as $key => $value) {
            $permissionGroup = new PermissionGroup();
            $permissionGroup->name = $value['name'];
            $permissionGroup->save();
            echo "-------Permission Group Name=> $permissionGroup->name--------------" . "\n";
        }
        echo "-------Permission Group Seeding Completed--------------" . "\n";
    }
    }