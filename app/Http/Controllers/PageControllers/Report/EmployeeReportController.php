<?php

namespace App\Http\Controllers\PageControllers\Report;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\CompanyType;
use App\Models\Company;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\EmployeeReportExport;
use App\Models\CompanyHierarchy;

class EmployeeReportController extends Controller
{
     public function index()
    {
        $companyType = CompanyType::all();
        $company = Company::all();
        $employees = Employee::all();
        return view ('pages.report.employee_report',compact('companyType','company', 'employees'));

    }
public function indexData(Request $request)
{
    // Get the company type filter value from the request
    $companyType = $request->input('company_type');

    // Get the joining date filter value from the request
    $joiningDate = $request->input('joining_date');

     $company = $request->input('companies');
        $employee = $request->input('employee');
        $fromDate = $request->input('from_date');
        $lastDate = $request->input('last_date');
    // Query employees with relationships
    $query = Employee::with('company', 'addresses', 'familyMembers', 'resigningReason');

    // Apply company type filter if provided
    if ($companyType) {
        $query->whereHas('company', function ($q) use ($companyType) {
            $q->where('company_type_id', $companyType);
        });
    }

    // Apply joining date filter if provided
    if ($joiningDate) {
        $query->whereDate('joining_date', $joiningDate);
    }

    if ($company) {
    // Convert $company to an array if it's not already one
    $companies = is_array($company) ? $company : [$company];
    $query->whereIn('company_id', $companies);
}

        if ($employee) {
            $query->where('id', $employee);
        }


        // dd($employee);
        if ($fromDate && $lastDate) {
            $query->whereBetween('created_at', [$fromDate, $lastDate]);
        }

    // Get employees data
    $employees = $query->get();

        $data = $employees->map(function ($employee) {
            $companyType = $employee->company->companyType->id ?? null;
            $masterCompany = $clientCompany = null;

            switch ($companyType) {
                case 2:
                    // Master company type
                    $masterCompanyName = $employee->company->company_name;
                    break;

                case 3:
                    // Client company type, find its master company
                    $clientCompanyId = $employee->company->id;
                    $masterCompanyId = CompanyHierarchy::where('company_id', $clientCompanyId)->value('parent_company_id');
                    $masterCompany = Company::find($masterCompanyId);
                    break;

                case 4:
                    // Sub-client company type, find its client and master company
                    $subClientId = $employee->company->id;
                    $clientCompanyId = CompanyHierarchy::where('company_id', $subClientId)->value('parent_company_id');
                    $clientCompany = Company::find($clientCompanyId);
                    $masterCompanyId = CompanyHierarchy::where('company_id', $clientCompanyId)->value('parent_company_id');
                    $masterCompany = Company::find($masterCompanyId);
                    break;
            }

            return [
                'id' => $employee->id,
                'master_company' => $companyType === 2 ? $employee->company->company_name : ($masterCompany->company_name ?? '-'),
                'client_company' => $companyType === 3 ? $employee->company->company_name : ($clientCompany->company_name ?? '-'),
                'sub_client_company' => $companyType === 4 ? $employee->company->company_name : '-',
                'employee_code' => $employee->employee_code,
                'employee_name' => $employee->employee_name,
                'company_name' => $employee->company->company_name,
                'company_type_name' => $employee->company->companyType->id,
                'faorhus_name' => $employee->faorhus_name,
                'resigning_date' => $employee->resigning_date,
                'joining_date' => $employee->joining_date,
                'mobile' => $employee->mobile,
                'dob' => $employee->dob,
                'faorhus_name' => $employee->faorhus_name,
                'pf_no' => optional($employee->pfInfo)->pf_no ?? '-',
                'esi_no' => optional($employee->esiInfo)->pf_no ?? '-',
                'village' => optional($employee->addresses)->village_area ?? '-',
                'parent_company_id' => optional($employee->company->companyHierarchy)->parent_company_id,
                'status' => $employee->status,
            ];
        });

        return DataTables::of($data)->make(true);

}

 public function export(Request $request)
    {
        return Excel::download(new EmployeeReportExport($request->all()), 'EmployeeReportDatas_' . date('d-m-Y') . '.xlsx');
    }

}
