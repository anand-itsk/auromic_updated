<?php

namespace App\Http\Controllers;

use App\Models\PaymentMode;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Maatwebsite\Excel\Facades\Excel;

class PaymentModeController extends Controller
{
     public function index()
     {
        
        $payment_mode =PaymentMode::paginate(10);

        return view('settings.masters.payment_mode.index',compact('payment_mode'));

     }
        public function indexData()
    {
        
        $payment_mode = PaymentMode::get();
        
        return DataTables::of($payment_mode)->make(true);
    }

      public function create()
     {
        
        return view('settings.masters.payment_mode.create');

     }

       public function store(Request $request)
     {
        
        //   dd($request);
        $request->validate([
            'name' => 'required',
            'code' => 'required',
            
        ]);
        
        $payment_mode = new PaymentMode;
        $payment_mode->name = $request->input('name');
        $payment_mode->code = $request->input('code');
       
   
        $payment_mode->save();

        return redirect()->route('specified.payment_modes')->with('success', 'Payment Mode added successfully!');


     }

      public function edit($id)
     {
        $payment_mode= PaymentMode::find($id);
      
        return view('settings.masters.payment_mode.edit', compact('payment_mode'));
       
     }

     public function update(Request $request, $id)
    {
          $request->validate([
            'name' => 'required',
            'code' => 'required',
            
        ]);
    
        $payment_mode = PaymentMode::find($id);
        $payment_mode->name = $request->input('name');
        $payment_mode->code = $request->input('code');
        $payment_mode->save();
    
         return redirect()->route('specified.payment_modes')->with('success', 'Payment Mode Updated successfully!');
    }
        public function delete($id)
    {
          $payment_mode = PaymentMode::find($id);

         $payment_mode->delete();

          return redirect()->route('specified.payment_modes')->with('success', 'Payment Mode Deleted successfully!');

    }

    public function deleteSelected(Request $request)
    {

        $ids = $request->ids;

        if (!is_array($ids)) {
            return response()->json(['status' => 'error', 'message' => 'Invalid input'], 400);
        }

        PaymentMode::destroy($ids);
        return response()->json(['status' => 'success']);
    }
}
