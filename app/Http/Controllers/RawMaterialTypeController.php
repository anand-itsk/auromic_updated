<?php

namespace App\Http\Controllers;
use App\Models\RawMaterialType;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Maatwebsite\Excel\Facades\Excel;

class RawMaterialTypeController extends Controller
{
    public function index()
     {
   
        $raw_material_type = RawMaterialType::paginate(10);


        return view('settings.masters.raw_material_types.index',compact('raw_material_type'));

     }

      public function indexData()
    {
        
        $raw_material_type = RawMaterialType::get();
        
        return DataTables::of($raw_material_type)->make(true);
    }

      public function create()
     {
        
        return view('settings.masters.raw_material_types.create');

     }

       public function store(Request $request)
     {
        
        //   dd($request);
        $request->validate([
            'name' => 'required',
            
        ]);
        
        $raw_material_type = new RawMaterialType;
        $raw_material_type->name = $request->input('name');
        $raw_material_type->code = $request->input('code');
       
   
        $raw_material_type->save();

        return redirect()->route('product-models.raw_material_types')->with('success', 'Raw Material Type added successfully!');


     }

      public function edit($id)
     {
        $raw_material_type= RawMaterialType::find($id);
      
        return view('settings.masters.raw_material_types.edit', compact('raw_material_type'));
       
     }

     public function update(Request $request, $id)
    {
          $request->validate([
            'name' => 'required',
            
        ]);
    
        $raw_material_type = RawMaterialType::find($id);
        $raw_material_type->name = $request->input('name');
        $raw_material_type->code = $request->input('code');
        $raw_material_type->save();
    
         return redirect()->route('product-models.raw_material_types')->with('success', 'Raw Material Type Updated successfully!');
    }
        public function delete($id)
    {
          $raw_material_type = RawMaterialType::find($id);

         $raw_material_type->delete();

          return redirect()->route('product-models.raw_material_types')->with('success', 'Raw Material Type Deleted successfully!');

    }

     public function deleteSelected(Request $request)
    {

        $ids = $request->ids;

        if (!is_array($ids)) {
            return response()->json(['status' => 'error', 'message' => 'Invalid input'], 400);
        }

        RawMaterialType::destroy($ids);
        return response()->json(['status' => 'success']);
    }
}
