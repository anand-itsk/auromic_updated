<?php

namespace App\Http\Controllers\PageControllers\JobAllocation;

use App\Http\Controllers\Controller;
use App\Models\AuthorisedPerson;
use App\Exports\DeliveryChallanExport;
use App\Models\Company;
use App\Models\Customer;
use App\Models\CompanyType;
use App\Models\ProductModel;
use App\Models\ProductSize;
use App\Models\ProductColor;
use App\Models\DeliveryChallan;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Maatwebsite\Excel\Facades\Excel;

class DeliveryChallanController extends Controller
{

    // Index Page
    public function index()
    {
        return view('pages.job_allocation.delivery_challan.index');
    }
    // Index DataTable
    public function indexData()
    {
        $delivery_challans = DeliveryChallan::with('company', 'order_details','productSize','productColor')->get();
        return DataTables::of($delivery_challans)->make(true);
    }
    // Create Page
    public function create()
    {
     $latestDeliveryChallan = DeliveryChallan::latest()->first();
    if ($latestDeliveryChallan) {
        $dcNumber = (int)substr($latestDeliveryChallan->dc_no, 2); // Extract the numeric part
        $dcNumber++;
    } else {
        $dcNumber = 1;
    }

    // Format the DC number with leading zeros
    $formattedDCNumber = 'DC' . str_pad($dcNumber, 3, '0', STR_PAD_LEFT);
        
        $customer= Customer::all();
        $company = Company::all();
        $company_types = CompanyType::all();
        $authorised_people = AuthorisedPerson::all();
        $order_details = OrderDetail::all();
        $productModels = ProductModel::with(['rawMaterial.rawMaterialType'])->get();
        $product_size= ProductSize::all();
        $product_color = ProductColor::all();
        
        return view('pages.job_allocation.delivery_challan.create', compact('company', 'authorised_people', 'order_details','company_types','customer','productModels','product_size','product_color','formattedDCNumber'));
    }
  public function getProductModel($orderId)
    {
        // Fetch the product model data based on the selected order number
        $orderDetail = OrderDetail::findOrFail($orderId);
        $productModel = $orderDetail->productModel;

        // Generate HTML option for the product model
        
        $option = '<option value="'. $productModel->id . '">' . $productModel->model_name . '-' . $productModel->model_code . '</option>';

        // Return the HTML option
        return $option;
    }

       public function getCompanies($companytypeid)
    {
        $companies = Company::where('company_type_id', $companytypeid)->with('authorisedPerson')->get();
        return response()->json($companies);
    }

