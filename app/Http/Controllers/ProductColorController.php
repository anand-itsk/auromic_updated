<?php

namespace App\Http\Controllers;
use App\Models\ProductColor;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Maatwebsite\Excel\Facades\Excel;

class ProductColorController extends Controller
{
    public function index()
     {
   
        $product_color = ProductColor::paginate(10);


        return view('settings.masters.product_color.index',compact('product_color'));

     }

     public function indexData()
    {
        
        $product_color = ProductColor::get();
        
        return DataTables::of($product_color)->make(true);
    }


      public function create()
     {
        
        return view('settings.masters.product_color.create');

     }

       public function store(Request $request)
     {
        
        //   dd($request);
        $request->validate([
            'name' => 'required',
            
        ]);
        
        $product_color = new ProductColor;
        $product_color->name = $request->input('name');
        $product_color->code = $request->input('code');
       
   
        $product_color->save();

        return redirect()->route('product-models.product_colors')->with('success', 'Product Color added successfully!');


     }

      public function edit($id)
     {
        $product_color= ProductColor::find($id);
      
        return view('settings.masters.product_color.edit', compact('product_color'));
       
     }

     public function update(Request $request, $id)
    {
          $request->validate([
            'name' => 'required',
            
        ]);
    
        $product_color = ProductColor::find($id);
        $product_color->name = $request->input('name');
        $product_color->code = $request->input('code');
        $product_color->save();
    
         return redirect()->route('product-models.product_colors')->with('success', 'Product Color Updated successfully!');
    }
        public function delete($id)
    {
          $product_color = ProductColor::find($id);

          $product_color->delete();

          return redirect()->route('product-models.product_colors')->with('success', 'Product Color Deleted successfully!');

    }

     public function deleteSelected(Request $request)
    {

        $ids = $request->ids;

        if (!is_array($ids)) {
            return response()->json(['status' => 'error', 'message' => 'Invalid input'], 400);
        }

        ProductColor::destroy($ids);
        return response()->json(['status' => 'success']);
    }
}
