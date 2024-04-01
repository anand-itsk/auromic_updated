<?php

namespace App\Http\Controllers\PageControllers\Report;

use App\Http\Controllers\Controller;
use App\Models\JobGiving;
use App\Models\CompanyType;
use App\Models\Company;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Maatwebsite\Excel\Facades\Excel;

class DailyGivenReportCompanyWiseController extends Controller
{
    public function index()
    {
          $companyType = CompanyType::all();
        $company = Company::all();
        return view ('pages.report.daily_given_report_cw',compact('companyType','company'));
    }
    public function indexData()
    {
        
        $Job_Giving = JobGiving::with('employee', 'order_details', 'delivery_chellan','product_model.productSize')->get();
        return DataTables::of($Job_Giving)->make(true);
    }
}
