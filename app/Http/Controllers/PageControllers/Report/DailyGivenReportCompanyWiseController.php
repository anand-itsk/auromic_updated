<?php

namespace App\Http\Controllers\PageControllers\Report;

use App\Http\Controllers\Controller;
use App\Models\JobGiving;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Maatwebsite\Excel\Facades\Excel;

class DailyGivenReportCompanyWiseController extends Controller
{
    public function index()
    {
        return view ('pages.report.daily_given_report_cw');
    }
    public function indexData()
    {
        $Job_Giving = JobGiving::with('employee', 'order_details', 'delivery_chellan','product_model.productSize')->get();
        return DataTables::of($Job_Giving)->make(true);
    }
}
