<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MyProfileController extends Controller
{
    //

    public function index()
    {
        // dd("test");
        $user = Auth::user();

        return view('my_profile.index', ['user' => $user]);
    }

    public function edit()
    {
        $user = Auth::user();

        return view('my_profile.edit', ['user' => $user]);
    }
}
