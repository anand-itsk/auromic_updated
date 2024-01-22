<?php

namespace App\Http\Controllers;

use App\Imports\UserDataImport;
use App\Models\User;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
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

    public function deleteSelected(Request $request)
    {

        $ids = $request->ids;

        if (!is_array($ids)) {
            return response()->json(['status' => 'error', 'message' => 'Invalid input'], 400);
        }

        User::destroy($ids);
        return response()->json(['status' => 'success']);
    }

    public function importExcel(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:xlsx,csv'
        ]);

        Excel::import(new UserDataImport, request()->file('file'));

        return back()->with('success', 'Data imported successfully');
    }
}
