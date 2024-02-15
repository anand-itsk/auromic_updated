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
use Yajra\DataTables\DataTables;
class OrderDetailController extends Controller
{
     public function index()
     {
        return view('pages.master.order_detail.index');
     }
       public function indexData()
    {
        // Eager load the roles relationship
        $order_detail = OrderDetail::all();
        // dd($product_model[0]->rawMaterial->rawMaterialType);
        return DataTables::of($order_detail)->make(true);
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
            // Define validation rules for each input field
            'order_no' => 'required',
            'order_date' => 'required|date',
            'customer_id' => 'required|exists:customers,id', 
            
        ]);
        $orderDetail = new OrderDetail();
        
        // Assign values from the form to the OrderDetail instance
        $orderDetail->order_no = $request->input('order_no');
        $orderDetail->order_date = $request->input('order_date');
        $orderDetail->customer_id = $request->input('customer_id');
          $orderDetail->product_size_id = $request->input('product_size_id');
            $orderDetail->product_color_id = $request->input('product_color_id');
             $orderDetail->product_model_id = $request->input('product_model');
            $orderDetail->order_status_id = $request->input('order_status_id');
                  $orderDetail->quantity = $request->input('quantity');
                    $orderDetail->quantity = $request->input('delivery_date');
                      $orderDetail->quantity = $request->input('total_raw_material');
        // Assign values for other fields similarly
        
        // Save the OrderDetail instance to the database
        $orderDetail->save();
        // Optionally, you can redirect the user after successful submission
        return redirect()->route('master.order_detail.index');
    }
 
}
