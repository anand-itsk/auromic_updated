<?php

namespace App\Http\Controllers\PageControllers\Report;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Employee;
use App\Models\JobReceived;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class TotalWagesReport extends Controller
{
    public function index()
    {
        $employee = Employee::all();

        $masterCompany = Company::where('company_type_id', 2)->get();
        $clientCompany = Company::where('company_type_id', 3)->get();
        $subClientCompany = Company::where('company_type_id', 4)->get();


        return view('pages.report.total_wages', compact('employee', 'masterCompany', 'clientCompany', 'subClientCompany'));
    }
    public function indexData(Request $request)
    {
        $query = JobReceived::query();

        // Apply filters if they are provided
        if ($request->filled('client_company_id')) {
            $query->whereHas('jobGiving.employee.company', function ($q) use ($request) {
                $q->where('id', $request->client_company_id);
            });
        }

        if ($request->filled('sub_client_company_id')) {
            $query->whereHas('jobGiving.employee.company', function ($q) use ($request) {
                $q->where('id', $request->sub_client_company_id);
            });
        }

        if ($request->filled('form_date')) {
            $query->whereDate('created_at', '>=', $request->form_date);
        }

        if ($request->filled('last_date')) {
            $query->whereDate('created_at', '<=', $request->last_date);
        }

        // Group job_received data by job_giving_id and sum fields for each job
        $job_received = $query->selectRaw('
        job_giving_id, 
        SUM(complete_quantity) as total_complete_quantity, 
        SUM(net_amount) as total_net_amount, 
        SUM(deducation_fee) as total_deducation_fee, 
        SUM(total_amount) as total_total_amount, 
        SUM(conveyance_fee) as total_conveyance_fee, 
        SUM(incentive_fee) as total_incentive_fee
    ')
            ->with(['jobGiving.employee.company'])
            ->groupBy('job_giving_id')
            ->get()
            ->groupBy(function ($row) {
                return $row->jobGiving->employee->company->id ?? null;
            });

        $groupedData = $job_received->map(function ($group) {
            $firstRow = $group->first();
            $totalAmount = $group->sum('total_total_amount');
            $conveyanceFee = $group->sum('total_conveyance_fee');

            // Calculate total_earned and commission
            $totalEarned = $totalAmount + $conveyanceFee;
            $commission = $totalAmount * 0.10;

            return [
                'job_giving_id' => $firstRow->job_giving_id,
                'company_name' => $firstRow->jobGiving->employee->company->company_name ?? 'N/A',
                'total_complete_quantity' => $group->sum('total_complete_quantity'),
                'net_amount' => $group->sum('total_net_amount'),
                'deducation_fee' => $group->sum('total_deducation_fee'),
                'total_amount' => $totalAmount,
                'conveyance_fee' => $conveyanceFee,
                'incentive_fee' => $group->sum('total_incentive_fee'),
                'total_earned' => $totalEarned,  // Total earned
                'commission' => $commission,  // Commission calculated as 10% of total_amount
                'total_pay' => $totalEarned + $commission  // Total pay = total_earned + commission
            ];
        })->values();

        return DataTables::of($groupedData)
            ->addColumn('job_giving_id', function ($row) {
                return $row['job_giving_id'];
            })
            ->addColumn('company_name', function ($row) {
                return $row['company_name'];
            })
            ->addColumn('total_complete_quantity', function ($row) {
                return $row['total_complete_quantity'];
            })
            ->addColumn('net_amount', function ($row) {
                return $row['net_amount'];
            })
            ->addColumn('deducation_fee', function ($row) {
                return $row['deducation_fee'];
            })
            ->addColumn('total_amount', function ($row) {
                return $row['total_amount'];
            })
            ->addColumn('conveyance_fee', function ($row) {
                return $row['conveyance_fee'];
            })
            ->addColumn('incentive_fee', function ($row) {
                return $row['incentive_fee'];
            })
            ->addColumn('total_earned', function ($row) {
                return $row['total_earned'];  // Add total_earned column
            })
            ->addColumn('commission', function ($row) {
                return $row['commission'];  // Add commission column
            })
            ->addColumn('total_pay', function ($row) {
                return $row['total_pay'];  // Add total_pay column
            })
            ->make(true);
    }









}
