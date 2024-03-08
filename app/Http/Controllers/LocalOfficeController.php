<?php

namespace App\Http\Controllers;
use App\Models\LocalOffice;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Maatwebsite\Excel\Facades\Excel;

class LocalOfficeController extends Controller
{
    public function index()
     {
        
        $local_office =LocalOffice::paginate(10);

        return view('settings.masters.local_office.index',compact('local_office'));

     }

     
        public function indexData()
    {
        
        $local_office = LocalOffice::get();
        
        return DataTables::of($local_office)->make(true);
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
       public function deleteSelected(Request $request)
    {

        $ids = $request->ids;

        if (!is_array($ids)) {
            return response()->json(['status' => 'error', 'message' => 'Invalid input'], 400);
        }

        LocalOffice::destroy($ids);
        return response()->json(['status' => 'success']);
    }
}
