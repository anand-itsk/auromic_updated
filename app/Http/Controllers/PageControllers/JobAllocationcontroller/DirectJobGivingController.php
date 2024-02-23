<?php

namespace App\Http\Controllers\PageControllers\JobAllocationcontroller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\DirectJobGiving;
use App\Models\ProductModel;
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
        
        $direct_job_giving = DirectJobGiving::with(['employee','productModel'])->get();
        return DataTables::of($direct_job_giving)->make(true);
    }

        public function create()
     {

        $employee = Employee::all();
        $product_model = ProductModel::all();
        return view('pages.job_allocation.direct_job_giving.create',compact('employee','product_model'));
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
    

   // dd($direct_job_giving); 

    $direct_job_giving->save();

  
    return redirect()->route('job_allocation.direct_job_giving.index')
        ->with('success', ' Direct Job Giving created successfully');
}

  public function edit($id)
     {
        $direct_job_giving = DirectJobGiving::find($id);
        $employee = Employee::all();
        $product_model = ProductModel::all();
        return view('pages.job_allocation.direct_job_giving.edit',compact('direct_job_giving','employee','product_model'));
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
}
