<?php

namespace App\Http\Controllers;
use App\Models\Country;
use Illuminate\Http\Request;

class CountryController extends Controller
{
  

     public function index()
     {
   
        $countries = Country::paginate(10);


        return view('settings.masters.country.index',compact('countries'));

     }

     public function indexData()
    {
        
        $countries = Country::get();
        
        return DataTables::of($countries)->make(true);
    }

      public function create()
     {
        
        return view('settings.masters.country.create');

     }

       public function store(Request $request)
     {
        
        //   dd($request);
        $request->validate([
            'name' => 'required',
            'code' => 'required',
            
        ]);
        
        $country = new Country;
        $country->name = $request->input('name');
        $country->code = $request->input('code');
       
   
        $country->save();

        return redirect()->route('common.countries')->with('success', 'Country added successfully!');


     }

      public function edit($id)
     {
        $country= Country::find($id);
      
        return view('settings.masters.country.edit', compact('country'));
       
     }

     public function update(Request $request, $id)
    {
          $request->validate([
            'name' => 'required',
            'code' => 'required',
            
        ]);
    
        $country = Country::find($id);
        $country->name = $request->input('name');
        $country->code = $request->input('code');
        $country->save();
    
         return redirect()->route('common.countries')->with('success', 'Country Updated successfully!');
    }
        public function delete($id)
    {
          $country = Country::find($id);

         $country->delete();

          return redirect()->route('common.countries')->with('success', 'Country Deleted successfully!');

    }
}
