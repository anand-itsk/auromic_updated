<?php

namespace App\Http\Controllers;
use App\Models\CompanyType;
use App\Models\Company;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Maatwebsite\Excel\Facades\Excel;

class OrderReportController extends Controller
{
     Public  function index()
     {
        $companyType = CompanyType::all();
        $company = Company::all();
         return view ('pages.report.order_report',compact('companyType','company'));
     }

     public function indexData(Request $request)
{
    
    $companyType = $request->input('company_type');


     $company = $request->input('companies');
    
    $query = OrderDetail::with('orderNo', 'productSize', 'productColor', 'orderStatus', 'productModel', 'customer');

    // Apply company type filter if provided
    if ($companyType) {
        $query->whereHas('company', function ($q) use ($companyType) {
            $q->where('company_type_id', $companyType);
        });
    }

   

    if ($company) {
    // Convert $company to an array if it's not already one
    $companies = is_array($company) ? $company : [$company];
    $query->whereIn('company_id', $companies);
}
    // Get employees data
    $order_details = $query->get();

    // Return the data using DataTables
    return DataTables::of($order_details)->make(true);
}

}
