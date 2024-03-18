<?php

namespace App\Http\Controllers\PageControllers\JobAllocation;

use App\Http\Controllers\Controller;
use App\Models\DeliveryChallan;
use App\Models\Employee;
use App\Models\Company;
use App\Models\ProductModel;
use App\Models\JobGiving;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Exports\JobgivingExport;
use Maatwebsite\Excel\Facades\Excel;

class JobGivingController extends Controller
{

    // Index Page
    public function index()
    {
        return view('pages.job_allocation.job_giving.index');
    }
    // Index DataTable
    public function indexData()
    {
        $Job_Giving = JobGiving::with('employee', 'order_details', 'delivery_chellan','product_model')->get();
        return DataTables::of($Job_Giving)->make(true);
    }
    // Create Page
   public function create()
{
    $delivery_challan = DeliveryChallan::all();
    $order_details = OrderDetail::all();
      $productModels = ProductModel::with(['rawMaterial.rawMaterialType','product'])->get();
    $employee = Employee::with(['company' => function ($query) {
        $query->with('companyType');
    }])->get();

    return view('pages.job_allocation.job_giving.create', compact('delivery_challan', 'order_details', 'employee','productModels'));
}

public function getOrderDetails($orderId)
{
    $orderDetail = OrderDetail::with('customer')->find($orderId);
    if ($orderDetail) {
        $data = [
            'order_date' => $orderDetail->order_date,
            'customer_name' => $orderDetail->customer->customer_name, // Assuming the customer name is stored in the 'name' field
        ];
        return response()->json($data);
    } else {
        return response()->json(null);
    }
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

 
    // Store Date
     public function store(Request $request)
{
    $validatedData = $request->validate([
        'employee_id' => 'required',
        'order_id' => 'required',
        'product_model_id' => 'required',
        'quantity' => 'required',
        'date' => 'required',
        'dc_number' => 'required',
        'status' => 'required'
    ]);

    $input = $request->all();

    // Retrieve the order detail
    $delivery_challan = DeliveryChallan::findOrFail($input['order_id']);

    // Calculate total delivered quantity for the order
    $total_job_giving_quantity = JobGiving::where('order_id', $input['order_id'])->sum('quantity');

    // Calculate available quantity
    $available_quantity = $delivery_challan->quantity - $total_job_giving_quantity;

    // If available quantity is zero or less, show message and return
    if ($available_quantity <= 0) {
        return redirect()->route('job_allocation.job_giving.index')
            ->with('error', 'No available quantity for this order');
    }



    // Create new job giving record
    $job_giving = new JobGiving();
    $job_giving->employee_id = $input['employee_id'];
    $job_giving->order_id = $input['order_id'];
    $job_giving->product_model_id = $input['product_model_id'];
    $job_giving->quantity = $input['quantity'];
    $job_giving->date = $input['date'];
    $job_giving->dc_id = $input['dc_number'];
    $job_giving->status = $input['status'];
    $job_giving->save();

    // Update available quantity in delivery challan
    $delivery_challan->available_quantity = $available_quantity - $input['quantity'];
    $delivery_challan->save();

    return redirect()->route('job_allocation.job_giving.index')
        ->with('success', 'Job Giving Created Successfully');
}
    // Edit
    public function edit(Request $request, $id)
    {
       $delivery_challan = DeliveryChallan::all();
        $order_details = OrderDetail::all();
        $productModels = ProductModel::with(['rawMaterial.rawMaterialType','product'])->get();
         $employee = Employee::with(['company' => function ($query) {
        $query->with('companyType');
    }])->get();
        $JobGiving = JobGiving::find($id);
        // dd($JobGiving);
        return view('pages.job_allocation.job_giving.edit', compact('delivery_challan', 'order_details', 'employee', 'JobGiving','productModels','id'));
    }

     
    // Update
    public function update(Request $request, $id)
    {
        // dd($request);
    
        $input = $request->all();

        $job_giving = JobGiving::find($id);
        $job_giving->employee_id = $input['employee_id'];
        $job_giving->order_id = $input['order_id'];
        $job_giving->product_model_id = $input['product_model_id'];
        $job_giving->quantity = $input['quantity'];
        $job_giving->date = $input['date'];

        if (isset($input['dc_number'])) {
            $job_giving->dc_id = $input['dc_number'];
        } else {
            $job_giving->dc_id = null; // Set dc_id to null if dc_number is not provided
        }

        $job_giving->status = $input['status'];
// dd($job_giving);
        $job_giving->save();


        return redirect()->route('job_allocation.job_giving.index')
            ->with('success', 'Job Giving Updated successfully');
    }

    // Multi Delete
    public function deleteSelected(Request $request)
    {

        $ids = $request->ids;

        if (!is_array($ids)) {
            return response()->json(['status' => 'error', 'message' => 'Invalid input'], 400);
        }

        JobGiving::destroy($ids);
        return response()->json(['status' => 'success']);
    }

     public function delete($id)
    {
         $job_giving = JobGiving::find($id);

         $job_giving->delete();

          return redirect()->route('job_allocation.job_giving.index')->with('success', 'Job Giving Deleted successfully!');

    }

     public function export(Request $request)
    {
        return Excel::download(new JobgivingExport($request->all()), 'JobgivingDatas_' . date('d-m-Y') . '.xlsx');
    }

     public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:xlsx,csv'
        ]);

        Excel::import(new JobGivingImport, request()->file('file'));

        return redirect()->route('job_allocation.job_giving.index')->with('success', 'Data imported successfully');
    }
}
