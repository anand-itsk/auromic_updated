<?php

namespace App\Http\Controllers;
use App\Models\Caste;
use Illuminate\Http\Request;

class CasteController extends Controller
{
      public function index()
     {
        
        $caste = Caste::paginate(10);

        return view('settings.masters.caste.index',compact('caste'));

     }

      public function create()
     {
        
        return view('settings.masters.caste.create');

     }

       public function store(Request $request)
     {
        
        //   dd($request);
        $request->validate([
            'name' => 'required',
            'code' => 'required',
            
        ]);
        
        $caste = new Caste;
        $caste->name = $request->input('name');
        $caste->code = $request->input('code');
       
   
        $caste->save();

        return redirect()->route('common.castes')->with('success', 'Caste added successfully!');


     }

      public function edit($id)
     {
        $caste= Caste::find($id);
      
        return view('settings.masters.caste.edit', compact('caste'));
       
     }

     public function update(Request $request, $id)
    {
          $request->validate([
            'name' => 'required',
            'code' => 'required',
            
        ]);
    
        $caste = Caste::find($id);
        $caste->name = $request->input('name');
        $caste->code = $request->input('code');
        $caste->save();
    
         return redirect()->route('common.castes')->with('success', 'Caste Updated successfully!');
    }
        public function delete($id)
    {
           $caste = Caste::find($id);

         $caste->delete();

          return redirect()->route('common.castes')->with('success', 'Caste Deleted successfully!');

    }
}
