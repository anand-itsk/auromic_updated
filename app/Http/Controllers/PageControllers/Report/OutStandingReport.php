<?php

namespace App\Http\Controllers\PageControllers\Report;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Employee;
use App\Models\JobGiving;
use App\Models\OrderNo;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class OutStandingReport extends Controller
{
    public function index()
    {
        $employee = Employee::all();
    
        $masterCompany = Company::where('company_type_id', 2)->get();
        $clientCompany = Company::where('company_type_id', 3)->get();
        $subClientCompany = Company::where('company_type_id', 4)->get();


        return view('pages.report.outstanding_report',compact('employee','masterCompany', 'clientCompany', 'subClientCompany'));
    }


    public function indexData(Request $request)
    {
        $query = JobGiving::with('jobReceived', 'employee.villageAddressTypeThree', 'product_model', 'order_details.orderNo');

        // Date Filter Logic
        if ($request->filled('date_filter')) {
            if ($request->date_filter === 'today') {
                $query->whereDate('created_at', Carbon::today());
            } elseif ($request->date_filter === 'this_month') {
                $query->whereMonth('created_at', Carbon::now()->month)
                    ->whereYear('created_at', Carbon::now()->year);
            } elseif ($request->date_filter === 'last_month') {
                $query->whereMonth('created_at', Carbon::now()->subMonth()->month)
                    ->whereYear('created_at', Carbon::now()->subMonth()->year);
            }
        }

        // From Date and To Date Logic
        if ($request->filled('from_date') && $request->filled('last_date')) {
            $fromDate = Carbon::parse($request->from_date)->startOfDay();
            $lastDate = Carbon::parse($request->last_date)->endOfDay();

            $query->whereBetween('created_at', [$fromDate, $lastDate]);
        }

        // Other Filters (Example)
        if ($request->filled('employee')) {
            $query->where('employee_id', $request->employee);
        }

        // Continue to add other conditions as needed

        return DataTables::of($query)
           
            ->addColumn('company_name', function ($row) {
                return $row->employee->company->company_name ?? null;
            })
            ->addColumn('employee_code', function ($row) {
                return $row->employee->employee_code;
            })
            ->addColumn('employee_name', function ($row) {
                return $row->employee->employee_name;
            })
            ->addColumn('order_no', function ($row) {
                return $row->order_details->orderNo->last_order_number;
            })
            ->addColumn('model_name', function ($row) {
                return $row->product_model->model_name;
            })
            ->addColumn('size', function ($row) {
                return $row->product_model->productSize->name;
            })
            ->addColumn('color', function ($row) {
                return $row->order_details->productColor->name;
            })
            ->addColumn('given_qty', function ($row) {
                return $row->quantity;
            })
            ->addColumn('given_date', function ($row) {
                return $row->created_at->format('d/m/Y');
            })
            ->addColumn('received_qty', function ($row) {
                return $row->jobReceived ? $row->jobReceived->complete_quantity : 0;
            })
            ->addColumn('pending_qty', function ($row) {
                $givenQty = $row->quantity;
                $receivedQty = $row->jobReceived ? $row->jobReceived->complete_quantity : 0;
                return $givenQty - $receivedQty;
            })
            ->addColumn('received_date', function ($row) {
                return $row->jobReceived ? $row->jobReceived->receving_date : '-';
            })
            ->addColumn('deducation_fee', function ($row) {
                return $row->jobReceived ? $row->jobReceived->deducation_fee : '-';
            })
            ->addColumn('conveyance_fee', function ($row) {
                return $row->jobReceived ? $row->jobReceived->conveyance_fee : '-';
            })
            ->addColumn('incentive_fee', function ($row) {
                return $row->jobReceived ? $row->jobReceived->incentive_fee : '-';
            })
            ->addColumn('current_weight', function ($row) {
                return $row->jobReceived ? $row->jobReceived->current_weight : '-';
            })
            ->addColumn('village', function ($row) {
                return $row->employee->villageAddressTypeThree
                    ? $row->employee->villageAddressTypeThree->village_area
                    : '-';
            })
            ->rawColumns(['employee_code', 'employee_name', 'order_no', 'model_name', 'size', 'color', 'given_qty', 'given_date', 'received_qty', 'pending_qty', 'village', 'received_date', 'deducation_fee', 'conveyance_fee', 'incentive_fee', 'current_weight'])
            ->make(true);
    }




}
