<?php

namespace App\Http\Controllers\PageControllers\MasterControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\Product;
use App\Models\ProductModel;
use App\Models\ProductSize;
use App\Models\ProductColor;
use App\Models\OrderStatus;
use App\Models\OrderDetail;
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
    $order_details = OrderDetail::with('productSize', 'productColor', 'orderStatus','productModel','customer')->get();

    return DataTables::of($order_details)->make(true);
}


      public function create()
     {
        $customer = Customer::get();
        $products = Product::get();
         $order_status = OrderStatus::get();
         $product_size = ProductSize::get();
           $product_color = ProductColor::get();
         $productModels = ProductModel::with(['rawMaterial.rawMaterialType'])->get();
          
        return view('pages.master.order_detail.create',compact('customer','products','productModels','order_status','product_size','product_color'));
     }

     public function store(Request $request)
    {

      $validatedData = $request->validate([
            'order_no' => 'required',
            'order_date' => 'required|date',
            'customer_id' => 'required|exists:customers,id', 
            
        ]);
        $orderDetail = new OrderDetail();
        

        $orderDetail->order_no = $request->input('order_no');
        $orderDetail->order_date = $request->input('order_date');
        $orderDetail->customer_id = $request->input('customer_id');
        $orderDetail->product_size_id = $request->input('product_size_id');
        $orderDetail->product_color_id = $request->input('product_color_id');
        $orderDetail->product_model_id = $request->input('product_model');
        $orderDetail->order_status_id = $request->input('order_status_id');
        $orderDetail->quantity = $request->input('quantity');
        $orderDetail->delivery_date = $request->input('delivery_date');
        $orderDetail->total_raw_material = $request->input('total_raw_material');
       
        $orderDetail->save();
   
        return redirect()->route('master.order_detail.index')
            ->with('success', 'Order Ststus Stored successfully');
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
          
          return view('pages.master.order_detail.edit', compact('order_details','customer','products','order_status','product_size','product_color','productModels'));
    }

    public function update(Request $request, $id)
    {

      $validatedData = $request->validate([
            
            'order_no' => 'required',
            'order_date' => 'required|date',
            'customer_id' => 'required|exists:customers,id', 
            
        ]);
        $orderDetail =  OrderDetail::find($id);
        
        
        $orderDetail->order_no = $request->input('order_no');
        $orderDetail->order_date = $request->input('order_date');
        $orderDetail->customer_id = $request->input('customer_id');
        $orderDetail->product_size_id = $request->input('product_size_id');
        $orderDetail->product_color_id = $request->input('product_color_id');
        $orderDetail->product_model_id = $request->input('product_model');
        $orderDetail->order_status_id = $request->input('order_status_id');
        $orderDetail->quantity = $request->input('quantity');
        $orderDetail->delivery_date = $request->input('delivery_date');
        $orderDetail->total_raw_material = $request->input('total_raw_material');
       
        $orderDetail->save();
      
       return redirect()->route('master.order_detail.index')
            ->with('success', 'Order Ststus Updated successfully');
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
        return Excel::download(new OrderExport($request->all()), 'CustomerDatas_' . date('d-m-Y') . '.xlsx');
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
