<?php

namespace App\Http\Controllers;
use App\Models\Nationality;
use Illuminate\Http\Request;

class NationalityController extends Controller
{
     public function index()
     {
        
        $nationality = Nationality::paginate(10);

        return view('settings.masters.nationality.index',compact('nationality'));

     }

      public function create()
     {
        
        return view('settings.masters.nationality.create');

     }

       public function store(Request $request)
     {
        
        //   dd($request);
        $request->validate([
            'name' => 'required',
            'code' => 'required',
            
        ]);
        
        $nationality = new Nationality;
        $nationality->name = $request->input('name');
        $nationality->code = $request->input('code');
       
   
        $nationality->save();

        return redirect()->route('common.nationalities')->with('success', 'Nationality added successfully!');


     }

      public function edit($id)
     {
        $nationality= Nationality::find($id);
      
        return view('settings.masters.nationality.edit', compact('nationality'));
       
     }

     public function update(Request $request, $id)
    {
          $request->validate([
            'name' => 'required',
            'code' => 'required',
            
        ]);
    
        $nationality = Nationality::find($id);
        $nationality->name = $request->input('name');
        $nationality->code = $request->input('code');
        $nationality->save();
    
         return redirect()->route('common.nationalities')->with('success', 'Nationality Updated successfully!');
    }
        public function delete($id)
    {
         $nationality = Nationality::find($id);

         $nationality->delete();

          return redirect()->route('common.nationalities')->with('success', 'Nationality Deleted successfully!');

    }
}