     public function getOrders($customerId)
{
    $orders = OrderDetail::select('id', 'order_no', 'order_date','customer_id', 'product_model_id') // Select the desired columns
                        ->where('customer_id', $customerId)
                        ->get();
    return response()->json($orders);
}

public function getOrderDetails($orderId)
{
    $order = OrderDetail::findOrFail($orderId);
    $orderDetails = [
        
        'total_quantity' => $order->quantity,
        'available_quantity' => $order->available_quantity,
    ];
    return response()->json($orderDetails);
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
    
//     public function getOrders($customerId)
// {
//     $orders = OrderDetail::select('id', 'order_no', 'order_date', 'customer_id', 'product_model_id') // Include customer_id and product_model_id
//                     ->where('customer_id', $customerId)
//                     ->get();
//     return response()->json($orders);
// }

    // Store Date

public function store(Request $request)
{
    $validatedData = $request->validate([
        'company_type_id' => 'required',
        'company_id' => 'required',
        'customer_id' => 'required',
        'product_model' => 'required',
        'dc_number' => 'required',
        'dc_date' => 'required',
        'order_id' => 'required',
        'quantity' => 'required' // Ensure quantity is present in the request
    ]);

    $input = $request->all();

    // Retrieve the order detail
    $orderDetail = OrderDetail::findOrFail($input['order_id']);

    // Calculate total delivered quantity for the order
    $totalDeliveredQuantity = DeliveryChallan::where('order_id', $input['order_id'])->sum('quantity');

    // Calculate available quantity
    $availableQuantity = $orderDetail->quantity - $totalDeliveredQuantity;

    // Check if the input quantity exceeds the available quantity
    if ($input['quantity'] > $availableQuantity) {
        // If the input quantity is greater than the available quantity, show an error message
        return redirect()->route('job_allocation.delivery_challan.index')
            ->with('error', 'No available quantity for this order');
    }

    // Create and save the delivery challan
    $delivery_challan = new DeliveryChallan();
    $delivery_challan->company_id = $input['company_id'];
    $delivery_challan->dc_no = $input['dc_number'];
    $delivery_challan->order_id = $input['order_id'];
    $delivery_challan->dc_date = $input['dc_date'];
    $delivery_challan->quantity = $input['quantity'];
    $delivery_challan->product_size_id = $input['product_size_id'];
    $delivery_challan->product_color_id = $input['product_color_id'];
    $delivery_challan->save();

    // Update available quantity in order details
    $orderDetail->available_quantity = $availableQuantity - $input['quantity'];
    $orderDetail->save();

    // Set success message for display
    return redirect()->route('job_allocation.delivery_challan.index')
        ->with('success', 'Delivery challan created successfully');
}



    // Edit
    public function edit(Request $request, $id)
    {
        $delivery_challans = DeliveryChallan::find($id);
        $company = Company::all();
        $customer= Customer::all();
        $company_types = CompanyType::all();
        $authorised_people = AuthorisedPerson::all();
        $order_details = OrderDetail::all();
        $productModels = ProductModel::with(['rawMaterial.rawMaterialType','product'])->get();

        // dd($productModels);
        $product_size= ProductSize::all();
        $product_color = ProductColor::all();
           // Fetch order details based on conditions
    $order_detail = OrderDetail::where('customer_id', $request->customer_id)
        ->where('order_date', $request->order_date)
        ->where('product_model_id', $request->product_model)
        ->get();

        
        return view('pages.job_allocation.delivery_challan.edit', compact('company', 'authorised_people', 'order_details', 'delivery_challans','company_types','productModels','product_size','product_color','customer','order_detail'));
    }

public function getProductDetails(Request $request)
{
    $productModelId = $request->input('product_model_id');
    $productDetails = ProductModel::with(['product', 'rawMaterial.rawMaterialType'])->find($productModelId);

    return response()->json([
        'product_name' => $productDetails->product->name,
        'raw_material_name' => $productDetails->rawMaterial->name,
        'raw_material_type' => $productDetails->rawMaterial->rawMaterialType->name,
    ]);
}
    // Update
  public function update(Request $request, $id)
{
    $input = $request->all();

    // Retrieve the delivery challan to update
    $delivery_challan = DeliveryChallan::find($id);

    // Retrieve the corresponding order detail
    $orderDetail = OrderDetail::findOrFail($delivery_challan->order_id);

    // Calculate total delivered quantity for the order excluding the current delivery challan being updated
    $totalDeliveredQuantity = DeliveryChallan::where('order_id', $delivery_challan->order_id)
                                                ->where('id', '!=', $id)
                                                ->sum('quantity');

    // Calculate available quantity before the update
    $availableQuantityBeforeUpdate = $orderDetail->quantity - $totalDeliveredQuantity + $delivery_challan->quantity;

    // Calculate the difference between the old quantity and the new quantity
    $quantityDifference = $delivery_challan->quantity - $input['quantity'];

    // Update delivery challan details
    $delivery_challan->company_id = $input['company_id'];
    $delivery_challan->dc_no = $input['dc_number'];
    $delivery_challan->dc_date = $input['dc_date'];
    $delivery_challan->quantity = $input['quantity'];
    $delivery_challan->product_size_id = $input['product_size_id'];
    $delivery_challan->product_color_id = $input['product_color_id'];
    $delivery_challan->save();

    // Update available quantity in order details
    $orderDetail->available_quantity += $quantityDifference;
    $orderDetail->save();

    return redirect()->route('job_allocation.delivery_challan.index')
        ->with('success', 'Delivery challan updated successfully');
}


    // Multi Delete
    public function deleteSelected(Request $request)
    {

        $ids = $request->ids;

        if (!is_array($ids)) {
            return response()->json(['status' => 'error', 'message' => 'Invalid input'], 400);
        }

        DeliveryChallan::destroy($ids);
        return response()->json(['status' => 'success']);
    }

       public function delete($id)
    {
         $delivery_challan = DeliveryChallan::find($id);

         $delivery_challan->delete();

          return redirect()->route('job_allocation.delivery_challan.index')->with('success', 'Delivery Challan Deleted successfully!');

    }

     public function export(Request $request)
    {
        return Excel::download(new DeliveryChallanExport($request->all()), 'DeliveryChallanDatas_' . date('d-m-Y') . '.xlsx');
    }

     public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:xlsx,csv'
        ]);

        Excel::import(new DeliveryChallanImport, request()->file('file'));

        return redirect()->route('job_allocation.delivery_challan.index')->with('success', 'Data imported successfully');
    }
}
