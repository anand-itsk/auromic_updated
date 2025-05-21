<?php

namespace App\Http\Controllers\PageControllers\JobAllocationController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\DirectJobGiving;
use App\Exports\DirectJobGivingExport;
use App\Imports\DirectJobGivingImport;
use App\Models\Company;
use App\Models\CompanyType;
use App\Models\Country;
use App\Models\ProductModel;
use App\Models\FinishingProductModel;
use App\Models\Product;
use App\Models\ProductSize;
use App\Models\ProductColor;
use App\Models\RawMaterial;
use App\Models\RawMaterialType;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\DataTables\DataTables;

class DirectJobGivingController extends Controller
{
    public function index()
    {

        $employee = Employee::all();
        $finishing_product = FinishingProductModel::all();
        $companyType = CompanyType::all();
        $company = Company::all();
        return view('pages.job_allocation.direct_job_giving.index',compact('employee', 'finishing_product', 'companyType', 'company'));
    }


    public function indexData(Request $request)
    {
        $employee_code = $request->input('employee_code');
        $employee_name = $request->input('employee_name');
        $fp_code = $request->input('fp_code');
        $fp_name = $request->input('fp_name');
        $fromDate = $request->input('from_date');
        $lastDate = $request->input('last_date');
        $dateFilter = $request->input('date_filter');

        $direct_job_giving = DirectJobGiving::with(['employee.company', 'finishingProduct', 'productSize', 'productColor']);

        // Filter by Date
        if ($dateFilter) {
            if ($dateFilter === 'today') {
                $direct_job_giving->whereDate('created_at', Carbon::today());
            } elseif ($dateFilter === 'this_month') {
                $direct_job_giving->whereMonth('created_at', Carbon::now()->month)
                    ->whereYear('created_at', Carbon::now()->year);
            } elseif ($dateFilter === 'last_month') {
                $direct_job_giving->whereMonth('created_at', Carbon::now()->subMonth()->month)
                    ->whereYear('created_at', Carbon::now()->subMonth()->year);
            }
        }

        // Filter by Employee Code
        if ($employee_code) {
            $direct_job_giving->whereHas('employee', function ($query) use ($employee_code) {
                $query->where('employee_code', $employee_code);
            });
        }

        // Filter by Employee Name
        if ($employee_name) {
            $direct_job_giving->whereHas('employee', function ($query) use ($employee_name) {
                $query->where('employee_name', 'like', '%' . $employee_name . '%');
            });
        }

        // Filter by Finishing Product Code
        if ($fp_code) {
            $direct_job_giving->whereHas('finishingProduct', function ($query) use ($fp_code) {
                $query->where('id', $fp_code);
            });
        }

        // Filter by Finishing Product Name
        if ($fp_name) {
            $direct_job_giving->whereHas('finishingProduct', function ($query) use ($fp_name) {
                $query->where('id', $fp_name); // Update the condition if needed
            });
        }


        // Filter by Date Range
        if ($request->filled('from_date') && $request->filled('last_date')) {
            $fromDate = Carbon::parse($request->input('from_date'))->startOfDay();
            $lastDate = Carbon::parse($request->input('last_date'))->endOfDay();

            $direct_job_giving->whereBetween('created_at', [$fromDate, $lastDate]);
        }


        return DataTables::of($direct_job_giving->get())
            ->addColumn('company_name', function ($row) {
                return $row->employee && $row->employee->company ? $row->employee->company->company_name : '-';
            })
            ->make(true);
    }

    public function create()
    {

        $employee = Employee::with(['company' => function ($query) {
            $query->with('companyType');
        }])->get();
        $finishingProduct = FinishingProductModel::all();
        $product_size = ProductSize::get();
        $product_color = ProductColor::get();
        $raw_material = RawMaterial::all();
        $raw_material_type = RawMaterialType::get();
        $products = Product::all();
        $countries = Country::all();
        return view('pages.job_allocation.direct_job_giving.create', compact('employee', 'finishingProduct', 'product_size', 'product_color', 'raw_material', 'raw_material_type', 'products','countries'));
    }


    public function getFinishingProductDetails($id)
    {
        $finishingProduct = FinishingProductModel::findOrFail($id);
// dd('dsds');
        return response()->json([

            'product_name' => $finishingProduct->product->name,
            'product_size' => $finishingProduct->productSize->code,
            'product_size_id' => $finishingProduct->productSize->id,
            'meters_one_product' => $finishingProduct->meters_one_product,
            'cutting_charge'=> $finishingProduct->cutting_charge,

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
