<?php

namespace App\Http\Controllers\PageControllers\MasterControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Exports\OrderExport;
use App\Imports\ModelDataImport;
use App\Models\Company;
use App\Models\CompanyType;
use App\Models\Customer;
use App\Models\Product;
use App\Models\ProductModel;
use App\Models\ProductSize;
use App\Models\ProductColor;
use App\Models\OrderStatus;
use App\Models\OrderDetail;
use App\Models\OrderNo;
use App\Models\RawMaterial;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\DataTables\DataTables;

class OrderDetailController extends Controller
{
    public function index()
    {
        $companyType = CompanyType::all();
        $company = Company::all();
        $customer = Customer::all();
        $order_nos = OrderNo::all();
        $product = Product::all();
        $order_status = OrderStatus::all();
   
        return view('pages.master.order_detail.index',compact('companyType', 'company', 'customer', 'order_nos', 'product', 'order_status'));
    }
    public function indexData(Request $request)
    {
        // Eager load the related models
        $companyType = $request->input('company_type');
        $company = $request->input('companies');
        $customer = $request->input('customer');
        $fromDate = $request->input('from_date');
        $lastDate = $request->input('last_date');
        $orderNoId = $request->input('orderNoId');
        $order_no = $request->input('order_no');
        $product = $request->input('product');
        $dateFilter = $request->input('date_filter');
        $order_status = $request->input('order_status');
        $order_details = OrderDetail::with('orderNo', 'productSize', 'productColor', 'orderStatus', 'productModel.product', 'customer');
        // $order_details = OrderDetail::with('orderNo', 'productSize', 'productColor', 'orderStatus', 'productModel', 'customer')->get();
        if ($order_status) {
            $order_details->where('order_status_id', $order_status);
        }

        // Filter by company type
        if ($companyType) {
            $order_details->whereHas('deliveryChallans.company', function ($q) use ($companyType) {
                $q->where('company_type_id', $companyType);
            });
        }


        // Filter by company
        if ($company) {
            $companies = is_array($company) ? $company : [$company];
            $order_details->whereHas('deliveryChallans.company', function ($q) use ($companies) {
                $q->whereIn('company_id', $companies);
            });
        }

        // Filter by customer
        if ($customer) {
            $order_details->where('customer_id', $customer);
        }


        if ($dateFilter) {
            if ($dateFilter === 'today') {
                $order_details->whereDate('created_at', Carbon::today());
            } elseif ($dateFilter === 'this_month') {
                $order_details->whereMonth('created_at', Carbon::now()->month)
                ->whereYear('created_at', Carbon::now()->year);
            } elseif ($dateFilter === 'last_month') {
                $order_details->whereMonth('created_at', Carbon::now()->subMonth()->month)
                ->whereYear('created_at', Carbon::now()->subMonth()->year);
            }
        }
        // Filter by date range
        if ($fromDate && $lastDate) {
            $order_details->whereBetween('order_date', [$fromDate, $lastDate]);
        }
        // Filter by order number
        if ($orderNoId) {
            $order_details->where('order_no_id', $orderNoId);
        }

        if ($order_no) {
            $order_details->where('order_no_id', $order_no);
        }
      
        // Filter by product
        if ($product) {
            $order_details->whereHas('productModel.product', function ($q) use ($product) {
                $q->where('id', $product);
            });
        }


        // Filter by product
        if ($product) {
            $order_details->whereHas('productModel.product', function ($q) use ($product) {
                $q->where('id', $product);
            });
        }

        return DataTables::of($order_details)->make(true);
    }


    public function create()
    {
        $latestOrderNumber = OrderDetail::latest()->first();
        if ($latestOrderNumber) {
            $orNumber = (int)substr($latestOrderNumber->order_no, 2); // Extract the numeric part
            $orNumber++;
        } else {
            $orNumber = 1;
        }

        // Format the DC number with leading zeros
        $formattedOrderNumber = 'OR' . str_pad($orNumber, 3, '0', STR_PAD_LEFT);

        $raw_material = RawMaterial::all();
        $customer = Customer::get();
        $products = Product::get();
        $order_status = OrderStatus::get();
        $product_size = ProductSize::get();
        $product_color = ProductColor::get();
        $productModels = ProductModel::with(['rawMaterial.rawMaterialType', 'productSize'])->get();

        return view('pages.master.order_detail.create', compact('customer', 'products', 'productModels', 'order_status', 'product_size', 'product_color', 'formattedOrderNumber', 'raw_material'));
    }

    public function checkName(Request $request)
    {

        $customer_order_no = $request->input('customer_order_no'); 

        $exists = OrderNo::where('customer_order_no', $customer_order_no)->exists();

        return response()->json(['exists' => $exists]);
    }



    public function getProductModels($productId)
{
    // Fetch product models based on the selected product ID
    $productModels = ProductModel::where('product_id', $productId)->get();
    return response()->json($productModels);
}

