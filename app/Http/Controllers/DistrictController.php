<?php

namespace App\Http\Controllers;
use App\Models\State;
use App\Models\District;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Maatwebsite\Excel\Facades\Excel;

class DistrictController extends Controller
{
    public function index()
     {
        
        $district = District::paginate(10);

        return view('settings.masters.district.index',compact('district'));

     }

      public function indexData()
    {
        
        $district = District::get();
        
        return DataTables::of($district)->make(true);
    }

      public function create()
     {
        $state = State::get();
        return view('settings.masters.district.create',compact('state'));

     }

       public function store(Request $request)
     {
        
        //   dd($request);
        $request->validate([
            'state_id'=>'required',
            'name' => 'required',
            'code' => 'required',
            
        ]);
        
        $district = new District;
        $district->state_id = $request->input('state_id');
        $district->name = $request->input('name');
        $district->code = $request->input('code');
       
   
        $district->save();

        return redirect()->route('common.districts')->with('success', 'District added successfully!');


     }

      public function edit($id)
     {
        $district=District::find($id);
        $state = State::all();
        return view('settings.masters.district.edit', compact('district','state'));
       
     }

     public function update(Request $request, $id)
    {
          $request->validate([
           'state_id'=>'required',
            'name' => 'required',
            'code' => 'required',
            
        ]);
    
        $district = District::find($id);
        $district->state_id = $request->input('state_id');
        $district->name = $request->input('name');
        $district->code = $request->input('code');
        $district->save();
    
         return redirect()->route('common.districts')->with('success', 'District Updated successfully!');
    }
        public function delete($id)
    {
             $district = District::find($id);

         $district->delete();

          return redirect()->route('common.districts')->with('success', 'District Deleted successfully!');

    }

     public function deleteSelected(Request $request)
    {

        $ids = $request->ids;

        if (!is_array($ids)) {
            return response()->json(['status' => 'error', 'message' => 'Invalid input'], 400);
        }

        District::destroy($ids);
        return response()->json(['status' => 'success']);
    }
    
}
