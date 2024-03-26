<?php

namespace App\Http\Controllers\pageControllers\MasterControllers;
use App\Models\Product;
use App\Exports\IncentiveExport;
use App\Models\Incentive;
use App\Models\FinishingProductModel;
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
        
        $incentive = Incentive::with('finishingProduct')->get();
       
        return DataTables::of($incentive)->make(true);
    }

      public function create()
    {
      
         $finishingProduct= FinishingProductModel::all();

        return view('pages.master.incentive.create',compact('finishingProduct'));
    }

    public function getFinishingProductDetails($id)
{
    $finishingProduct = FinishingProductModel::findOrFail($id);
    
    return response()->json([
        'model_name' => $finishingProduct->model_name,
        'product_name' => $finishingProduct->product->name,
        'product_size' => $finishingProduct->productSize->name,
        'wages_one_product' => $finishingProduct->wages_one_product
    ]);
}

    public function store(Request $request)
{
    // dd($request);
    $validatedData = $request->validate([
         'finishing_product_models_id' => 'required',
         'duration_period' => 'required',
          'amount' => 'required',   
    ]);
   
     $incentive = new Incentive;
     $incentive->finishing_product_models_id  = $request->input('finishing_product_models_id');
     $incentive->duration_period= $request->input('duration_period');
     $incentive->amount= $request->input('amount');

//    dd($incentive); 

    $incentive->save();

  
    return redirect()->route('master.incentives.index')
        ->with('success', ' Incentive created successfully');
}


    public function edit($id)
    {
         $incentive = Incentive::find($id);

         $finishingProduct= FinishingProductModel::all();
          return view('pages.master.incentive.edit', compact('incentive','finishingProduct'));
    }


    public function update(Request $request, $id)
    {
        // dd($request);
      $validatedData = $request->validate([
         'finishing_product_models_id' => 'required',
         'duration_period' => 'required',  
    ]);
       
           $incentive =  Incentive::find($id);
     $incentive->finishing_product_models_id = $request->input('finishing_product_models_id');
     $incentive->duration_period= $request->input('duration_period');
    $incentive->amount= $request->input('amount');
//    dd($incentive); 

    $incentive->save();

      
        return redirect()->route('master.incentives.index')
            ->with('success', 'Incentive Updated successfully');
    }

           public function destroy($id)
    {
         $incentive = Incentive::find($id);

           $incentive->delete();

          return redirect()->route('master.incentives.index')->with('success', 'Incentive Deleted successfully!');

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
        return Excel::download(new IncentiveExport($request->all()), 'IncentiveDatas_' . date('d-m-Y') . '.xlsx');
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:xlsx,csv'
        ]);

        Excel::import(new IncentiveImport, request()->file('file'));

        return redirect()->route('master.incentives.index')->with('success', 'Data imported successfully');
    }
}
