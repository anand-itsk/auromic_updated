<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('roles')->delete();
        echo '---------------------------------------' . "\n";
        echo '--------Role Seeding-------' . "\n";

        $roles = [
            [
                'name' => 'Developer'
            ],
            [
                'name' => 'Admin'
            ],
            [
                'name' => 'Employee'
            ],
        ];


        foreach ($roles as $key => $value) {
            $role = new Role();
            $role->name = $value['name'];
            $role->save();
            echo "-------Roles Name=> $role->name--------------" . "\n";
        }

        $super_admin = Role::all();

        $permission = Permission::get();
        foreach ($permission as $key => $value) {
            $super_admin[0]->givePermissionTo($value->name);
            $super_admin[1]->givePermissionTo($value->name);
        }
    }
}