    public function getProductDetails(Request $request)
    {
        $productModelId = $request->input('product_model');
        $productDetails = ProductModel::with(['product', 'rawMaterial.rawMaterialType'])->find($productModelId);

        return response()->json([
            'product' => $productDetails->product->name,
            'raw_material_name' => $productDetails->rawMaterial->name,
            'stock' => $productDetails->rawMaterial->stock,
            'raw_material_type' => $productDetails->rawMaterial->rawMaterialType->name,
            'product_size_code' => $productDetails->productSize->code,
            'product_size_id' => $productDetails->productSize->id,
            'wages_product' => $productDetails->wages_product,
            'raw_material_weight_item' => $productDetails->raw_material_weight_item,
        ]);
    }
    public function store(Request $request)
    {
        $user = Auth::user();
        $lastOrderNumber = OrderNo::max('last_order_number');
        // Increment the last order number
        $nextOrderNumber = 'ORD' . (intval(substr($lastOrderNumber, 3)) + 1);

        // Generate the order number with the prefix
        $orderNumber = $nextOrderNumber;

        $validatedData = $request->validate([
            'order_date' => 'required|date',
            'customer_id' => 'required|exists:customers,id',
            'customer_order_no' => 'required|unique:order_nos,customer_order_no',
            'quantity' => 'required|integer|min:1', // Ensure the quantity is valid
        ]);

        $order_no = new OrderNo();
        $order_no->last_order_number = $orderNumber;
        $order_no->customer_order_no = $request->input('customer_order_no');
        $order_no->created_by = $user->id;
        $order_no->save();

        $product_model = ProductModel::where('id', $request->input('product_model'))->first();
        $weight_per_item = $product_model->raw_material_weight_item;

        // Fetch the related raw material
        $raw_material = RawMaterial::where('id', $product_model->raw_material_id)->first();

        // Check if raw material stock is sufficient
        $quantity = $request->input('quantity');
        if ($raw_material->stock < $quantity) {
            return redirect()->back()->withErrors(['quantity' => 'Quantity exceeds available stock']);
        }

        // Create the order detail
        $orderDetail = new OrderDetail();
        $orderDetail->order_no_id = $order_no->id;
        $orderDetail->order_date = $request->input('order_date');
        $orderDetail->customer_id = $request->input('customer_id');
        $orderDetail->product_size_id = $request->input('product_size_id');
        $orderDetail->product_color_id = $request->input('product_color_id');
        $orderDetail->product_model_id = $request->input('product_model');
        $orderDetail->order_status_id = 2;
        $orderDetail->quantity = $quantity;
        $orderDetail->available_quantity = $quantity;
        $orderDetail->delivery_date = $request->input('delivery_date');
        $orderDetail->total_raw_material = $request->input('total_raw_material');
        $orderDetail->available_weight = $request->input('total_raw_material');
        $orderDetail->weight_per_item = $weight_per_item;
        $orderDetail->save();

        // Decrease the raw material stock
        $raw_material->stock -= $quantity;
        $raw_material->save();

        return redirect()->route('master.order_detail.index')
        ->with('success', 'Order Details Stored successfully and Stock Updated');
    }


    public function edit($id)
    {
        $order_details = OrderDetail::find($id);
        $customer = Customer::get();
        $products = Product::get();
        $order_status = OrderStatus::get();
        $product_size = ProductSize::get();
        $product_color = ProductColor::get();
        $productModels = ProductModel::with(['rawMaterial.rawMaterialType'])->get();

        return view('pages.master.order_detail.edit', compact('order_details', 'customer', 'products', 'order_status', 'product_size', 'product_color', 'productModels'));
    }

    public function addOrder($id)
    {

        $order_details = OrderDetail::find($id);
        
        // dd($order_details->orderNo->last_order_number);
        // $order_no_id = $order_details->order_no_id;
        $customer = Customer::get();
        $products = Product::get();
        $order_status = OrderStatus::get();
        $product_size = ProductSize::get();
        $product_color = ProductColor::get();
        $productModels = ProductModel::with(['rawMaterial.rawMaterialType','productSize'])->get();
        $orderDetails = OrderDetail::all();
        // dd($orderDetails);
        return view('pages.master.order_detail.add_order', compact('order_details', 'customer', 'products', 'order_status', 'product_size', 'product_color', 'productModels','orderDetails'));
    }

