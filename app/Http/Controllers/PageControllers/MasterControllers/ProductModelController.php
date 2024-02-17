<?php

namespace App\Http\Controllers\PageControllers\MasterControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Imports\ModelDataImport;
use App\Models\RawMaterial;
use App\Models\Product;
use App\Models\ProductSize;
use App\Models\ProductModel;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\DataTables\DataTables;
class ProductModelController extends Controller
{
     public function index()
     {
        return view('pages.master.product_model.index');
     }

      public function indexData()
    {
        // Eager load the roles relationship
        $product_model = ProductModel::with(['rawMaterial.rawMaterialType', 'product', 'productSize'])->get();
        // dd($product_model[0]->rawMaterial->rawMaterialType);
        return DataTables::of($product_model)->make(true);
    }

      public function create()
    {
        $raw_material = RawMaterial::all();
         $product = Product::all();
         $product_size = ProductSize::all();
        return view('pages.master.product_model.create',compact('raw_material','product','product_size'));
    }

    public function store(Request $request)
    {
        // dd($request);
        $validatedData = $request->validate([
             'product_id' => 'required',
             'model_code' => 'required',
             'model_name' => 'required',  
        ]);
       
         $product_model = new ProductModel;
         $product_model->raw_material_id = $request->input('raw_material_id');
         $product_model->product_id = $request->input('product_id');
         $product_model->product_size_id  = $request->input('product_size_id');
         $product_model->model_code = $request->input('model_code');
         $product_model->model_name = $request->input('model_name');
         $product_model->raw_material_weight_item = $request->input('raw_material_weight_item');
        $product_model->wages_product = $request->input('wages_product');
    //    dd($product_model);
        $product_model->save();

      
        return redirect()->route('master.product_model.index')
            ->with('success', 'Product Model created successfully');
    }

    public function edit($id)
    {
         $product_model = ProductModel::find($id);
         $raw_material = RawMaterial::all();
         $product = Product::all();
         $product_size = ProductSize::all();

          return view('pages.master.product_model.edit', compact('product_model','raw_material','product','product_size'));
    }


    public function update(Request $request, $id)
    {
        // dd($request);
        $validatedData = $request->validate([
             'product_id' => 'required',
             'model_code' => 'required',
             'model_name' => 'required',  
        ]);
       
         $product_model = ProductModel::find($id);
         $product_model->raw_material_id = $request->input('raw_material_id');
         $product_model->product_id = $request->input('product_id');
         $product_model->product_size_id  = $request->input('product_size_id');
         $product_model->model_code = $request->input('model_code');
         $product_model->model_name = $request->input('model_name');
         $product_model->raw_material_weight_item = $request->input('raw_material_weight_item');
        $product_model->wages_product = $request->input('wages_product');
    //    dd($product_model);
        $product_model->save();

      
        return redirect()->route('master.product_model.index')
            ->with('success', 'Product Model Updated successfully');
    }

           public function delete($id)
    {
         $product_model = ProductModel::find($id);

           $product_model->delete();

          return redirect()->route('religions')->with('success', 'Product Model Deleted successfully!');

    }

    public function deleteSelected(Request $request)
    {

        $ids = $request->ids;

        if (!is_array($ids)) {
            return response()->json(['status' => 'error', 'message' => 'Invalid input'], 400);
        }

        ProductModel::destroy($ids);
        return response()->json(['status' => 'success']);
    }

    public function export(Request $request)
    {
        return Excel::download(new ModelExport($request->all()), 'CustomerDatas_' . date('d-m-Y') . '.xlsx');
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:xlsx,csv'
        ]);

        Excel::import(new ModelDataImport, request()->file('file'));

        return redirect()->route('master.product_model.index')->with('success', 'Data imported successfully');
    }

}
