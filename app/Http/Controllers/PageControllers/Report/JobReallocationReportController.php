<?php

namespace App\Http\Controllers\PageControllers\Report;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\CompanyType;
use App\Models\Employee;
use App\Models\JobAllocationHistory;
use App\Models\OrderNo;
use App\Models\Product;
use Carbon\Carbon;
use Yajra\DataTables\DataTables;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;

class JobReallocationReportController extends Controller
{
    public function index()
    {
        $employee = Employee::all();
        $order_nos = OrderNo::all();
        $product = Product::all();


        return view('pages.report.job_reallocation_report', compact('employee', 'order_nos', 'product'));
    }
    public function indexData(Request $request)
    {
        // Start the query with JobAllocationHistory and join necessary relationships
        $query = JobAllocationHistory::with(['jobGiving.employee', 'jobGiving.order_details', 'jobGiving.product_model']);

        $orderNoId = $request->input('orderNoId');  // Retrieve order_id from request
        $productId = $request->input('product');   // Retrieve product_id from request
        $fromDate = $request->input('from_date');
        $lastDate = $request->input('last_date');
        $dateFilter = $request->input('date_filter');


        if ($dateFilter) {
            if ($dateFilter === 'today') {
                $query->whereDate('created_at', Carbon::today());
            } elseif ($dateFilter === 'this_month') {
                $query->whereMonth('created_at', Carbon::now()->month)
                    ->whereYear('created_at', Carbon::now()->year);
            } elseif ($dateFilter === 'last_month') {
                $query->whereMonth('created_at', Carbon::now()->subMonth()->month)
                    ->whereYear('created_at', Carbon::now()->subMonth()->year);
            }
        }
        if ($fromDate && $lastDate) {
            $query->whereBetween('receving_date', [$fromDate, $lastDate]);
        }
        // Apply filter for employee
        if ($request->employee) {
            $query->whereHas('jobGiving.employee', function ($q) use ($request) {
                $q->where('id', $request->employee); // Assuming 'id' is the employee ID
            });
        }

        // Apply filter for received_date
        if ($request->received_date) {
            $query->whereDate('receving_date', $request->received_date);
        }

        // Apply filter for order number (order_id)
        if ($orderNoId) {
            $query->whereHas('jobGiving.order_details', function ($q) use ($orderNoId) {
                $q->where('order_id', $orderNoId);
            });
        }

        // Apply filter for product
        if ($productId) {
            $query->whereHas('jobGiving.product_model', function ($q) use ($productId) {
                $q->where('product_id', $productId);
            });
        }


        // Get the filtered data
        $jobReallocationReport = $query->get();


        // Prepare data for DataTables
        $data = $jobReallocationReport->map(function ($job_received) {
            return [
                'id' => $job_received->id,
                'company_name' => $job_received->jobGiving->employee->company->company_name ?? null,
                'employee_code' => $job_received->jobGiving->employee->employee_code ?? null,
                'employee_name' => $job_received->jobGiving->employee->employee_name ?? null,
                'model_name' => $job_received->jobGiving->product_model->model_name,
                'size' => $job_received->jobGiving->product_model->productSize->code,
                'color' => $job_received->jobGiving->order_details->productColor->name,
                // 'received_qty' => $job_received->complete_quantity,

                // 'given_date' => $job_received->jobGiving->created_at->format('d/m/Y') ?? null,
                'given_qty' => $job_received->quantity,
                'total_amount' => $job_received->jobReceived->total_amount,
                'receving_date' => $job_received->receving_date,
                'incentive_fee' => $job_received->incentive_fee,
            ];
        });

        // Convert the collection to an array
        $dataArray = $data->toArray();

        // Return data for DataTables
        return DataTables::of($dataArray)->make(true);
    }
}
