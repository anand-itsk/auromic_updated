<?php

namespace App\Http\Controllers;
use App\Models\EsiDispensary;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Maatwebsite\Excel\Facades\Excel;

class EsiDispensaryController extends Controller
{
   public function index()
     {
        
        $esi_dispensary =EsiDispensary::paginate(10);

        return view('settings.masters.esi_dispensary.index',compact('esi_dispensary'));

     }
        public function indexData()
    {
        
        $esi_dispensary = EsiDispensary::get();
        
        return DataTables::of($esi_dispensary)->make(true);
    }

      public function create()
     {
        
        return view('settings.masters.esi_dispensary.create');

     }

       public function store(Request $request)
     {
        
        //   dd($request);
        $request->validate([
            'name' => 'required',
            'code' => 'required',
            
        ]);
        
        $esi_dispensary = new EsiDispensary;
        $esi_dispensary->name = $request->input('name');
        $esi_dispensary->code = $request->input('code');
       
   
        $esi_dispensary->save();

        return redirect()->route('specified.esi_dispensaries')->with('success', 'ESI Dispensary added successfully!');


     }

      public function edit($id)
     {
        $esi_dispensary= EsiDispensary::find($id);
      
        return view('settings.masters.esi_dispensary.edit', compact('esi_dispensary'));
       
     }

     public function update(Request $request, $id)
    {
          $request->validate([
            'name' => 'required',
            'code' => 'required',
            
        ]);
    
        $esi_dispensary = EsiDispensary::find($id);
        $esi_dispensary->name = $request->input('name');
        $esi_dispensary->code = $request->input('code');
        $esi_dispensary->save();
    
         return redirect()->route('specified.esi_dispensaries')->with('success', 'ESI Dispensary Updated successfully!');
    }
        public function delete($id)
    {
          $esi_dispensary = EsiDispensary::find($id);

         $esi_dispensary->delete();

          return redirect()->route('specified.esi_dispensaries')->with('success', 'ESI Dispensary Deleted successfully!');

    }

    public function deleteSelected(Request $request)
    {

        $ids = $request->ids;

        if (!is_array($ids)) {
            return response()->json(['status' => 'error', 'message' => 'Invalid input'], 400);
        }

        EsiDispensary::destroy($ids);
        return response()->json(['status' => 'success']);
    }
}
