<?php

namespace App\Http\Controllers;

use App\Models\PermissionGroup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionController extends Controller
{
    public function index()
    {
        // $permission = Permission::get();
        $all_roles = Role::orderBy('id', 'DESC')->get();
        // dd($all_roles);
        return view('settings.masters.permission.index', compact('all_roles'));
    }

    public function create()
    {
        return view('Master.usermanagement.permission.create');
    }

    public function store(Request $request)
    {
        $request->validate([

            'name' => 'required|regex:/^[A-Za-z ]+$/',

        ]);

        $input = [
            'name' => $request['name'],
        ];

        $permission = $input;
        Permission::create($permission);

        if ($permission) {
            return redirect()->route('permission.index')
                ->with('success', 'Permission created successfully');
        }

        return back()->with('failure', 'Please try again');
    }

    public function edit($id)
    {
        $role = Role::find($id);
        $permissionGroups = PermissionGroup::with('permissions')->get();
        $permission = Permission::get();
        $rolePermissions = DB::table("role_has_permissions")->where("role_has_permissions.role_id", $id)
            ->pluck('role_has_permissions.permission_id', 'role_has_permissions.permission_id')
            ->all();
        // dd($rolePermissions);
        return view('settings.masters.permission.edit', compact('role', 'permission', 'rolePermissions', 'permissionGroups'));
    }

    public function update(Request $request, $id)
    {
        // dd($request);
        $this->validate($request, [
            'name' => 'required',
            'permission' => 'required',
        ]);

        $role = Role::find($id);
        $role->name = $request->input('name');
        $role->save();

        $permissionIds = $request->input('permission'); // assuming this is an array of IDs
        $permissions = Permission::whereIn('id', $permissionIds)->pluck('name');
        $role->syncPermissions($permissions);

        return redirect()->route('permissions')
            ->with('success', 'Role & Permission updated successfully');
    }

    public function delete(string $id)
    {
        $permission = Permission::find($id);
        $permission->delete();


        if ($permission) {
            return redirect()->route('permission.index')
                ->with('success', 'Permission deleted successfully');
        }

        return back()->with('failure', 'Please try again');
    }
}
