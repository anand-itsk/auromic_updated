<?php

namespace App\Http\Controllers;
use App\Models\OrderStatus;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Maatwebsite\Excel\Facades\Excel;

class OrderStatusController extends Controller
{
     public function index()
     {
   
        $order_status = OrderStatus::paginate(10);


        return view('settings.masters.order_status.index',compact('order_status'));

     }

     public function indexData()
    {
        
        $order_status = OrderStatus::get();
        
        return DataTables::of($order_status)->make(true);
    }

      public function create()
     {
        
        return view('settings.masters.order_status.create');

     }

       public function store(Request $request)
     {
        
        //   dd($request);
        $request->validate([
            'name' => 'required',
            
        ]);
        
        $order_status = new OrderStatus;
        $order_status->name = $request->input('name');
        $order_status->code = $request->input('code');
       
   
        $order_status->save();

        return redirect()->route('product-models.order_statuses')->with('success', 'Order Status added successfully!');


     }

      public function edit($id)
     {
        $order_status= OrderStatus::find($id);
      
        return view('settings.masters.order_status.edit', compact('order_status'));
       
     }

     public function update(Request $request, $id)
    {
          $request->validate([
            'name' => 'required',
            
        ]);
    
        $order_status = OrderStatus::find($id);
        $order_status->name = $request->input('name');
        $order_status->code = $request->input('code');
        $order_status->save();
    
         return redirect()->route('product-models.order_statuses')->with('success', 'Order Status Updated successfully!');
    }
        public function delete($id)
    {
          $order_status = OrderStatus::find($id);

         $order_status->delete();

          return redirect()->route('product-models.order_statuses')->with('success', 'Order Status Deleted successfully!');

    }

    public function deleteSelected(Request $request)
    {

        $ids = $request->ids;

        if (!is_array($ids)) {
            return response()->json(['status' => 'error', 'message' => 'Invalid input'], 400);
        }

        OrderStatus::destroy($ids);
        return response()->json(['status' => 'success']);
    }
}
