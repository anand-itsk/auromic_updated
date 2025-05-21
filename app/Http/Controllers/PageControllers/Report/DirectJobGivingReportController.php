<?php

namespace App\Http\Controllers\PageControllers\Report;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DirectJobGiving;
use App\Models\Employee;
use App\Models\FinishingProductModel;
use Yajra\DataTables\DataTables;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\DirectJobReportExport;
use App\Models\Company;
use App\Models\CompanyType;
use Carbon\Carbon;

class DirectJobGivingReportController extends Controller
{
       public function index()
    {
        $employee = Employee::all();
        $finishing_product = FinishingProductModel::all();
        $companyType = CompanyType::all();
        $company = Company::all();
        return view('pages.report.direct_job_given_report', compact('employee','finishing_product', 'companyType', 'company'));
    }
    public function indexData(Request $request)
    {
        $employee_code = $request->input('employee_code');
        $employee_name = $request->input('employee_name');
        $fp_code = $request->input('fp_code');
        $fp_name = $request->input('fp_name');
        $fromDate = $request->input('from_date');
        $lastDate = $request->input('last_date');
        $dateFilter = $request->input('date_filter');

        $direct_job_giving = DirectJobGiving::with(['employee.company', 'finishingProduct', 'productSize', 'productColor']);

        // Filter by Date
        if ($dateFilter) {
            if ($dateFilter === 'today') {
                $direct_job_giving->whereDate('created_at', Carbon::today());
            } elseif ($dateFilter === 'this_month') {
                $direct_job_giving->whereMonth('created_at', Carbon::now()->month)
                    ->whereYear('created_at', Carbon::now()->year);
            } elseif ($dateFilter === 'last_month') {
                $direct_job_giving->whereMonth('created_at', Carbon::now()->subMonth()->month)
                    ->whereYear('created_at', Carbon::now()->subMonth()->year);
            }
        }

        // Filter by Employee Code
        if ($employee_code) {
            $direct_job_giving->whereHas('employee', function ($query) use ($employee_code) {
                $query->where('employee_code', $employee_code);
            });
        }

        // Filter by Employee Name
        if ($employee_name) {
            $direct_job_giving->whereHas('employee', function ($query) use ($employee_name) {
                $query->where('employee_name', 'like', '%' . $employee_name . '%');
            });
        }

        // Filter by Finishing Product Code
        if ($fp_code) {
            $direct_job_giving->whereHas('finishingProduct', function ($query) use ($fp_code) {
                $query->where('id', $fp_code);
            });
        }

        // Filter by Finishing Product Name
        if ($fp_name) {
            $direct_job_giving->whereHas('finishingProduct', function ($query) use ($fp_name) {
                $query->where('id', $fp_name); // Update the condition if needed
            });
        }


        if ($request->filled('from_date') && $request->filled('last_date')) {
            $fromDate = Carbon::parse($request->input('from_date'))->startOfDay();
            $lastDate = Carbon::parse($request->input('last_date'))->endOfDay();

            $direct_job_giving->whereBetween('created_at', [$fromDate, $lastDate]);
        }



        return DataTables::of($direct_job_giving->get())
        ->addColumn('company_name', function ($row) {
            return $row->employee && $row->employee->company ? $row->employee->company->company_name : '-';
        })
        ->make(true);
    }


 public function export(Request $request)
    {
        return Excel::download(new DirectJobReportExport($request->all()), 'DirectJobReportDatas_' . date('d-m-Y') . '.xlsx');
    }
}
