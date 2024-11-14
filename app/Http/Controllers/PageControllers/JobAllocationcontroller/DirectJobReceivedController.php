<?php

namespace App\Http\Controllers\PageControllers\JobAllocationController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DirectJobGiving;
use App\Models\Employee;
use App\Models\ProductColor;
use App\Models\ProductSize;
use App\Models\FinishingProductModel;
use App\Models\DirectJobReceived;
use App\Models\ProductModel;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\DataTables\DataTables;
use App\Exports\DirectJobReceivedExport;

class DirectJobReceivedController extends Controller
{
    public function index()
    {
        return view('pages.job_allocation.direct_job_received.index');
    }

    public function indexData()
    {

        $direct_job_giving = DirectJobGiving::with(['employee', 'finishingProduct', 'productSize', 'productColor'])->get();
        return DataTables::of($direct_job_giving)->make(true);
    }

    public function store(Request $request)
    {
        // dd($request);
        // Validate the request data
        $validatedData = $request->validate([
            'receiving_date' => 'required',

            // Add validation rules for other fields if needed
        ]);


        // Create a new instance of DirectJobReceived model
        $direct_job_received = new DirectJobReceived;

        // Set the properties of the DirectJobReceived model
        $direct_job_received->direct_job_giving_id = $request->input('direct_job_giving_id');
        $direct_job_received->finishing_product_models_id = $request->input('finishing_product_models_id');
        $direct_job_received->employee_id = $request->input('employee_id');
        $direct_job_received->product_color_id = $request->input('product_color_id');
        $direct_job_received->is_cutting = $request->input('is_cutting') === 'Yes' ? 1 : 0;
        $direct_job_received->balance_meter = $request->input('balance_meters');
        $direct_job_received->quantity = $request->input('received_quantity');
        $direct_job_received->wages_for_product = $request->input('wages_per_quantity');
        $direct_job_received->usage = $request->input('usage_meters');
        $direct_job_received->wastage = $request->input('wastage_meters');
        $direct_job_received->before_days = $request->input('before_days');
        $direct_job_received->after_days = $request->input('after_days');

        $direct_job_received->conveyance_fee = $request->input('conveyance');
        $direct_job_received->deducation_fee = $request->input('deduction');
        $direct_job_received->incentive_fee = $request->input('incentive');
        $direct_job_received->total_amount = $request->input('total_amount');
        $direct_job_received->net_amount = $request->input('net_amount');

        $direct_job_received->incentive_applicable = $request->input('Incentive_status');
        $direct_job_received->receving_date = $request->input('receiving_date');

        // Save the DirectJobReceived model to the database
        // dd($direct_job_received);
        $direct_job_received->save();

        $direct_job_giving_id = $request->input('direct_job_giving_id');
        $direct_job_giving = DirectJobGiving::findOrFail($direct_job_giving_id);

        // Update the complete_quantity field
        $direct_job_giving->useage_meter = $request->input('useage_meter');

        // Save the changes to the database
        $direct_job_giving->save();

        // Redirect to the appropriate route with a success message
        return redirect()->route('job_allocation.direct_job_received.index')
            ->with('success', 'Direct Job Received created successfully');
    }



    //       public function store(Request $request)
    // {
    //     // dd($request);
    //     $validatedData = $request->validate([

    //          'receving_date'=> 'required',

    //     ]);

    //    $direct_job_received = new DirectJobReceived;
    // $direct_job_received->incentive_applicable = $request->input('incentive_applicable');
    // $direct_job_received->product_model_id = $request->input('product_model_id');
    // $direct_job_received->receving_date = $request->input('receiving_date');
    // $direct_job_received->product_color_id = $request->input('product_color_id');
    // $direct_job_received->employee_id = $request->input('employee_id');

    // dd($direct_job_received);
    // // Check if either product_model_id or incentive_applicable is not null
    // if ($request->input('product_model_id') !== null || $request->input('incentive_applicable') !== null) {
    //     // Don't store direct_job_giving_id
    // } else {
    //     // Store direct_job_giving_id
    //     $direct_job_received->direct_job_giving_id = $request->input('direct_job_giving_id');
    // }
    // // dd($direct_job_received);

    // $direct_job_received->save();


    //     return redirect()->route('job_allocation.direct_job_received.index')
    //         ->with('success', ' Direct Job Received created successfully');
    // }




    //      public function edit(Request $request, $id)
    // {
    //     $direct_job_giving = DirectJobGiving::find($id);
    //     $product_model = Productmodel::all();

    //     // Combine data into an array
    //     $data = [
    //         'direct_job_giving' => $direct_job_giving,
    //         'product_model' => $product_model,
    //     ];

    //     // Return combined data as JSON response
    //     return response()->json($data);
    // }

    public function edit($id)
    {
        $direct_job_giving = DirectJobGiving::with('finishingProduct.productSize')->find($id);
        $finishingProduct = FinishingProductModel::all();
        $product_color = Productcolor::all();
        $product_size = ProductSize::get();

        $employee = Employee::with(['company' => function ($query) {
            $query->with('companyType');
        }])->get();


        return view('pages.job_allocation.direct_job_received.edit', compact('direct_job_giving', 'finishingProduct', 'employee', 'id', 'product_color', 'product_size'));
    }


    public function getFinishingProductDetails($id)
    {
        $finishingProduct = FinishingProductModel::findOrFail($id);

        return response()->json([

            'product_name' => $finishingProduct->product->name,
            'product_size' => $finishingProduct->productSize->name,
            'meters_one_product' => $finishingProduct->meters_one_product

        ]);
    }
    public function export(Request $request)
    {
        return Excel::download(new DirectJobReceivedExport($request->all()), 'DirectJobReceivedDatas_' . date('d-m-Y') . '.xlsx');
    }

}
