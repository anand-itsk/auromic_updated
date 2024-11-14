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
use App\Exports\JobReceivedReportExport;
use App\Models\OrderNo;
use App\Models\Product;

class JobReceivedReportController extends Controller
{
     public function index()
    {
        $companyType = CompanyType::all();
        $company = Company::all();
        $order_nos = OrderNo::all();
        $product = Product::all(); 
        
        return view('pages.report.job_received_report', compact('companyType', 'company', 'order_nos', 'product'));
    }

public function indexData(Request $request)
{
    
    $status = $request->input('status');
    $companyType = $request->input('company_type');
    $company = $request->input('companies');
    $incentiveStatus = $request->input('incentive_status');
    $received_date = $request->input('received_date');
        $orderNoId = $request->input('orderNoId');
        $product = $request->input('product'); 


    // Retrieve JobReceived data with eager loading
    $jobReceivedData = JobReceived::with(['jobGiving.employee', 'jobGiving.deliveryChellan.company','jobGiving.product_model','jobGiving.order_details']);

 if ($companyType) {
            $jobReceivedData->whereHas('jobGiving.deliveryChellan.company', function ($q) use ($companyType) {
                $q->where('company_type_id', $companyType);
            });
        }

        if ($company) {
            // Convert $company to an array if it's not already one
            $companies = is_array($company) ? $company : [$company];
            $jobReceivedData->whereHas('jobGiving.deliveryChellan.company', function ($q) use ($companies) {
                $q->whereIn('company_id', $companies);
            });
        }


    // Apply status filter if provided
    if ($status) {
        $jobReceivedData->where('status', $status);
    }

    if ($incentiveStatus) {
        $jobReceivedData->where('incentive_applicable', $incentiveStatus);
    }

    if ($received_date) {
        $jobReceivedData->where('receving_date', $received_date);
    }

        if ($orderNoId) {
            $jobReceivedData->whereHas('jobGiving.order_details', function ($q) use ($orderNoId) {
                $q->where('order_id', $orderNoId);
            });
        }

        // Apply product filter
        if ($product) {
            $jobReceivedData->whereHas('jobGiving.product_model', function ($q) use ($product) {
                $q->where('product_id', $product);
            });
        }


    // Get the filtered data
    $jobReceivedData = $jobReceivedData->get();

   

    // Prepare data for DataTables
    $data = $jobReceivedData->map(function ($job_received) {
         $villageAddress = $job_received->jobGiving->employee->addresses()
    ->where('address_type_id', 4)
    ->first();
        return [
            'id' => $job_received->id,
            'employee_code' => $job_received->jobGiving->employee->employee_code ?? null,
            'employee_name' => $job_received->jobGiving->employee->employee_name ?? null,
            'model_name' => $job_received->jobGiving->product_model->model_name,
            'size' => $job_received->jobGiving->product_model->productSize->code,
            'color' => $job_received->jobGiving->order_details->productColor->name,
            'received_qty' => $job_received->complete_quantity,
            'incentive_fee' => $job_received->incentive_fee,
            'total_amount' => $job_received->total_amount,
            'deducation_fee' => $job_received->deducation_fee,
            'conveyance_fee' => $job_received->conveyance_fee,
            'incentive_fee' => $job_received->incentive_fee,
           'villageArea' =>$villageAddress ? $villageAddress->village_area : null,
            'current_weight' => $job_received->current_weight,
        ];
    });

    // Convert the collection to an array
    $dataArray = $data->toArray();

    // Return data for DataTables
    return DataTables::of($dataArray)->make(true);
}


        public function export(Request $request)
    {
        return Excel::download(new JobReceivedReportExport($request->all()), 'JobReceivedReportDatas_' . date('d-m-Y') . '.xlsx');
    }

}
