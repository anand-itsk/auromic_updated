<?php

namespace App\Http\Controllers;
use App\Models\ResigningReason;
use Illuminate\Http\Request;

class ResigningReasonsController extends Controller
{
     public function index()
     {
        
        $resigning_reason =ResigningReason::paginate(10);

        return view('settings.masters.resigning_reason.index',compact('resigning_reason'));

     }

      public function create()
     {
        
        return view('settings.masters.resigning_reason.create');

     }

       public function store(Request $request)
     {
        
        //   dd($request);
        $request->validate([
            'name' => 'required',
            'code' => 'required',
            
        ]);
        
        $resigning_reason = new ResigningReason;
        $resigning_reason->name = $request->input('name');
        $resigning_reason->code = $request->input('code');
       
   
        $resigning_reason->save();

        return redirect()->route('specified.resigning_reasons')->with('success', 'Resigning Reason added successfully!');


     }

      public function edit($id)
     {
        $resigning_reason= ResigningReason::find($id);
      
        return view('settings.masters.resigning_reason.edit', compact('resigning_reason'));
       
     }

     public function update(Request $request, $id)
    {
          $request->validate([
            'name' => 'required',
            'code' => 'required',
            
        ]);
    
        $resigning_reason = ResigningReason::find($id);
        $resigning_reason->name = $request->input('name');
        $resigning_reason->code = $request->input('code');
        $resigning_reason->save();
    
         return redirect()->route('specified.resigning_reasons')->with('success', 'Resigning Reason Updated successfully!');
    }
        public function delete($id)
    {
          $resigning_reason = ResigningReason::find($id);

         $resigning_reason->delete();

          return redirect()->route('specified.resigning_reasons')->with('success', 'Resigning Reason Deleted successfully!');

    }
}
