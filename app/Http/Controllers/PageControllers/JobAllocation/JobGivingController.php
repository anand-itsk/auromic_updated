<?php

namespace App\Http\Controllers\PageControllers\JobAllocation;

use App\Http\Controllers\Controller;
use App\Models\DeliveryChallan;
use App\Models\Employee;
use App\Models\Company;
use App\Models\ProductModel;
use App\Models\JobGiving;
use App\Models\OrderDetail;
use App\Models\OrderNo;
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
        $Job_Giving = JobGiving::with('employee', 'order_details.orderNo', 'deliveryChellan', 'product_model')->get();
        $data = $Job_Giving->map(function ($job_giving) {
            return [
                'id' => $job_giving->id,
                'employee_name' => $job_giving->employee->employee_name ?? null,
                'last_order_number' => $job_giving->order_details->orderNo->last_order_number ?? null,
                'dc_no' => $job_giving->deliveryChellan->dc_no ?? null,
                'model_name' => $job_giving->product_model->model_name ?? null,
                'quantity' => $job_giving->quantity ?? null,
                'status' => $job_giving->status ?? null,
            ];
        });


        return DataTables::of($data)->make(true);
    }
    // Create Page
    public function create(Request $request)
    {
        $delivery_challan = DeliveryChallan::with('orderDetails.orderNo', 'orderDetails.productModel')->get();
        $order_details = OrderDetail::all();
        $order_nos = OrderNo::all();
        $productModels = ProductModel::with(['rawMaterial.rawMaterialType', 'product'])->get();
        $employee = Employee::with(['company' => function ($query) {
            $query->with('companyType');
        }])->get();
        $orderId = $request->input('company_name');



        return view('pages.job_allocation.job_giving.create', compact('delivery_challan', 'order_details', 'employee', 'productModels', 'order_nos'));
    }

    // public function fetchOrderIds(Request $request)
    // {
    //     $companyId = $request->input('company_id');

    //     // Fetch order IDs associated with the given company ID
    //     // $orderIds = DeliveryChallan::whereHas('company', function ($query) use ($companyId) {
    //     //     $query->where('company_id', $companyId);
    //     // })->pluck('order_id')->unique();
    //     $orderIds = DeliveryChallan::where('company_id', $companyId)->with('orderDetails')->get()->pluck('orderDetails.order_no_id')->unique()->toArray();;
    //     // dd($orderIds);
    //     // You may want to load the actual order details here instead of just IDs
    //     // For now, I'll return the IDs only
    //     $order_data = OrderNO::all();
    //     return response()->json(['order_ids' => $orderIds, 'order_data' => $order_data]);
    // }
    public function fetchOrderIds(Request $request)
    {
        $companyId = $request->input('company_name');
        $deliveryChallans = DeliveryChallan::where('company_id', $companyId)->get();
        $dcNumbers = [];
        foreach ($deliveryChallans as $deliveryChallan) {
            $dcNumbers[$deliveryChallan->id] = $deliveryChallan->dc_no;
        }
        return response()->json(['dc_numbers' => $dcNumbers]);
    }

    public function getQuantities($id)
    {
    }


    public function getModelsByOrderId(Request $request)
    {
        $orderId = $request->order_id;

        // Retrieve models based on the selected order_id
        $models = OrderDetail::where('order_no_id', $orderId)->distinct('product_model_id')->pluck('product_model_id');

        // Assuming your models have a relationship to a ProductModel model
        $productModels = ProductModel::whereIn('id', $models)->get();

        return response()->json($productModels);
    }


    public function getProductDetails(Request $request)
    {
        $productModelId = $request->input('product_model');
        $productDetails = ProductModel::with(['product', 'rawMaterial.rawMaterialType'])->find($productModelId);



        return response()->json([
            'product' => $productDetails->product->name,
            'raw_material_name' => $productDetails->rawMaterial->name,
            'raw_material_type' => $productDetails->rawMaterial->rawMaterialType->name,
        ]);
    }
    public function getOrderDetails(Request $request)
    {
        $productModelId = $request->input('product_model');
        $orderDetail = OrderDetail::where('product_model_id', $productModelId)->first();
        return response()->json([
            'order_date' => $orderDetail->order_date,
            'total_quantity' => $orderDetail->quantity,
            'available_quantity' => $orderDetail->available_quantity,
            'total_r_w_weight' => $orderDetail->total_raw_material,



        ]);
    }

    public function getDcDetails(Request $request,  $id)
    {
        $productModelId = $id;
        // $orderDetail = OrderDetail::where('product_model_id', $productModelId)->first();
        $dcDetail = DeliveryChallan::where('id', $productModelId)->with('orderDetails', 'orderDetails.orderNo', 'orderDetails.productModel', 'orderDetails.customer', 'orderDetails.productModel.product', 'orderDetails.productModel.rawMaterial.rawMaterialType')->first();
        // dd($dcDetail->orderDetails);

        return response()->json([
            'dcDetail' => $dcDetail,
            // 'order_date' => $orderDetail->order_date,
            // 'total_quantity' => $orderDetail->quantity,
            // 'available_quantity' => $orderDetail->available_quantity,
        ]);
    }

    // Store Date
    public function store(Request $request)
    {



        $validatedData = $request->validate([
            'employee_id' => 'required',
            'quantity' => 'required',

        ]);

        $input = $request->all();

        // Check if input quantity exceeds available quantity
        $deliveryChallan = DeliveryChallan::find($input['dc_number']);

        $orderDetail = OrderDetail::where('id', $deliveryChallan->order_id)->first();

        $product_model_id = $orderDetail->product_model_id;

        $order_id = $deliveryChallan->order_id;

        if ($deliveryChallan) {
            $totalQuantityGiven = JobGiving::where('dc_id', $input['dc_number'])->sum('quantity');
            $availableQuantity = $deliveryChallan->quantity - $totalQuantityGiven;
            if ($input['quantity'] > $availableQuantity) {
                // If the input quantity is greater than the available quantity, show an error message
                return redirect()->route('job_allocation.job_giving.index')
                    ->with('error', 'No available quantity for this order');
            }
        }


        // Create new job giving record
        $job_giving = new JobGiving();
        $job_giving->employee_id = $input['employee_id'];
        $job_giving->order_id = $order_id;
        $job_giving->product_model_id = $product_model_id;
        $job_giving->quantity = $input['quantity'];
        $job_giving->dc_id = $input['dc_number'];
        $job_giving->weight = $input['weight'];
        $job_giving->days = $input['deadline_days'];
        $job_giving->save();

        // Update available quantity in delivery challan
        $deliveryChallan->available_quantity = $availableQuantity - $input['quantity'];
        $deliveryChallan->save();



        return redirect()->route('job_allocation.job_giving.index')
            ->with('success', 'Job Giving Created Successfully');
    }



    // Edit
    public function edit(Request $request, $id)
    {
        $delivery_challan = DeliveryChallan::all();
        $order_details = OrderDetail::all();
        $productModels = ProductModel::with(['rawMaterial.rawMaterialType', 'product'])->get();
        $employee = Employee::with(['company' => function ($query) {
            $query->with('companyType');
        }])->get();
        $JobGiving = JobGiving::find($id);
        // dd($JobGiving);
        return view('pages.job_allocation.job_giving.edit', compact('delivery_challan', 'order_details', 'employee', 'JobGiving', 'productModels', 'id'));
    }


    // Update
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'employee_id' => 'required',
            'order_id' => 'required',
            'product_model_id' => 'required',
            'quantity' => 'required',
            'date' => 'required',
            'status' => 'required'
        ]);

        $input = $request->all();

        // Find the job giving record to update
        $job_giving = JobGiving::find($id);

        // Check if input quantity exceeds available quantity
        $deliveryChallan = DeliveryChallan::find($job_giving->dc_id);
        if ($deliveryChallan) {
            $totalQuantityGiven = JobGiving::where('dc_id', $job_giving->dc_id)->where('id', '!=', $id)->sum('quantity');
            $availableQuantity = $deliveryChallan->quantity - $totalQuantityGiven + $job_giving->quantity;
            if ($input['quantity'] > $availableQuantity) {
                // If the input quantity is greater than the available quantity, show an error message
                return redirect()->route('job_allocation.job_giving.edit', $id)
                    ->with('error', 'No available quantity for this order');
            }
        }

        // Update job giving record
        $job_giving->employee_id = $input['employee_id'];
        $job_giving->order_id = $input['order_id'];
        $job_giving->product_model_id = $input['product_model_id'];
        $job_giving->quantity = $input['quantity'];
        $job_giving->date = $input['date'];
        $job_giving->status = $input['status'];

        if (isset($input['dc_number'])) {
            $job_giving->dc_id = $input['dc_number'];
        } else {
            $job_giving->dc_id = null; // Set dc_id to null if dc_number is not provided
        }

        $job_giving->save();

        // Update available quantity in delivery challan
        if ($deliveryChallan) {
            $totalQuantityGiven = JobGiving::where('dc_id', $job_giving->dc_id)->sum('quantity');
            $availableQuantity = $deliveryChallan->quantity - $totalQuantityGiven;
            $deliveryChallan->available_quantity = $availableQuantity;
            $deliveryChallan->save();
        }

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
        if ($job_giving->status == "Pending") {
            $current_quantity = $job_giving->quantity;

            $dc = DeliveryChallan::where('id', $job_giving->dc_id)->first();
            if ($dc) {
                $availableQuantity = $dc->available_quantity;
                $newAvailableQuantity = $availableQuantity + $current_quantity;
                $dc->available_quantity = $newAvailableQuantity;
                $dc->save();
                $job_giving->delete();
            }
        }



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
