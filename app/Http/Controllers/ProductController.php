<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Maatwebsite\Excel\Facades\Excel;

class ProductController extends Controller
{
   public function index()
   {

      $product = Product::paginate(10);


      return view('settings.masters.product.index', compact('product'));
   }

    public function indexData()
    {
        
        $product = Product::get();
        
        return DataTables::of($product)->make(true);
    }

   public function create()
   {

      return view('settings.masters.product.create');
   }

   public function store(Request $request)
   {
      $request->validate([
         'name' => 'required',
      ]);

      $product = new Product;
      $product->name = $request->input('name');
      $product->code = $request->input('code');


      $product->save();

      return redirect()->route('product-models.products')->with('success', 'Product added successfully!');
   }

   public function edit($id)
   {
      $product = Product::find($id);

      return view('settings.masters.product.edit', compact('product'));
   }

   public function update(Request $request, $id)
   {
      $request->validate([
         'name' => 'required',

      ]);

      $product = Product::find($id);
      $product->name = $request->input('name');
      $product->code = $request->input('code');
      $product->save();

      return redirect()->route('product-models.products')->with('success', 'Product Updated successfully!');
   }
   public function delete($id)
   {
      $product = Product::find($id);

      $product->delete();

      return redirect()->route('product-models.products')->with('success', 'Product Deleted successfully!');
   }

    public function deleteSelected(Request $request)
    {

        $ids = $request->ids;

        if (!is_array($ids)) {
            return response()->json(['status' => 'error', 'message' => 'Invalid input'], 400);
        }

        Product::destroy($ids);
        return response()->json(['status' => 'success']);
    }
}
