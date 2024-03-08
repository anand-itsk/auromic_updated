<?php

namespace App\Http\Controllers\PageControllers\JobAllocationcontroller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\DirectJobGiving;
use App\Exports\DirectJobGivingExport;
use App\Models\ProductModel;
use App\Models\ProductSize;
use App\Models\ProductColor;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\DataTables\DataTables;
class DirectJobGivingController extends Controller
{
       public function index()
     {
        return view('pages.job_allocation.direct_job_giving.index');
     }

     
      public function indexData()
    {
        
        $direct_job_giving = DirectJobGiving::with(['employee','productModel','productSize','productColor'])->get();
        return DataTables::of($direct_job_giving)->make(true);
    }

        public function create()
     {

       $employee = Employee::with(['company' => function ($query) {
                $query->with('companyType');
                 }])->get();
        $product_model = ProductModel::all();
        $product_size = ProductSize::get();
        $product_color = ProductColor::get();
        return view('pages.job_allocation.direct_job_giving.create',compact('employee','product_model','product_size','product_color'));
     }


     public function getModelDetails($id)
    {
        $productModel = ProductModel::with('product', 'rawMaterial.rawMaterialType')->find($id);

        if (!$productModel) {
            return response()->json(['error' => 'Model not found'], 404);
        }

        $data = [
            'product_name' => $productModel->product->name,
            'raw_material_name' => $productModel->rawMaterial->name,
            'raw_material_type' => $productModel->rawMaterial->rawMaterialType->name,
        ];

        return response()->json($data);
    }
      public function store(Request $request)
{
   //  dd($request);
    $validatedData = $request->validate([
         'employee_id' => 'required',
         'product_model_id' => 'required',
         
    ]);
   
     $direct_job_giving = new DirectJobGiving;
     $direct_job_giving->employee_id = $request->input('employee_id');
     $direct_job_giving->product_model_id = $request->input('product_model_id');
     $direct_job_giving->product_size_id = $request->input('product_size_id');
     $direct_job_giving->product_color_id = $request->input('product_color_id');
     $direct_job_giving->quantity = $request->input('quantity');
     $direct_job_giving->weight = $request->input('weight');
    

   // dd($direct_job_giving); 

    $direct_job_giving->save();

  
    return redirect()->route('job_allocation.direct_job_giving.index')
        ->with('success', ' Direct Job Giving created successfully');
}

  public function edit($id)
     {

        $direct_job_giving = DirectJobGiving::find($id);
    $employee = Employee::with(['company' => function ($query) {
                $query->with('companyType');
                 }])->get();
               
        $product_model = ProductModel::all();
        $product_size = ProductSize::get();
        $product_color = ProductColor::get();
        return view('pages.job_allocation.direct_job_giving.edit',compact('direct_job_giving','employee','product_model','product_size','product_color'));
     }

     


public function update(Request $request, $id)
    {
      //   dd($request);
      $validatedData = $request->validate([
         'employee_id' => 'required',
         'product_model_id' => 'required',
    ]);
       

    $direct_job_giving =  DirectJobGiving::find($id);
     $direct_job_giving->employee_id = $request->input('employee_id');
     $direct_job_giving->product_model_id = $request->input('product_model_id');
     $direct_job_giving->product_size_id = $request->input('product_size_id');
     $direct_job_giving->product_color_id = $request->input('product_color_id');
     $direct_job_giving->quantity = $request->input('quantity');
     $direct_job_giving->weight = $request->input('weight');

   // dd($direct_job_giving);

    $direct_job_giving->save();

       return redirect()->route('job_allocation.direct_job_giving.index')
        ->with('success', ' Direct Job Giving Updated successfully');
    }

       public function deleteSelected(Request $request)
    {

        $ids = $request->ids;

        if (!is_array($ids)) {
            return response()->json(['status' => 'error', 'message' => 'Invalid input'], 400);
        }

        DirectJobGiving::destroy($ids);
        return response()->json(['status' => 'success']);
    }

      public function destroy($id)
    {
         $direct_job_giving = DirectJobGiving::find($id);

         $direct_job_giving->delete();

          return redirect()->route('job_allocation.direct_job_giving.index')->with('success', 'Direct Job Giving Deleted successfully!');

    }

      public function export(Request $request)
    {
        return Excel::download(new DirectJobGivingExport($request->all()), 'DirectJobGivingDatas_' . date('d-m-Y') . '.xlsx');
    }

     public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:xlsx,csv'
        ]);

        Excel::import(new DirectJobGivingImport, request()->file('file'));

        return redirect()->route('job_allocation.direct_job_giving.index')->with('success', 'Data imported successfully');
    }
}
