<?php

namespace App\Http\Controllers\PageControllers\Report;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\CompanyType;
use App\Models\Employee;
use App\Models\JobAllocationHistory;
use App\Models\OrderNo;
use App\Models\Product;
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

        // Return filtered data to DataTables
        return DataTables::of($query)
            ->addColumn('job_giving_name', function ($row) {
                return $row->jobGiving ? $row->jobGiving->product_model->name : '-';
            })
            ->addColumn('employee_name', function ($row) {
                return $row->jobGiving && $row->jobGiving->employee ? $row->jobGiving->employee->employee_name : '-';
            })
            ->make(true);
    }




}
