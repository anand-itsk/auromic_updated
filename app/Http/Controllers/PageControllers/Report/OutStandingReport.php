<?php

namespace App\Http\Controllers\PageControllers\Report;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Employee;
use App\Models\JobGiving;
use App\Models\OrderNo;
use App\Models\Product;
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
        $query = JobGiving::with('jobReceived', 'employee', 'product_model', 'order_details.orderNo')
            ->when($request->employee, function ($query, $employee) {
                return $query->where('employee_id', $employee);
            })
            ->when($request->master_company, function ($query, $masterCompany) {
                // Filter by the 'company_id' from the related 'employee' table
                return $query->whereHas('employee', function ($q) use ($masterCompany) {
                    $q->where('company_id', $masterCompany);
                });
            })
            ->when($request->client_company, function ($query, $clientCompany) {
            // return $query->where('company_id', $clientCompany);
            return $query->whereHas('employee', function ($q) use ($clientCompany) {
                $q->where('company_id', $clientCompany);
            });
            })
            ->when($request->sub_client_company, function ($query, $subClientCompany) {
                // return $query->where('company_id', $subClientCompany);
            return $query->whereHas('employee', function ($q) use ($subClientCompany) {
                $q->where('company_id', $subClientCompany);
            });
            })
            ->when($request->received_date, function ($query, $receivedDate) {
                return $query->whereHas('jobReceived', function ($q) use ($receivedDate) {
                    $q->whereDate('receving_date', $receivedDate);
                });
            })
            ->get();
            // dd($query->get());

        return DataTables::of($query)
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
                return $row->jobReceived ? $row->jobReceived->complete_quantity : '-';
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
            ->rawColumns(['employee_code', 'employee_name', 'order_no', 'model_name', 'size', 'color', 'given_qty', 'given_date', 'received_qty', 'received_date', 'deducation_fee', 'conveyance_fee', 'incentive_fee', 'current_weight'])
            ->make(true);
    }




}
