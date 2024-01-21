<?php

namespace App\Http\Controllers\PageControllers;

use App\Http\Controllers\Controller;
use App\Models\Company;
use Illuminate\Http\Request;

class MasterCompanyController extends Controller
{
    public function index(){
        $master_companies = Company::where('company_type_id', 1)->get();
        dd($master_companies);
        return view('pages.master_company.index');
    }
}
