<?php

namespace App\Http\Controllers\PageControllers\Report;

use App\Http\Controllers\Controller;
use App\Models\JobGiving;
use App\Models\CompanyType;
use App\Models\Company;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Maatwebsite\Excel\Facades\Excel;

class DailyGivenReportCompanyWiseController extends Controller
{
    public function index()
    {
          $companyType = CompanyType::all();
        $company = Company::all();
        return view ('pages.report.daily_given_report_cw',compact('companyType','company'));
    }

public function indexData(Request $request)
{
    $companyType = $request->input('company_type');
     $company = $request->input('companies');
      $status = $request->input('status');
      $fromDate = $request->input('from_date');
    $lastDate = $request->input('last_date');
    
    // Retrieve JobGiving data with eager loading
    $jobGivingQuery = JobGiving::with('employee', 'order_details', 'delivery_chellan', 'product_model.productSize');

    // Apply company type filter if selected
    if ($companyType) {
        $jobGivingQuery->whereHas('delivery_chellan.company', function ($q) use ($companyType) {
            $q->where('company_type_id', $companyType);
        });
    }

    if ($company) {
    // Convert $company to an array if it's not already one
    $companies = is_array($company) ? $company : [$company];
    $query->whereIn('company_id', $companies);
}

if ($status) {
        $jobGivingQuery->where('status', $status);
    }

    if ($fromDate && $lastDate) {
        $jobGivingQuery->whereBetween('created_at', [$fromDate, $lastDate]);
    }

    // Retrieve JobGiving data
    $jobGivingData = $jobGivingQuery->get();

    // Prepare data for DataTables
    $data = $jobGivingData->map(function ($job_giving) {
        return [
            'id' => $job_giving->id,
            'employee_code' => $job_giving->employee->employee_code ?? null,
            'employee_name' => $job_giving->employee->employee_name ?? null,
            'last_order_number' => $job_giving->order_details->orderNo->last_order_number ?? null,
            'model_code' => $job_giving->product_model->model_code ?? null,
            'model_name' => $job_giving->product_model->model_name ?? null,
            'size' => $job_giving->product_model->productSize->name ?? null,
            'color' => $job_giving->order_details->productColor->name ?? null,
            'quantity' => $job_giving->quantity,
            'weight' => $job_giving->weight,
        ];
    });

    // Return data for DataTables
    return DataTables::of($data)->make(true);
}
}
