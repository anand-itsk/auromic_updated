<?php

namespace App\Http\Controllers;
use App\Models\State;
use App\Models\Country;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Maatwebsite\Excel\Facades\Excel;

class StateController extends Controller
{
     public function index()
     {
        
        $state =State::paginate(10);

        return view('settings.masters.state.index',compact('state'));

     }

        public function indexData()
    {
        
        $state = State::get();
        
        return DataTables::of($state)->make(true);
    }

      public function create()
     {
        $country = Country::get();
        return view('settings.masters.state.create',compact('country'));

     }

       public function store(Request $request)
     {
        
        //   dd($request);
        $request->validate([
            'country_id'=>'required',
            'name' => 'required',
            'code' => 'required',
            
        ]);
        
        $state = new State;
        $state->country_id = $request->input('country_id');
        $state->name = $request->input('name');
        $state->code = $request->input('code');
       
   
        $state->save();

        return redirect()->route('common.states')->with('success', 'State added successfully!');


     }

      public function edit($id)
     {
        $state= State::find($id);
        $country = Country::all();
        return view('settings.masters.state.edit', compact('state','country'));
       
     }

     public function update(Request $request, $id)
    {
          $request->validate([
           'country_id'=>'required',
            'name' => 'required',
            'code' => 'required',
            
        ]);
    
        $state = State::find($id);
        $state->country_id = $request->input('country_id');
        $state->name = $request->input('name');
        $state->code = $request->input('code');
        $state->save();
    
         return redirect()->route('common.states')->with('success', 'State Updated successfully!');
    }
       public function deleteSelected(Request $request)
    {

        $ids = $request->ids;

        if (!is_array($ids)) {
            return response()->json(['status' => 'error', 'message' => 'Invalid input'], 400);
        }

        State::destroy($ids);
        return response()->json(['status' => 'success']);
    }
    
        public function delete($id)
    {
          $state = State::find($id);

           $state->delete();

          return redirect()->route('common.states')->with('success', 'State Deleted successfully!');

    }
}
