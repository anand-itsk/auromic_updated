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
          $permissionGroups = PermissionGroup::with('permissions')->get();
          $permission = Permission::get();
  
        return view('settings.masters.permission.create',compact('permissionGroups','permission'));
    }

    public function store(Request $request)
    {
         $request->validate([
            'role' => 'required|regex:/^[A-Za-z ]+$/',
            'permission' => 'required|array',
        ]);

         $role = Role::create(['name' => $request->input('role')]);
         $permissionIds = $request->input('permission');
         $permissions = Permission::whereIn('id', $permissionIds)->pluck('name');
         $role->syncPermissions($permissions);

        if ($role) {
            return redirect()->route('user-management.permissions')
                ->with('success', 'Role & Permission created successfully');
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

        return redirect()->route('user-management.permissions')
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
