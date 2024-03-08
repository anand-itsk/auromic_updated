<?php

namespace App\Http\Controllers\PageControllers\JobAllocationcontroller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DirectJobGiving;
use App\Models\Employee;
use App\Models\ProductColor;
use App\Models\ProductSize;
use App\Models\DirectJobReceived;
use App\Models\ProductModel ;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\DataTables\DataTables;

class DirectJobReceivedController extends Controller
{
    public function index()
     {
        return view('pages.job_allocation.direct_job_received.index');
     }

     
      public function indexData()
    {
        
        $direct_job_giving = DirectJobGiving::with(['employee','productModel','productSize','productColor'])->get();
        return DataTables::of($direct_job_giving)->make(true);
    }

    public function store(Request $request)
{
    // Validate the request data
    $validatedData = $request->validate([
        'receiving_date' => 'required',
        // Add validation rules for other fields if needed
    ]);

    // Create a new instance of DirectJobReceived model
    $direct_job_received = new DirectJobReceived;

    // Set the properties of the DirectJobReceived model
    $direct_job_received->direct_job_giving_id = $request->input('direct_job_giving_id');
    $direct_job_received->product_model_id = $request->input('product_model_id');
    $direct_job_received->employee_id = $request->input('employee_id');
    $direct_job_received->product_color_id = $request->input('product_color_id');
    $direct_job_received->incentive_applicable = $request->input('incentive_applicable');
    $direct_job_received->receving_date = $request->input('receiving_date');

    // Save the DirectJobReceived model to the database
    // dd($direct_job_received);
    $direct_job_received->save();

    // Redirect to the appropriate route with a success message
    return redirect()->route('job_allocation.direct_job_received.index')
        ->with('success', 'Direct Job Received created successfully');
}



//       public function store(Request $request)
// {
//     // dd($request);
//     $validatedData = $request->validate([
         
//          'receving_date'=> 'required',
         
//     ]);
  
//    $direct_job_received = new DirectJobReceived;
// $direct_job_received->incentive_applicable = $request->input('incentive_applicable');
// $direct_job_received->product_model_id = $request->input('product_model_id');
// $direct_job_received->receving_date = $request->input('receiving_date');
// $direct_job_received->product_color_id = $request->input('product_color_id');
// $direct_job_received->employee_id = $request->input('employee_id');

// dd($direct_job_received);
// // Check if either product_model_id or incentive_applicable is not null
// if ($request->input('product_model_id') !== null || $request->input('incentive_applicable') !== null) {
//     // Don't store direct_job_giving_id
// } else {
//     // Store direct_job_giving_id
//     $direct_job_received->direct_job_giving_id = $request->input('direct_job_giving_id');
// }
// // dd($direct_job_received);

// $direct_job_received->save();

  
//     return redirect()->route('job_allocation.direct_job_received.index')
//         ->with('success', ' Direct Job Received created successfully');
// }




//      public function edit(Request $request, $id)
// {
//     $direct_job_giving = DirectJobGiving::find($id);
//     $product_model = Productmodel::all();
    
//     // Combine data into an array
//     $data = [
//         'direct_job_giving' => $direct_job_giving,
//         'product_model' => $product_model,
//     ];

//     // Return combined data as JSON response
//     return response()->json($data);
// }

public function edit($id)
{
    $direct_job_giving = DirectJobGiving::find($id);
    $product_model = Productmodel::all();
      $product_color = Productcolor::all();
     $employee = Employee::with(['company' => function ($query) {
        $query->with('companyType');
    }])->get();
    
        $product_size = ProductSize::get();
        

    return view('pages.job_allocation.direct_job_received.edit',compact('direct_job_giving','product_model','employee','id','product_color','product_size'));
}

public function getModelDetails($id)
    {
        $productModel = ProductModel::with('product', 'rawMaterial.rawMaterialType','productSize')->find($id);

        if (!$productModel) {
            return response()->json(['error' => 'Model not found'], 404);
        }

        $data = [
            'product_name' => $productModel->product->name,
            'product_size' => $productModel->productSize->name,
            'wages_of_product' => $productModel->wages_product,
        ];

        return response()->json($data);
    }


}
