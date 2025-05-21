<?php

namespace App\Http\Controllers\PageControllers\JobAllocationController;

use App\Http\Controllers\Controller;
use App\Models\DirectJobReceivedWithoutGiven;
use App\Models\DirectWithoutGiven;
use App\Models\Employee;
use App\Models\FinishingProductModel;
use App\Models\ProductColor;
use App\Models\ProductSize;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class DirectJobReceivedWithoutGiving extends Controller
{
     

    public function index()
    {
        $employee = Employee::with(['company' => function ($query) {
            $query->with('companyType');
        }])
            ->where('own_company', 'yes')
            ->get();

        $finishing_product = FinishingProductModel::all();
        return view('pages.job_allocation.direct_job_received_without_giving.index',compact('employee', 'finishing_product'));
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
        $received_date = $request->input('received_date');

        $query = DirectWithoutGiven::with([
            'employee',
            'finishingProduct.productSize',
        ]);

        // Filter by Date Filter
        $dateFilter = $request->input('date_filter');
        if ($dateFilter) {
            switch ($dateFilter) {
                case 'today':
                    $query->whereDate('created_at', Carbon::today());
                    break;
                case 'this_month':
                    $query->whereMonth('created_at', Carbon::now()->month)
                        ->whereYear('created_at', Carbon::now()->year);
                    break;
                case 'last_month':
                    $query->whereMonth('created_at', Carbon::now()->subMonth()->month)
                        ->whereYear('created_at', Carbon::now()->subMonth()->year);
                    break;
            }
        }

        // Filter by Employee Code
        if ($request->filled('employee_code')) {
            $query->whereHas('employee', function ($subQuery) use ($request) {
                $subQuery->where('id', $request->employee_code);
            });
        }

        // Filter by Employee Name
        if ($request->filled('employee_name')) {
            $query->whereHas('employee', function ($subQuery) use ($request) {
                $subQuery->where('id', 'like', '%' . $request->employee_name . '%');
            });
        }

        // Filter by Finishing Product Code
        if ($request->filled('fp_code')) {
            $query->whereHas('finishingProduct', function ($subQuery) use ($request) {
                $subQuery->where('id', $request->fp_code);
            });
        }

        // Filter by Finishing Product Name (if needed)
        if ($request->filled('fp_name')) {
            $query->whereHas('finishingProduct', function ($subQuery) use ($request) {
                $subQuery->where('model_name', 'like', '%' . $request->fp_name . '%');
            });
        }

        // Filter by Date Range
        if ($request->filled(['from_date', 'last_date'])) {
            $fromDate = Carbon::parse($request->from_date)->startOfDay();
            $lastDate = Carbon::parse($request->last_date)->endOfDay();
            $query->whereBetween('created_at', [$fromDate, $lastDate]);
        }

        // Filter by Received Date
        if ($request->filled('received_date')) {
            $query->where('receving_date', $request->received_date);
        }

        return DataTables::of($query)
            ->addColumn('employee_code', fn($row) => $row->employee->employee_code ?? '-')
            ->addColumn('employee_name', fn($row) => $row->employee->employee_name ?? '-')
            ->addColumn('model_code', fn($row) => $row->finishingProduct->model_code ?? '-')
            ->addColumn('model_name', fn($row) => $row->finishingProduct->model_name ?? '-')
            ->addColumn('meter', fn($row) => $row->finishingProduct->meters_one_product ?? '-')
            ->addColumn('wages', fn($row) => $row->finishingProduct->wages_one_product ?? '-')
            ->addColumn('product_size', fn($row) => $row->finishingProduct->productSize->code ?? '-')
            ->addColumn('received_quantity', fn($row) => $row->received_quantity ?? '-')
            ->addColumn('receving_date', fn($row) => $row->receving_date
                ? Carbon::parse($row->receving_date)->format('d/m/Y')
                : '-')
            ->make(true);
    }

    public function create()
    {
        $employee = Employee::with(['company' => function ($query) {
            $query->with('companyType');
        }])
            ->where('own_company', 'yes')
            ->get();

// dd($employee);
        $finishingProduct = FinishingProductModel::all();
         $product_color = ProductColor::all();
        return view('pages.job_allocation.direct_job_received_without_giving.create', compact('employee', 'finishingProduct', 'product_color'));
    }

    public function getFinishingProductDetails($id)
    {
        $finishingProduct = FinishingProductModel::findOrFail($id);

        // dd($finishingProduct);

        return response()->json([

            'product_name' => $finishingProduct->product->name,
            'product_size' => $finishingProduct->productSize->code,
            'product_size_id' => $finishingProduct->productSize->id,
            'meters_one_product' => $finishingProduct->meters_one_product,
            'wages_one_product' => $finishingProduct->wages_one_product
        ]);  
    }


    public function store(Request $request)
    {
        // dd($request);
        // Validate the required fields
        $validatedData = $request->validate([
            'employee_id' => 'required',
            'finishing_product_models_id' => 'required',
            'product_color_id' => 'nullable',
            'received_quantity' => 'nullable|numeric',
            'receving_date' => 'nullable|date',
            'before_days' => 'nullable|numeric',
            'after_days' => 'nullable|numeric',
            'conveyance' => 'nullable|numeric',
            'deduction' => 'nullable|numeric',
            'incentive' => 'nullable|numeric',
            'total_amount' => 'nullable|numeric',
            'net_amount' => 'nullable|numeric',
        ]);

        // Create a new instance of the model
        $direct_job_without_giving = new DirectWithoutGiven;

        // Assign validated inputs to the model
        $direct_job_without_giving->employee_id = $request->input('employee_id');
        $direct_job_without_giving->finishing_product_models_id = $request->input('finishing_product_models_id');
        $direct_job_without_giving->product_color_id = $request->input('product_color_id');
        $direct_job_without_giving->received_quantity = $request->input('received_quantity');
        $direct_job_without_giving->receving_date = $request->input('receving_date');
        $direct_job_without_giving->before_days = $request->input('before_days'); // Default to null if not provided
        $direct_job_without_giving->after_days = $request->input('after_days');
        $direct_job_without_giving->conveyance_fee = $request->input('conveyance', 0); // Default to 0 if not provided
        $direct_job_without_giving->deducation_fee = $request->input('deduction', 0);
        $direct_job_without_giving->incentive_fee = $request->input('incentive', 0);
        $direct_job_without_giving->total_amount = $request->input('total_amount', 0);
        $direct_job_without_giving->net_amount = $request->input('net_amount', 0);

        // Save the model to the database
        $direct_job_without_giving->save();

        // Redirect with success message
        return redirect()->route('job_allocation.direct_job_wc_giving.index')
        ->with('success', 'Direct Job Received Without Giving created successfully');
    }


    public function edit($id)
    {

        $direct_job_without_giving = DirectWithoutGiven::with('finishingProduct.productSize')->find($id);
        $employee = Employee::with(['company' => function ($query) {
            $query->with('companyType');
        }])
            ->whereHas('company.companyType', function ($query) {
                $query->where('id', 2); // Adjust 'id' if your column name is different
            })
            ->get();

        $finishingProduct = FinishingProductModel::all();
        $product_color = ProductColor::all();
       
        return view("pages.job_allocation.direct_job_received_without_giving.edit", compact('direct_job_without_giving', 'employee', 'finishingProduct', 'product_color'));
    }

    public function update(Request $request, $id)
    {
        // dd($request);
        $validatedData = $request->validate([
            'employee_id' => 'required',
            'finishing_product_models_id' => 'required',
        ]);


        $direct_job_without_giving =  DirectWithoutGiven::find($id);
        $direct_job_without_giving->employee_id = $request->input('employee_id');
        $direct_job_without_giving->product_color_id = $request->input('product_color_id');
        $direct_job_without_giving->finishing_product_models_id = $request->input('finishing_product_models_id');
        $direct_job_without_giving->received_quantity = $request->input('received_quantity');
        $direct_job_without_giving->receving_date = $request->input('receving_date');
        $direct_job_without_giving->before_days = $request->input('before_days'); // Default to null if not provided
        $direct_job_without_giving->after_days = $request->input('after_days');
        $direct_job_without_giving->conveyance_fee = $request->input('conveyance', 0); // Default to 0 if not provided
        $direct_job_without_giving->deducation_fee = $request->input('deduction', 0);
        $direct_job_without_giving->incentive_fee = $request->input('incentive', 0);
        $direct_job_without_giving->total_amount = $request->input('total_amount', 0);
        $direct_job_without_giving->net_amount = $request->input('net_amount', 0);

        //  dd($direct_job_giving);

        $direct_job_without_giving->save();

        return redirect()->route('job_allocation.direct_job_wc_giving.index')
        ->with('success', ' Direct Job Giving Updated successfully');
    }

    public function deleteSelected(Request $request)
    {

        $ids = $request->ids;

        if (!is_array($ids)) {
            return response()->json(['status' => 'error', 'message' => 'Invalid input'], 400);
        }

        DirectWithoutGiven::destroy($ids);
        return response()->json(['status' => 'success']);
    }

    public function destroy($id)
    {
        $direct_job_without_giving = DirectWithoutGiven::find($id);

        $direct_job_without_giving->delete();

        return redirect()->route('job_allocation.direct_job_wc_giving.index')->with('success', 'Direct Job Giving Deleted successfully!');
    }

    // public function export(Request $request)
    // {
    //     return Excel::download(new DirectJobGivingExport($request->all()), 'DirectJobGivingDatas_' . date('d-m-Y') . '.xlsx');
    // }

    // public function import(Request $request)
    // {
    //     $request->validate([
    //         'file' => 'required|file|mimes:xlsx,csv'
    //     ]);

    //     Excel::import(new DirectJobGivingImport, request()->file('file'));

    //     return redirect()->route('job_allocation.direct_job_giving.index')->with('success', 'Data imported successfully');
    // }


}
