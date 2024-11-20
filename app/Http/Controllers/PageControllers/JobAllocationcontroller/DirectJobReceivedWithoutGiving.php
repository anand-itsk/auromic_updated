<?php

namespace App\Http\Controllers\PageControllers\JobAllocationController;

use App\Http\Controllers\Controller;
use App\Models\DirectJobReceivedWithoutGiven;
use App\Models\DirectWithoutGiven;
use App\Models\Employee;
use App\Models\FinishingProductModel;
use App\Models\ProductColor;
use App\Models\ProductSize;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class DirectJobReceivedWithoutGiving extends Controller
{
     

    public function index()
    {
        return view('pages.job_allocation.direct_job_received_without_giving.index');
    }
    public function indexData()
    {
        $direct_job_without_giving = DirectWithoutGiven::with(['employee', 'finishingProduct'])->get();

        return DataTables::of($direct_job_without_giving)
            ->addColumn('employee_code', function ($row) {
                return $row->employee ? $row->employee->employee_code : '-';
            })
            ->addColumn('employee_name', function ($row) {
                return $row->employee ? $row->employee->employee_name : '-';
            })
            ->addColumn('model_code', function ($row) {
                return $row->finishingProduct ? $row->finishingProduct->model_code : '-';
            })
            ->addColumn('model_name', function ($row) {
                return $row->finishingProduct ? $row->finishingProduct->model_name : '-';
            })
            ->addColumn('meter', function ($row) {
                return $row->finishingProduct ? $row->finishingProduct->meters_one_product : '-';
            })
            ->addColumn('wages', function ($row) {
                return $row->finishingProduct ? $row->finishingProduct->wages_one_product : '-';
            })
            ->addColumn('product_size', function ($row) {
                return $row->finishingProduct ? $row->finishingProduct->product_size_id : '-';
            })
            ->addColumn('received_quantity', function ($row) {
                return $row->finishingProduct ? $row->received_quantity : '-';
            })
            ->addColumn('receving_date', function ($row) {
                return $row->receving_date ? \Carbon\Carbon::parse($row->receving_date)->format('d/m/Y') : '-';
            })

            ->make(true);
    }


    public function create()
    {

        $employee = Employee::with(['company' => function ($query) {
            $query->with('companyType');
        }])
            ->whereHas('company.companyType', function ($query) {
                $query->where('id', 2); // Adjust 'id' if your column name is different
            })
            ->get();
// dd($employee);
        $finishingProduct = FinishingProductModel::all();
   
        return view('pages.job_allocation.direct_job_received_without_giving.create', compact('employee', 'finishingProduct'));
    }

    public function getFinishingProductDetails($id)
    {
        $finishingProduct = FinishingProductModel::findOrFail($id);

        return response()->json([

            'product_name' => $finishingProduct->product->name,
            'product_size' => $finishingProduct->productSize->code,
            'product_size_id' => $finishingProduct->productSize->id,
            'meters_one_product' => $finishingProduct->meters_one_product,

        ]);
    }

    public function store(Request $request)
    {
        // dd($request);
        $validatedData = $request->validate([
            'employee_id' => 'required',
            'finishing_product_models_id' => 'required',
        ]);

        $direct_job_without_giving = new DirectWithoutGiven;
        $direct_job_without_giving->employee_id = $request->input('employee_id');
        $direct_job_without_giving->finishing_product_models_id = $request->input('finishing_product_models_id');
        $direct_job_without_giving->received_quantity = $request->input('received_quantity');
        $direct_job_without_giving->receving_date = $request->input('receving_date');


        //  dd($direct_job_giving); 

        $direct_job_without_giving->save();


        return redirect()->route('job_allocation.direct_job_wc_giving.index')
            ->with('success', ' Direct Job Received Without Giving created successfully');
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
       
        return view("pages.job_allocation.direct_job_received_without_giving.edit", compact('direct_job_without_giving', 'employee', 'finishingProduct'));
    }


}
