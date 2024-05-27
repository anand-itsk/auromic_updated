<?php

namespace App\Http\Controllers;
use App\Models\CompanyType;
use App\Models\Company;
use App\Models\OrderDetail;
use App\Models\Customer;
use App\Models\OrderNo;
use App\Models\OrderStatus;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\OrderReportExport;

class OrderReportController extends Controller
{
     Public  function index()
     {
        $companyType = CompanyType::all();
        $company = Company::all();
        $customer = Customer::all();
        $order_nos = OrderNo::all();
         $order_status = OrderStatus::all();
         return view ('pages.report.order_report',compact('companyType','company','customer','order_nos','order_status'));
     }

     public function indexData(Request $request)
{
    $companyType = $request->input('company_type');
    $company = $request->input('companies');
    $customer = $request->input('customer');
    $fromDate = $request->input('from_date');
    $lastDate = $request->input('last_date');
    $orderNoId = $request->input('order_id');
    

    $order_details = OrderDetail::with('orderNo', 'productSize', 'productColor', 'orderStatus', 'productModel.product', 'customer');
   
     if ($companyType) {
            $order_details->whereHas('deliveryChallans.company', function ($q) use ($companyType) {
                $q->where('company_type_id', $companyType);
            });
        }

        if ($company) {
            // Convert $company to an array if it's not already one
            $companies = is_array($company) ? $company : [$company];
            $order_details->whereHas('deliveryChallans.company', function ($q) use ($companies) {
                $q->whereIn('company_id', $companies);
            });
        }

        if ($customer) {
        $order_details->where('customer_id', $customer);
    }

     if ($fromDate && $lastDate) {
            $order_details->whereBetween('order_date', [$fromDate, $lastDate]);
        }


    if ($orderNoId) {
     $order_details->where('order_no_id', $orderNoId);
    }
   
        $oderDetailsData = $order_details->get();

    // Return the data using DataTables
    return DataTables::of($order_details)->make(true);
}

 public function export(Request $request)
    {
        return Excel::download(new OrderReportExport($request->all()), 'OrderReportDatas_' . date('d-m-Y') . '.xlsx');
    }
}
