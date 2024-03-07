<?php

namespace App\Http\Controllers;
use App\Models\Country;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;

class MyProfileController extends Controller
{
    //

    public function index()
    {
        // dd("test");
       $user = Auth::user()->load('country','roles');


        return view('my_profile.index', ['user' => $user]);
    }

    public function edit()
    {
        $user = Auth::user();

        $countries = Country::all();

        $role = Role::all();

        return view('my_profile.edit', ['user' => $user,'countries' => $countries, 'role'=>$role]);
    }

     public function update(Request $request)
    {
        // dd($request);
          $request->validate([
            'name' => 'required',
            'email' => 'required',
            'country_id' => 'required',
            
        ]);
    
        $profile = Auth::user();
        $profile->name = $request->input('name');
        $profile->email = $request->input('email');
        $profile->country_id = $request->input('country_id');
        // dd($profile);
        if ($request->hasFile('user_profile')) {
            $filename = $request->file('user_profile')->store('user/profile/image', 'public');
            $profile->profile_image = $filename;
        }
        $profile->save();
    
         return redirect()->route('my-profile')->with('success', 'Profile Updated successfully!');
    }
  
}
