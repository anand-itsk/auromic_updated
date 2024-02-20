<?php

namespace App\Http\Controllers\pageControllers\MasterControllers;
use App\Models\Product;
use App\Models\Incentive;
use App\Models\ProductModel;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\DataTables\DataTables;

class IncentiveController extends Controller
{
      public function index()
     {
        return view('pages.master.incentive.index');
     }

      public function indexData()
    {
        // Eager load the roles relationship
        $incentive = Incentive::with(['product'])->get();
        // dd($product_model[0]->rawMaterial->rawMaterialType);
        return DataTables::of($incentive)->make(true);
    }

      public function create()
    {
      
         $products = Product::all();
         
         $productModels = ProductModel::get();
        return view('pages.master.incentive.create',compact('products','productModels'));
    }

    public function store(Request $request)
{
    // dd($request);
    $validatedData = $request->validate([
         'product_id' => 'required',
         'model_size' => 'required',
         'duration_period' => 'required',  
    ]);
   
     $incentive = new Incentive;
     $incentive->product_id = $request->input('product_id');
     $incentive->model_size = $request->input('model_size');
     $incentive->duration_period= $request->input('duration_period');

//    dd($incentive); // Uncomment for debugging

    $incentive->save();

  
    return redirect()->route('master.incentives.index')
        ->with('success', ' Incentive created successfully');
}


    public function edit($id)
    {
         $incentive = Incentive::find($id);
      
         $products = Product::all();
        $productModels = ProductModel::get();

          return view('pages.master.incentive.edit', compact('productModels','products','incentive'));
    }


    public function update(Request $request, $id)
    {
        // dd($request);
      $validatedData = $request->validate([
         'product_id' => 'required',
         'model_size' => 'required',
         'duration_period' => 'required',  
    ]);
       
           $incentive =  Incentive::find($id);
     $incentive->product_id = $request->input('product_id');
     $incentive->model_size = $request->input('model_size');
     $incentive->duration_period= $request->input('duration_period');

//    dd($incentive); // Uncomment for debugging

    $incentive->save();

      
        return redirect()->route('master.incentives.index')
            ->with('success', 'Incentive Updated successfully');
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

        Incentive::destroy($ids);
        return response()->json(['status' => 'success']);
    }

    public function export(Request $request)
    {
        return Excel::download(new IncentiveExport($request->all()), 'CustomerDatas_' . date('d-m-Y') . '.xlsx');
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
