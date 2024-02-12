<?php

namespace App\Http\Controllers;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
     {
   
        $product = Product::paginate(10);


        return view('settings.masters.product.index',compact('product'));

     }

      public function create()
     {
        
        return view('settings.masters.product.create');

     }

       public function store(Request $request)
     {
        
        //   dd($request);
        $request->validate([
            'name' => 'required',
            'code' => 'required',
            
        ]);
        
        $product = new Product;
        $product->name = $request->input('name');
        $product->code = $request->input('code');
       
   
        $product->save();

        return redirect()->route('products')->with('success', 'Product added successfully!');


     }

      public function edit($id)
     {
        $product= Product::find($id);
      
        return view('settings.masters.product.edit', compact('product'));
       
     }

     public function update(Request $request, $id)
    {
          $request->validate([
            'name' => 'required',
            'code' => 'required',
            
        ]);
    
        $product = Product::find($id);
        $product->name = $request->input('name');
        $product->code = $request->input('code');
        $product->save();
    
         return redirect()->route('products')->with('success', 'Product Updated successfully!');
    }
        public function delete($id)
    {
          $product = Product::find($id);

         $product->delete();

          return redirect()->route('products')->with('success', 'Product Deleted successfully!');

    }
}
