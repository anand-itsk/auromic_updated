<?php

namespace App\Http\Controllers\PageControllers\Report;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\JobReceived;
use App\Models\JobGiving;
use App\Models\CompanyType;
use App\Models\Company;
use Yajra\DataTables\DataTables;
use Maatwebsite\Excel\Facades\Excel;

class JobReceivedReportController extends Controller
{
     public function index()
    {
        $companyType = CompanyType::all();
        $company = Company::all();
        
        return view('pages.report.job_received_report', compact('companyType', 'company'));
    }

public function indexData(Request $request)
{
    $status = $request->input('status');

    // Retrieve JobReceived data with eager loading
    $jobReceivedData = JobReceived::with(['jobGiving.employee', 'jobGiving.deliveryChellan.company']);

    // Apply status filter if provided
    if ($status) {
        $jobReceivedData->where('status', $status);
    }

    // Get the filtered data
    $jobReceivedData = $jobReceivedData->get();

    // Prepare data for DataTables
    $data = $jobReceivedData->map(function ($job_received) {
        return [
            'id' => $job_received->id,
            'company_code' => $job_received->jobGiving->deliveryChellan->company->company_code ?? null,
            'employee_name' => $job_received->jobGiving->employee->employee_name ?? null,
            'incentive_applicable' => $job_received->incentive_applicable,
            'conveyance_fee' => $job_received->conveyance_fee,
            'deducation_fee' => $job_received->deducation_fee,
            'incentive_fee' => $job_received->incentive_fee,
            'total_amount' => $job_received->total_amount,
            'net_amount' => $job_received->net_amount,
            'status' => $job_received->status,
        ];
    });

    // Convert the collection to an array
    $dataArray = $data->toArray();

    // Return data for DataTables
    return DataTables::of($dataArray)->make(true);
}
}
