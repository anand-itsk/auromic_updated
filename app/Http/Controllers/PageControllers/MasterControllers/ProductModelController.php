<?php

namespace App\Http\Controllers\PageControllers\MasterControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RawMaterial;
use App\Models\Product;
use App\Models\ProductSize;
class ProductModelController extends Controller
{
     public function index()
     {
        return view('pages.master.product_model.index');
     }

      public function indexData()
    {
        // Eager load the roles relationship
        $product_model = ProductModel::query();
        return DataTables::of($product_model)->make(true);
    }

      public function create()
    {
        $raw_material = RawMaterial::all();
         $product = Product::all();
         $product_size = ProductSize::all();
        return view('pages.master.product_model.create',compact('raw_material','product','product_size'));
    }
}
