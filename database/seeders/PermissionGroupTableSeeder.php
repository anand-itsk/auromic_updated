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
            [
                'name' => 'Users'
            ],
            [
                'name' => 'Permissions'
            ],
            [
                'name' => 'Country'
            ],
            [
                'name' => 'State'
            ],
            [
                'name' => 'District'
            ],
            [
                'name' => 'Religion'
            ],
            [
                'name' => 'Caste'
            ],
            [
                'name' => 'Nationality'
            ],
            [
                'name' => 'Company Type'
            ],
            [
                'name' => 'Resigning'
            ],
            [
                'name' => 'Local Offices'
            ],
            [
                'name' => 'ESI Dispensary'
            ],
            [
                'name' => 'Raw Material Type'
            ],
            [
                'name' => 'Raw Material'
            ],
            [
                'name' => 'Product'
            ],
            [
                'name' => 'Product Size'
            ],
            [
                'name' => 'Product Color'
            ],
            [
                'name' => 'Order Status'
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