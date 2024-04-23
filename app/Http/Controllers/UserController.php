<?php

namespace App\Http\Controllers;

use App\Imports\UserDataImport;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    // Index Page
    public function index()
    {
        $user = Auth::user()->load('country', 'roles');
        return view('settings.masters.users.index', ['user' => $user]);
    }
    // Index DataTable
    public function usersData()
    {
        // Eager load the roles relationship
        $users = User::with('roles')->select('users.*');

        return DataTables::of($users)
            ->addColumn('role', function (User $user) {
                // Concatenate all user roles into a string. Adjust as needed.
                return $user->roles->pluck('name')->join(', ');
            })
            ->rawColumns(['role']) // If you're using HTML inside the role column
            ->make(true);
    }
    // Create Page
    public function create()
    {
        $roles = Role::all();
        return view('settings.masters.users.create', ['roles' => $roles]);
    }
    // Store Date
    public function store(Request $request)
    {
        $auth_id = auth()->id();
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed',
            'role' => 'required',
            'remark'=>'nullable'
        ]);
        
        $input = $request->all();

        $input['password'] = Hash::make($input['password']);
        $input['created_by'] = $auth_id;
        $input['updated_by'] = $auth_id;
        $user = User::create($input);
        $role = Role::findById($request->input('role'));
        $user->assignRole($role);

        return redirect()->route('user-management.users')
            ->with('success', 'User created successfully');
    }
    // Edit
    public function edit(Role $roles, $id)
    {
        $user = User::with('roles')->find($id);
        $roles = Role::all();
        $userRole = $user->roles->first();
        return view('settings.masters.users.edit', compact('user', 'userRole', 'roles'));
    }
    // Updata
    public function update(Request $request, $id)
    {
        // dd($request);
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'confirmed',
            'role' => 'required',
            'remark' => 'nullable|string',

        ]);


        $input = $request->all();
        // dd($input);
        if (!empty($input['password'])) {
            $input['password'] = Hash::make($input['password']);
        } else {
            $input = Arr::except($input, array('password'));
        }
     
        $user = User::with('roles')->find($id);
        // dd($user);
        $user->update($input);
        $user->syncRoles($input['role']);
        if ($user) {
            return redirect()->route('user-management.users')
                ->with('success', 'User updated successfully');
        }

        return back()->with('failure', 'Please try again');
    }
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        // return response()->json(['success' => 'User deleted successfully']);
    }

    public function show($id)
    {
        $user = User::findOrFail($id);

        return response()->json(['user' =>  $user]);
    }

    public function block($id)
    {
        $user = User::findOrFail($id);
        $user->is_blocked = true; // Assuming you have an 'is_blocked' attribute
        $user->save();

        return response()->json(['success' => 'User blocked successfully']);
    }
    // Multi Delete
    public function deleteSelected(Request $request)
    {

        $ids = $request->ids;

        if (!is_array($ids)) {
            return response()->json(['status' => 'error', 'message' => 'Invalid input'], 400);
        }

        User::destroy($ids);
        return response()->json(['status' => 'success']);
    }
    // Import User page
    public function importUserPage()
    {
        return view('settings.masters.users.import');
    }
    // Import Users
    public function importUsers(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:xlsx,csv'
        ]);

        Excel::import(new UserDataImport, request()->file('file'));

        return redirect()->route('users')->with('success', 'Data imported successfully');
    }
}
