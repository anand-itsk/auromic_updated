<?php

namespace App\Http\Controllers;
use App\Models\Country;
use Illuminate\Http\Request;

class CountryController extends Controller
{
     public function index()
     {
        
        $country =Country::all()->slice(1);

        return view('settings.masters.country.index',compact('country'));

     }

      public function create()
     {
        
        return view('settings.masters.country.create');

     }

       public function store(Request $request)
     {
        
        //   dd($request);
        $request->validate([
            'name' => 'required|regex:/^[A-Za-z ]+$/',
            'code' => 'required',
            
        ]);
        
        $country = new Country;
        $country->name = $request->input('name');
        $country->code = $request->input('code');
       
   
        $country->save();

        return redirect()->route('countries')->with('success', 'Country added successfully!');


     }

      public function edit($id)
     {
        $country= Country::find($id);
      
        return view('settings.masters.country.edit', compact('country'));
       
     }

     public function update(Request $request, $id)
    {
          $request->validate([
            'name' => 'required|regex:/^[A-Za-z ]+$/',
            'code' => 'required',
            
        ]);
    
        $country = Country::find($id);
        $country->name = $request->input('name');
        $country->code = $request->input('code');
        $country->save();
    
         return redirect()->route('countries')->with('success', 'Country Updated successfully!');
    }
        public function delete($id)
    {
          $country = Country::find($id);

         $country->delete();

          return redirect()->route('countries')->with('success', 'Country Deleted successfully!');

    }
}
