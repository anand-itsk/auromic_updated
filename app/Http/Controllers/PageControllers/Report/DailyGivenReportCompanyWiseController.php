<?php

namespace App\Http\Controllers\PageControllers\Report;

use App\Http\Controllers\Controller;
use App\Models\JobGiving;
use App\Models\CompanyType;
use App\Models\Company;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\JobGivingReportExport;
use App\Models\OrderNo;
use App\Models\Product;

class DailyGivenReportCompanyWiseController extends Controller
{
    public function index()
    {
        $companyType = CompanyType::all();
        $company = Company::all();
        $order_nos = OrderNo::all();
        $product = Product::all();  
        return view('pages.report.job_given_report', compact('companyType', 'company', 'order_nos', 'product'));
    }

        public function indexData(Request $request)
        {
            $companyType = $request->input('company_type');
            $company = $request->input('companies');
            $status = $request->input('status');
            $fromDate = $request->input('from_date');
            $lastDate = $request->input('last_date');
        $orderNoId = $request->input('orderNoId');
        $product = $request->input('product'); 

            // Retrieve JobGiving data with eager loading
            $jobGivingQuery = JobGiving::with('employee', 'order_details', 'deliveryChellan', 'product_model.productSize');

            // Apply company type filter if selected
            if ($companyType) {
                $jobGivingQuery->whereHas('deliveryChellan.company', function ($q) use ($companyType) {
                    $q->where('company_type_id', $companyType);
                });
            }

            if ($company) {
                // Convert $company to an array if it's not already one
                $companies = is_array($company) ? $company : [$company];
                $jobGivingQuery->whereHas('deliveryChellan.company', function ($q) use ($companies) {
                    $q->whereIn('company_id', $companies);
                });
            }

            if ($status) {
                $jobGivingQuery->where('status', $status);
            }

            if ($fromDate && $lastDate) {
                $jobGivingQuery->whereBetween('created_at', [$fromDate, $lastDate]);
            }

        if ($orderNoId) {
            $jobGivingQuery->whereHas('order_details', function ($q) use ($orderNoId) {
                $q->where('order_no_id', $orderNoId);
            });
        }

        if ($product) {
            $jobGivingQuery->whereHas('product_model', function ($q) use ($product) {
                $q->where('product_id', $product);
            });
        }

            // Retrieve JobGiving data
            $jobGivingData = $jobGivingQuery->get();

            // Prepare data for DataTables
            $data = $jobGivingData->map(function ($job_giving) {
                return [
                    'id' => $job_giving->id,
                    'employee_code' => $job_giving->employee->employee_code ?? null,
                    'employee_name' => $job_giving->employee->employee_name ?? null,
                    'customer_order_no' => $job_giving->order_details->orderNo->customer_order_no ?? null,
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

        public function export(Request $request)
    {
        return Excel::download(new JobGivingReportExport($request->all()), 'JobgivingReportDatas_' . date('d-m-Y') . '.xlsx');
    }

}
