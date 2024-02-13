<?php

namespace App\Http\Controllers\PageControllers\MasterControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\Product;
class OrderDetailController extends Controller
{
     public function index()
     {
        return view('pages.master.order_detail.index');
     }

      public function create()
     {
        $customer = Customer::get();
        $product = Product::get();
        return view('pages.master.order_detail.create',compact('customer','product'));
     }
}
