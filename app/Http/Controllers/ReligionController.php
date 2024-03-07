<?php

namespace App\Http\Controllers;
use App\Models\Religion;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Maatwebsite\Excel\Facades\Excel;


class ReligionController extends Controller
{
     public function index()
     {
        
        $religion = Religion::paginate(10);

        return view('settings.masters.religion.index',compact('religion'));

     }
      public function indexData()
    {
        
        $religion = Religion::get();
        
        return DataTables::of($religion)->make(true);
    }


      public function create()
     {
        
        return view('settings.masters.religion.create');

     }

       public function store(Request $request)
     {
        
        //   dd($request);
        $request->validate([
            'name' => 'required',
            'code' => 'required',
            
        ]);
        
        $religion = new Religion;
        $religion->name = $request->input('name');
        $religion->code = $request->input('code');
       
   
        $religion->save();

        return redirect()->route('common.religions')->with('success', 'Religion added successfully!');


     }

      public function edit($id)
     {
        $religion= Religion::find($id);
      
        return view('settings.masters.religion.edit', compact('religion'));
       
     }

     public function update(Request $request, $id)
    {
          $request->validate([
            'name' => 'required',
            'code' => 'required',
            
        ]);
    
        $religion = Religion::find($id);
        $religion->name = $request->input('name');
        $religion->code = $request->input('code');
        $religion->save();
    
         return redirect()->route('common.religions')->with('success', 'Religion Updated successfully!');
    }
        public function delete($id)
    {
        $religion = Religion::find($id);

         $religion->delete();

          return redirect()->route('common.religions')->with('success', 'Religion Deleted successfully!');

    }
     public function deleteSelected(Request $request)
    {

        $ids = $request->ids;

        if (!is_array($ids)) {
            return response()->json(['status' => 'error', 'message' => 'Invalid input'], 400);
        }

        Religion::destroy($ids);
        return response()->json(['status' => 'success']);
    }
}
