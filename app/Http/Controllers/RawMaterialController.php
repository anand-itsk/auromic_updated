<?php

namespace App\Http\Controllers;

use App\Models\RawMaterialType;
use App\Models\RawMaterial;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Maatwebsite\Excel\Facades\Excel;

class RawMaterialController extends Controller
{
   public function index()
   {

      $raw_material = RawMaterial::paginate(10);

      return view('settings.masters.raw_material.index', compact('raw_material'));
   }

    public function indexData()
    {
        
        $raw_material = RawMaterial::with('rawMaterialType')->get();
        
        return DataTables::of($raw_material)->make(true);
    }

   public function create()
   {
      $raw_material_type = RawMaterialType::get();
      return view('settings.masters.raw_material.create', compact('raw_material_type'));
   }

   public function store(Request $request)
   {

      //   dd($request);
      $request->validate([
         'name' => 'required',
         'stock' => 'required',
      ]);

      $raw_material_type_id = $request->input('raw_material_type_id');
      if ($raw_material_type_id == null) {
         $raw_material_type_id = 1;
      }

      $raw_material = new RawMaterial;
      $raw_material->raw_material_type_id = $raw_material_type_id;
      $raw_material->name = $request->input('name');
      $raw_material->stock = $request->input('stock');


      $raw_material->save();

      return redirect()->route('product-models.raw_materials')->with('success', 'Raw Material added successfully!');
   }

   public function edit($id)
   {
      $raw_material = RawMaterial::find($id);
      $raw_material_type = RawMaterialType::all();
      return view('settings.masters.raw_material.edit', compact('raw_material', 'raw_material_type'));
   }

   public function update(Request $request, $id)
   {
      $request->validate([
         'name' => 'required',
         'stock' => 'required',

      ]);

      $raw_material_type_id = $request->input('raw_material_type_id');
      if ($raw_material_type_id == null) {
         $raw_material_type_id = 1;
      }

      $raw_material = RawMaterial::find($id);
      $raw_material->raw_material_type_id = $raw_material_type_id;
      $raw_material->name = $request->input('name');
      $raw_material->stock = $request->input('stock');
      $raw_material->save();

      return redirect()->route('product-models.raw_materials')->with('success', 'Raw Material Updated successfully!');
   }
   public function delete($id)
   {
      $raw_material = RawMaterial::find($id);

      $raw_material->delete();

      return redirect()->route('product-models.raw_materials')->with('success', 'Raw Material Deleted successfully!');
   }
   
    public function deleteSelected(Request $request)
    {

        $ids = $request->ids;

        if (!is_array($ids)) {
            return response()->json(['status' => 'error', 'message' => 'Invalid input'], 400);
        }

        RawMaterial::destroy($ids);
        return response()->json(['status' => 'success']);
    }
}
