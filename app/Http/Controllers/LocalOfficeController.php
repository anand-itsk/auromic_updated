<?php

namespace App\Http\Controllers;
use App\Models\LocalOffice;
use Illuminate\Http\Request;

class LocalOfficeController extends Controller
{
    public function index()
     {
        
        $local_office =LocalOffice::paginate(10);

        return view('settings.masters.local_office.index',compact('local_office'));

     }

      public function create()
     {
        
        return view('settings.masters.local_office.create');

     }

       public function store(Request $request)
     {
        
        //   dd($request);
        $request->validate([
            'name' => 'required',
            'code' => 'required',
            
        ]);
        
        $local_office = new LocalOffice;
        $local_office->name = $request->input('name');
        $local_office->code = $request->input('code');
       
   
        $local_office->save();

        return redirect()->route('specified.local_offices')->with('success', 'Local Office added successfully!');


     }

      public function edit($id)
     {
        $local_office= LocalOffice::find($id);
      
        return view('settings.masters.local_office.edit', compact('local_office'));
       
     }

     public function update(Request $request, $id)
    {
          $request->validate([
            'name' => 'required',
            'code' => 'required',
            
        ]);
    
        $local_office = LocalOffice::find($id);
        $local_office->name = $request->input('name');
        $local_office->code = $request->input('code');
        $local_office->save();
    
         return redirect()->route('specified.local_offices')->with('success', 'Local Office Updated successfully!');
    }
        public function delete($id)
    {
          $local_office = LocalOffice::find($id);

         $local_office->delete();

          return redirect()->route('specified.local_offices')->with('success', 'Local Office Deleted successfully!');

    }
}
