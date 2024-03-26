<?php

namespace App\Http\Controllers\PageControllers\Report;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DailyGivenReportCompanyWiseController extends Controller
{
    public function index()
    {
        return view ('pages.report.daily_given_report_cw');
    }
}
