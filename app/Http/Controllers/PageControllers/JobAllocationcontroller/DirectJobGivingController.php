<?php

namespace App\Http\Controllers\PageControllers\JobAllocationController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\DirectJobGiving;
use App\Exports\DirectJobGivingExport;
use App\Models\ProductModel;
use App\Models\FinishingProductModel;
use App\Models\ProductSize;
use App\Models\ProductColor;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\DataTables\DataTables;

class DirectJobGivingController extends Controller
{
    public function index()
    {
        return view('pages.job_allocation.direct_job_giving.index');
    }


    public function indexData()
    {

        $direct_job_giving = DirectJobGiving::with(['employee', 'finishingProduct', 'productSize', 'productColor'])->get();
        return DataTables::of($direct_job_giving)->make(true);
    }

    public function create()
    {

        $employee = Employee::with(['company' => function ($query) {
            $query->with('companyType');
        }])->get();
        $finishingProduct = FinishingProductModel::all();
        $product_size = ProductSize::get();
        $product_color = ProductColor::get();
        return view('pages.job_allocation.direct_job_giving.create', compact('employee', 'finishingProduct', 'product_size', 'product_color'));
    }


    public function getFinishingProductDetails($id)
    {
        $finishingProduct = FinishingProductModel::findOrFail($id);

        return response()->json([

            'product_name' => $finishingProduct->product->name,
            'product_size' => $finishingProduct->productSize->code,
            'meters_one_product' => $finishingProduct->meters_one_product,

        ]);
    }

    public function store(Request $request)
    {
        // dd($request);
        $validatedData = $request->validate([
            'employee_id' => 'required',
            'finishing_product_models_id' => 'required',
            'product_color_id' => 'required'
        ]);

        $direct_job_giving = new DirectJobGiving;
        $direct_job_giving->employee_id = $request->input('employee_id');
        $direct_job_giving->finishing_product_models_id = $request->input('finishing_product_models_id');
        $direct_job_giving->product_size_id = $request->input('product_size_id');
        $direct_job_giving->product_color_id = $request->input('product_color_id');
        $direct_job_giving->meter = $request->input('meter');
        $direct_job_giving->clothes_by_cutting = $request->input('clothes_by_cutting');
        $direct_job_giving->total_cutting_pieces = $request->input('total_cutting_pices');
        $direct_job_giving->total_quantity = $request->input('total_quantity');


        //  dd($direct_job_giving); 

        $direct_job_giving->save();


        return redirect()->route('job_allocation.direct_job_giving.index')
            ->with('success', ' Direct Job Giving created successfully');
    }

    public function edit($id)
    {

        $direct_job_giving = DirectJobGiving::with('finishingProduct.productSize')->find($id);
        $employee = Employee::with(['company' => function ($query) {
            $query->with('companyType');
        }])->get();

        $finishingProduct = FinishingProductModel::all();
        $product_size = ProductSize::get();
        $product_color = ProductColor::get();
        return view('pages.job_allocation.direct_job_giving.edit', compact('direct_job_giving', 'employee', 'finishingProduct', 'product_size', 'product_color'));
    }




    public function update(Request $request, $id)
    {
        // dd($request);
        $validatedData = $request->validate([
            'employee_id' => 'required',
            'finishing_product_models_id' => 'required',
        ]);


        $direct_job_giving =  DirectJobGiving::find($id);
        $direct_job_giving->employee_id = $request->input('employee_id');
        $direct_job_giving->finishing_product_models_id = $request->input('finishing_product_models_id');
        $direct_job_giving->product_size_id = $request->input('product_size_id');
        $direct_job_giving->product_color_id = $request->input('product_color_id');
        $direct_job_giving->meter = $request->input('meter');
        $direct_job_giving->clothes_by_cutting = $request->input('clothes_by_cutting');
        $direct_job_giving->total_cutting_pieces = $request->input('total_cutting_pices');


        //  dd($direct_job_giving);

        $direct_job_giving->save();

        return redirect()->route('job_allocation.direct_job_giving.index')
            ->with('success', ' Direct Job Giving Updated successfully');
    }

    public function deleteSelected(Request $request)
    {

        $ids = $request->ids;

        if (!is_array($ids)) {
            return response()->json(['status' => 'error', 'message' => 'Invalid input'], 400);
        }

        DirectJobGiving::destroy($ids);
        return response()->json(['status' => 'success']);
    }

    public function destroy($id)
    {
        $direct_job_giving = DirectJobGiving::find($id);

        $direct_job_giving->delete();

        return redirect()->route('job_allocation.direct_job_giving.index')->with('success', 'Direct Job Giving Deleted successfully!');
    }

    public function export(Request $request)
    {
        return Excel::download(new DirectJobGivingExport($request->all()), 'DirectJobGivingDatas_' . date('d-m-Y') . '.xlsx');
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:xlsx,csv'
        ]);

        Excel::import(new DirectJobGivingImport, request()->file('file'));

        return redirect()->route('job_allocation.direct_job_giving.index')->with('success', 'Data imported successfully');
    }
}
