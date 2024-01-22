<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class UserController extends Controller
{

    public function index()
    {
        // $users = User::all();
        // dd($users);
        return view('settings.masters.users.index');
    }
    public function usersData()
    {
        $query = User::query();
        // dd($query);
        return DataTables::of($query)->make(true);
    }
}
