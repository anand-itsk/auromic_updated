<?php

namespace App\Http\Controllers;
use App\Models\Caste;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Maatwebsite\Excel\Facades\Excel;

class CasteController extends Controller
{
      public function index()
     {
        
        $caste = Caste::paginate(10);

        return view('settings.masters.caste.index',compact('caste'));

     }

      public function indexData()
    {
        
        $caste = Caste::get();
        
        return DataTables::of($caste)->make(true);
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

     public function deleteSelected(Request $request)
    {

        $ids = $request->ids;

        if (!is_array($ids)) {
            return response()->json(['status' => 'error', 'message' => 'Invalid input'], 400);
        }

        Caste::destroy($ids);
        return response()->json(['status' => 'success']);
    }
}
