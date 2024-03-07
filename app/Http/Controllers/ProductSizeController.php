<?php

namespace App\Http\Controllers;

use App\Models\ProductSize;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Maatwebsite\Excel\Facades\Excel;

class ProductSizeController extends Controller
{
   public function index()
   {

      $product_size = ProductSize::paginate(10);


      return view('settings.masters.product_size.index', compact('product_size'));
   }

    public function indexData()
    {
        
        $product_size = ProductSize::get();
        
        return DataTables::of($product_size)->make(true);
    }

   public function create()
   {

      return view('settings.masters.product_size.create');
   }

   public function store(Request $request)
   {

      $request->validate([
         'name' => 'required',

      ]);

      $product_size = new ProductSize;
      $product_size->name = $request->input('name');
      $product_size->code = $request->input('code');


      $product_size->save();

      return redirect()->route('product-models.product_sizes')->with('success', 'Product Size added successfully!');
   }

   public function edit($id)
   {
      $product_size = ProductSize::find($id);

      return view('settings.masters.product_size.edit', compact('product_size'));
   }

   public function update(Request $request, $id)
   {
      $request->validate([
         'name' => 'required',

      ]);

      $product_size = ProductSize::find($id);
      $product_size->name = $request->input('name');
      $product_size->code = $request->input('code');
      $product_size->save();

      return redirect()->route('product-models.product_sizes')->with('success', 'Product Size Updated successfully!');
   }
   public function delete($id)
   {
      $product_size = ProductSize::find($id);

      $product_size->delete();

      return redirect()->route('product-models.product_sizes')->with('success', 'Product Size Deleted successfully!');
   }
   public function deleteSelected(Request $request)
    {

        $ids = $request->ids;

        if (!is_array($ids)) {
            return response()->json(['status' => 'error', 'message' => 'Invalid input'], 400);
        }

        ProductSize::destroy($ids);
        return response()->json(['status' => 'success']);
    }
}
