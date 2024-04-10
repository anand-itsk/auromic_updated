<?php

namespace App\Http\Controllers\PageControllers\Report;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DirectJobGiving;
use App\Models\DirectJobReceived;
use App\Models\Employee;
use App\Models\FinishingProductModel;
use Yajra\DataTables\DataTables;
use Maatwebsite\Excel\Facades\Excel;

class DirectJobReceivedReportController extends Controller
{
       public function index()
    {
        $employee = Employee::all();
        $finishing_product = FinishingProductModel::all();
        return view('pages.report.direct_job_received_report', compact('employee','finishing_product'));
    }

    public function indexData(Request $request)
{
    $employeeId = $request->input('employee_id');
    $finishing_product = $request->input('finishing_product_model_id');
    $incentive_status = $request->input('incentive_status');
    $received_date = $request->input('received_date');

    $direct_job_received = DirectJobReceived::with(['employee', 'directJobGiven','finishingProduct', 'productColor']);

    if ($employeeId) {
        $direct_job_received->where('employee_id', $employeeId);
    }

    if ($finishing_product) {
        $direct_job_received->where('finishing_product_models_id', $finishing_product);
    }
 if ($incentive_status) {
        $direct_job_received->where('incentive_applicable', $incentive_status);
    }

    if ($received_date) {
        $direct_job_received->where('receving_date', $received_date);
    }


    
    return DataTables::of($direct_job_received->get())->make(true);
}

}
