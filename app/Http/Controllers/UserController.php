<?php

namespace App\Http\Controllers;

use App\Imports\UserDataImport;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\DataTables;

class UserController extends Controller
{

    public function index()
    {
        return view('settings.masters.users.index');
    }

    public function usersData()
    {
        $query = User::query();
        return DataTables::of($query)->make(true);
    }

    public function deleteSelected(Request $request)
    {

        $ids = $request->ids;

        if (!is_array($ids)) {
            return response()->json(['status' => 'error', 'message' => 'Invalid input'], 400);
        }

        User::destroy($ids);
        return response()->json(['status' => 'success']);
    }

    public function create()
    {
        $roles = Role::all();
        return view('settings.masters.users.create', ['roles' => $roles]);
    }

    public function importUserPage()
    {
        return view('settings.masters.users.import');
    }
    public function importUsers(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:xlsx,csv'
        ]);

        Excel::import(new UserDataImport, request()->file('file'));

        return redirect()->route('users')->with('success', 'Data imported successfully');
    }

    public function store(Request $request)
    {
        $auth_id = auth()->id();
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed',
            'role' => 'required'
        ]);
        $input = $request->all();
        $input['password'] = Hash::make($input['password']);
        $input['created_by'] = $auth_id;
        $input['updated_by'] = $auth_id;
        $user = User::create($input);
        $role = Role::findById($request->input('role'));
        $user->assignRole($role);

        return redirect()->route('users')
            ->with('success', 'User created successfully');
    }
}
