<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use App\Models\PermissionGroup;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permission = [
            // Dashboard
            [
                'name' => 'Master Company',
                'permission_group_id' => PermissionGroup::where('name', 'Menus')->first()->id
            ],
            [
                'name' => 'Client Company',
                'permission_group_id' => PermissionGroup::where('name', 'Menus')->first()->id
            ],
            [
                'name' => 'Sub-client Company',
                'permission_group_id' => PermissionGroup::where('name', 'Menus')->first()->id
            ],
            [
                'name' => 'M.C Read',
                'permission_group_id' => PermissionGroup::where('name', 'Master Company')->first()->id
            ],
            [
                'name' => 'M.C Write',
                'permission_group_id' => PermissionGroup::where('name', 'Master Company')->first()->id
            ],
            [
                'name' => 'M.C Update',
                'permission_group_id' => PermissionGroup::where('name', 'Master Company')->first()->id
            ],
            [
                'name' => 'M.C Delete',
                'permission_group_id' => PermissionGroup::where('name', 'Master Company')->first()->id
            ],
            [
                'name' => 'M.C Import',
                'permission_group_id' => PermissionGroup::where('name', 'Master Company')->first()->id
            ],
            [
                'name' => 'M.C Export',
                'permission_group_id' => PermissionGroup::where('name', 'Master Company')->first()->id
            ],
            [
                'name' => 'C.C Read',
                'permission_group_id' => PermissionGroup::where('name', 'Client Company')->first()->id
            ],
            [
                'name' => 'C.C Write',
                'permission_group_id' => PermissionGroup::where('name', 'Client Company')->first()->id
            ],
            [
                'name' => 'C.C Update',
                'permission_group_id' => PermissionGroup::where('name', 'Client Company')->first()->id
            ],
            [
                'name' => 'C.C Delete',
                'permission_group_id' => PermissionGroup::where('name', 'Client Company')->first()->id
            ],
            [
                'name' => 'C.C Import',
                'permission_group_id' => PermissionGroup::where('name', 'Client Company')->first()->id
            ],
            [
                'name' => 'C.C Export',
                'permission_group_id' => PermissionGroup::where('name', 'Client Company')->first()->id
            ],
            
        ];

        echo '---------------------------------------' . "\n";
        echo '--------Permission Seeding-------' . "\n";

        foreach ($permission as $key => $value) {
            $permission = new Permission;
            $permission->name = $value['name'];
            $permission->permission_group_id = $value['permission_group_id'];
            $permission->save();
            echo "-------Permission Name=> $permission->name--------------" . "\n";
        }
        echo "-------Permission Seeding Completed--------------" . "\n";
    }
}
