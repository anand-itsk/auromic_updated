<?php

namespace App\Http\Controllers\PageControllers\MasterControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Exports\OrderExport;
use App\Models\Customer;
use App\Models\Product;
use App\Models\ProductModel;
use App\Models\ProductSize;
use App\Models\ProductColor;
use App\Models\OrderStatus;
use App\Models\OrderDetail;
use App\Models\OrderNo;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\DataTables\DataTables;

class OrderDetailController extends Controller
{
    public function index()
    {
        return view('pages.master.order_detail.index');
    }
    public function indexData()
    {
        // Eager load the related models
        $order_details = OrderDetail::with('orderNo', 'productSize', 'productColor', 'orderStatus', 'productModel', 'customer')->get();

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


        $customer = Customer::get();
        $products = Product::get();
        $order_status = OrderStatus::get();
        $product_size = ProductSize::get();
        $product_color = ProductColor::get();
        $productModels = ProductModel::with(['rawMaterial.rawMaterialType', 'productSize'])->get();

        return view('pages.master.order_detail.create', compact('customer', 'products', 'productModels', 'order_status', 'product_size', 'product_color', 'formattedOrderNumber'));
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
            

        ]);

        $order_no = new OrderNo();

        $order_no->last_order_number = $orderNumber;
        $order_no->customer_order_no = $request->input('customer_order_no');
        $order_no->created_by = $user->id;

        $order_no->save();
        $product_model = ProductModel::where('id', $request->input('product_model'))->first();
        $weight_per_item = $product_model->raw_material_weight_item;
        $orderDetail = new OrderDetail();


        $orderDetail->order_no_id = $order_no->id;
        $orderDetail->order_date = $request->input('order_date');
        $orderDetail->customer_id = $request->input('customer_id');
        $orderDetail->product_size_id = $request->input('product_size_id');
        $orderDetail->product_color_id = $request->input('product_color_id');
        $orderDetail->product_model_id = $request->input('product_model');
        $orderDetail->order_status_id = 2;
        $orderDetail->quantity = $request->input('quantity');
        $orderDetail->available_quantity = $request->input('quantity');
        $orderDetail->delivery_date = $request->input('delivery_date');
        $orderDetail->total_raw_material = $request->input('total_raw_material');
        $orderDetail->available_weight = $request->input('total_raw_material');
        $orderDetail->weight_per_item = $weight_per_item;

        $orderDetail->save();

        return redirect()->route('master.order_detail.index')
            ->with('success', 'Order Details Stored successfully');
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

        $validatedData = $request->validate([
            'order_date' => 'required|date',
            'customer_id' => 'required|exists:customers,id',

        ]);
        $orderDetail =  OrderDetail::find($id);


       
        $orderDetail->order_date = $request->input('order_date');
        $orderDetail->customer_id = $request->input('customer_id');
        $orderDetail->product_size_id = $request->input('product_size_id');
        $orderDetail->product_color_id = $request->input('product_color_id');
        $orderDetail->product_model_id = $request->input('product_model');
        $orderDetail->order_status_id = $request->input('order_status_id');
        $orderDetail->quantity = $request->input('quantity');
        $orderDetail->available_quantity = $request->input('quantity');
        $orderDetail->delivery_date = $request->input('delivery_date');
        $orderDetail->total_raw_material = $request->input('total_raw_material');
        // $orderDetail->weight_per_item = $weight_per_item;
        $orderDetail->save();

        return redirect()->route('master.order_detail.index')
            ->with('success', 'Order Details Updated successfully');
    }

    public function storeNewOrder(Request $request, $id)
    {
        $validatedData = $request->validate([
            'order_date' => 'required|date',
            'customer_id' => 'required|exists:customers,id',

        ]);

        $orderDetail = new OrderDetail();


        $orderDetail->order_no_id = $id;
        $orderDetail->order_date = $request->input('order_date');
        $orderDetail->customer_id = $request->input('customer_id');
        $orderDetail->product_size_id = $request->input('product_size_id');
        $orderDetail->product_color_id = $request->input('product_color_id');
        $orderDetail->product_model_id = $request->input('product_model');
        $orderDetail->order_status_id = 2;
        $orderDetail->quantity = $request->input('quantity');
        $orderDetail->available_quantity = $request->input('quantity');
        $orderDetail->delivery_date = $request->input('delivery_date');
        $orderDetail->total_raw_material = $request->input('total_raw_material');

        $orderDetail->save();

        return redirect()->route('master.order_detail.index')
            ->with('success', 'Order Details Updated successfully');
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
        $order_details = OrderDetail::find($id);

        $order_details->delete();

        return redirect()->route('master.order_detail.index')->with('success', 'Order Detail Deleted successfully!');
    }
}
