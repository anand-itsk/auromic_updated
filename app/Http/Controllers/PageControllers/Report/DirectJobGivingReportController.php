<?php

namespace App\Http\Controllers\PageControllers\Report;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DirectJobGiving;
use App\Models\Employee;
use App\Models\FinishingProductModel;
use Yajra\DataTables\DataTables;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\DirectJobReportExport;

class DirectJobGivingReportController extends Controller
{
       public function index()
    {
        $employee = Employee::all();
        $finishing_product = FinishingProductModel::all();
        return view('pages.report.direct_job_given_report', compact('employee','finishing_product'));
    }
public function indexData(Request $request)
{
    $employeeId = $request->input('employee_id');
    $finishing_product = $request->input('finishing_product_model_id');

    $direct_job_giving = DirectJobGiving::with(['employee', 'finishingProduct', 'productSize', 'productColor']);

    if ($employeeId) {
        $direct_job_giving->where('employee_id', $employeeId);
    }

    if ($finishing_product) {
        $direct_job_giving->where('finishing_product_models_id', $finishing_product);
    }

    return DataTables::of($direct_job_giving->get())->make(true);
}

 public function export(Request $request)
    {
        return Excel::download(new DirectJobReportExport($request->all()), 'DirectJobReportDatas_' . date('d-m-Y') . '.xlsx');
    }
}
