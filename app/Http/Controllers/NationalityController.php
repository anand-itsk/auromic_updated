<?php

namespace App\Http\Controllers;
use App\Models\Nationality;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Maatwebsite\Excel\Facades\Excel;

class NationalityController extends Controller
{
     public function index()
     {
        
        $nationality = Nationality::paginate(10);

        return view('settings.masters.nationality.index',compact('nationality'));

     }

      public function indexData()
    {
        
        $nationality = Nationality::get();
        
        return DataTables::of($nationality)->make(true);
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

    
     public function deleteSelected(Request $request)
    {

        $ids = $request->ids;

        if (!is_array($ids)) {
            return response()->json(['status' => 'error', 'message' => 'Invalid input'], 400);
        }

        Nationality::destroy($ids);
        return response()->json(['status' => 'success']);
    }
}
