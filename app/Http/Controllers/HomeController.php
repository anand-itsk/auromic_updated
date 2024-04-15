<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OrderDetail;
use App\Models\Company;
use App\Models\Employee;
use App\Models\ProductModel;
use App\Models\JobGiving;
use App\Models\JobReceived;
use App\Models\JobAllocationHistory;
use App\Models\DirectJobGiving;
use App\Models\DirectJobReceived;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $order_count = OrderDetail::count();
        $master_company_count = Company::where('company_type_id', 2)->count();
        $client_company_count = Company::where('company_type_id', 3)->count();
        $subclient_company_count = Company::where('company_type_id', 4)->count();
        //  $employee_count_master = Employee::where('company_id', 2)->count();
        $employee_count_master = Employee::join('companies', 'employees.company_id', '=', 'companies.id')
            ->where('companies.company_type_id', 2)
            ->count();
        $employee_count_client = Employee::join('companies', 'employees.company_id', '=', 'companies.id')
            ->where('companies.company_type_id', 3)
            ->count();
        $employee_count_subclient = Employee::join('companies', 'employees.company_id', '=', 'companies.id')
            ->where('companies.company_type_id', 4)
            ->count();
        $employee = Employee::count();
        $recentEmployees = Employee::latest()->take(5)->get();
        $company = Company::count();
        $product_model = ProductModel::count();
        $jobGivingCountWithDcId = JobGiving::whereNotNull('dc_id')->count();
        $jobGivingCountWithoutDcId = JobGiving::count();
        $job_received = JobReceived::count();
        $job_reallocation = JobAllocationHistory::count();
        $direct_job_giving = DirectJobGiving::count();
        $direct_job_received = DirectJobReceived::count();
        return view('home', compact('order_count', 'master_company_count', 'client_company_count', 'subclient_company_count', 'employee_count_master', 'employee_count_client', 'employee_count_subclient', 'employee', 'company', 'product_model', 'jobGivingCountWithDcId', 'jobGivingCountWithoutDcId', 'job_received', 'job_reallocation', 'direct_job_giving', 'direct_job_received', 'recentEmployees'));
    }
}
