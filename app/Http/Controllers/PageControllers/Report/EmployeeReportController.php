<?php

namespace App\Http\Controllers\PageControllers\Report;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\CompanyType;
use App\Models\Company;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Maatwebsite\Excel\Facades\Excel;

class EmployeeReportController extends Controller
{
     public function index()
    {
        $companyType = CompanyType::all();
        $company = Company::all();
        return view ('pages.report.employee_report',compact('companyType','company'));

    }
public function indexData(Request $request)
{
    // Get the company type filter value from the request
    $companyType = $request->input('company_type');

    // Get the joining date filter value from the request
    $joiningDate = $request->input('joining_date');


     $company = $request->input('companies');
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

    // Get employees data
    $employees = $query->get();

    // Return the data using DataTables
    return DataTables::of($employees)->make(true);
}

}