    public function update(Request $request, $id)
    {
        // Validate the incoming data
        $validatedData = $request->validate([
            'order_date' => 'required|date',
            'customer_id' => 'required|exists:customers,id',
            'quantity' => 'required|integer|min:1', // Ensure the quantity is valid
        ]);

        // Find the order detail record to update
        $orderDetail = OrderDetail::find($id);

        // Fetch the product model and associated raw material
        $product_model = ProductModel::where('id', $request->input('product_model'))->first();
        $raw_material = RawMaterial::where('id', $product_model->raw_material_id)->first();

        // Get the current quantity of the order before the update
        $currentQuantity = $orderDetail->quantity;

        // New quantity to be updated
        $newQuantity = $request->input('quantity');

        // Check if the quantity has changed
        if ($newQuantity != $currentQuantity) {
            // If quantity is increased
            if ($newQuantity > $currentQuantity) {
                $quantityDifference = $newQuantity - $currentQuantity;

                // Check if raw material stock is sufficient for the increase
                if ($raw_material->stock < $quantityDifference) {
                    return redirect()->back()->withErrors(['quantity' => 'Quantity exceeds available stock']);
                }

                // Decrease the raw material stock for the extra quantity
                $raw_material->stock -= $quantityDifference;
            }
            // If quantity is decreased
            else {
                $quantityDifference = $currentQuantity - $newQuantity;

                // Increase the raw material stock for the reduced quantity
                $raw_material->stock += $quantityDifference;
            }

            // Save the updated raw material stock
            $raw_material->save();
        }

        // Update the order detail
        $orderDetail->order_date = $request->input('order_date');
        $orderDetail->customer_id = $request->input('customer_id');
        $orderDetail->product_size_id = $request->input('product_size_id');
        $orderDetail->product_color_id = $request->input('product_color_id');
        $orderDetail->product_model_id = $request->input('product_model');
        $orderDetail->order_status_id = $request->input('order_status_id');
        $orderDetail->quantity = $newQuantity;
        $orderDetail->available_quantity = $newQuantity;
        $orderDetail->delivery_date = $request->input('delivery_date');
        $orderDetail->total_raw_material = $request->input('total_raw_material');
        $orderDetail->save();

        return redirect()->route('master.order_detail.index')
        ->with('success', 'Order Details Updated successfully and Stock Adjusted');
    }

    public function storeNewOrder(Request $request, $id)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'order_date' => 'required|date',
            'customer_id' => 'required|exists:customers,id',
            'quantity' => 'required|integer|min:1',
        ]);

        // Find the product model based on the request input
        $product_model = ProductModel::find($request->input('product_model'));
        $weight_per_item = $product_model->raw_material_weight_item;

        // Fetch the related raw material
        $raw_material = RawMaterial::find($product_model->raw_material_id);

        // Check if raw material stock is sufficient
        $quantity = $request->input('quantity');
        if ($raw_material->stock < $quantity) {
            return redirect()->back()->withErrors(['quantity' => 'Quantity exceeds available stock']);
        }

        // Create the order details
        $orderDetail = new OrderDetail();
        $orderDetail->order_no_id = $id;
        $orderDetail->order_date = $request->input('order_date');
        $orderDetail->customer_id = $request->input('customer_id');
        $orderDetail->product_size_id = $request->input('product_size_id');
        $orderDetail->product_color_id = $request->input('product_color_id');
        $orderDetail->product_model_id = $request->input('product_model');
        $orderDetail->order_status_id = 2; // Set default status
        $orderDetail->quantity = $quantity;
        $orderDetail->available_quantity = $quantity;
        $orderDetail->delivery_date = $request->input('delivery_date');
        $orderDetail->total_raw_material = $request->input('total_raw_material');
        $orderDetail->weight_per_item = $weight_per_item;
        $orderDetail->save();

        // Decrease the raw material stock based on the quantity
        $raw_material->stock -= $quantity;
        $raw_material->save();

        // Redirect back with success message
        return redirect()->route('master.order_detail.index')
        ->with('success', 'Order Details Stored successfully and Raw Material Stock Updated');
    }

    public function deleteSelected(Request $request)
    {

        $ids = $request->ids;

        if (!is_array($ids)) {
            return response()->json(['status' => 'error', 'message' => 'Invalid input'], 400);
        }

        OrderDetail::destroy($ids);
        return response()->json(['status' => 'success']);
    }

    public function export(Request $request)
    {
        return Excel::download(new OrderExport($request->all()), 'OrderDetailDatas_' . date('d-m-Y') . '.xlsx');
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:xlsx,csv'
        ]);

        Excel::import(new ModelDataImport, request()->file('file'));

        return redirect()->route('master.order_detail.index')->with('success', 'Data imported successfully');
    }

   public function delete($id)
{
    $order_detail = OrderDetail::find($id);

    if ($order_detail) {
        // Find the associated OrderNo record
        $order_no = OrderNo::find($order_detail->order_no_id);

        // Delete the OrderDetail record
        $order_detail->delete();

        // If the OrderNo record exists, delete it
        if ($order_no) {
            $order_no->delete();
        }

        return redirect()->route('master.order_detail.index')->with('success', 'Order Detail and its related Order No Deleted successfully!');
    }

    return redirect()->route('master.order_detail.index')->with('error', 'Order Detail not found!');
}

}
