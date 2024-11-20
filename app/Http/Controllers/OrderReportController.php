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
use App\Models\Product;
use Carbon\Carbon;

class OrderReportController extends Controller
{
    public  function index()
    {
        $companyType = CompanyType::all();
        $company = Company::all();
        $customer = Customer::all();
        $order_nos = OrderNo::all();
        $product = Product::all();
        $order_status = OrderStatus::all();
        return view('pages.report.order_report', compact('companyType', 'company', 'customer', 'order_nos', 'order_status', 'product'));
    }
    public function indexData(Request $request)
    {
        // dd($request->all());
        // Existing filters
        $companyType = $request->input('company_type');
        $company = $request->input('companies');
        $customer = $request->input('customer');
        $fromDate = $request->input('from_date');
        $lastDate = $request->input('last_date');
        $orderNoId = $request->input('orderNoId');
        $order_no = $request->input('order_no');
        $product = $request->input('product');
        $dateFilter = $request->input('date_filter');
        $order_status = $request->input('order_status');
        $order_details = OrderDetail::with('orderNo', 'productSize', 'productColor', 'orderStatus', 'productModel.product', 'customer');

        // Filter by order_status type
        // if ($order_status) {
        //     $order_details->whereHas('productModel.product', function ($q) use ($order_status) {
        //         $q->where('order_statuses', $order_status);
        //     });
        // }

        if ($order_status) {
            $order_details->where('order_status_id', $order_status);
        }

        // Filter by company type
        if ($companyType) {
            $order_details->whereHas('deliveryChallans.company', function ($q) use ($companyType) {
                $q->where('company_type_id', $companyType);
            });
        }


        // Filter by company
        if ($company) {
            $companies = is_array($company) ? $company : [$company];
            $order_details->whereHas('deliveryChallans.company', function ($q) use ($companies) {
                $q->whereIn('company_id', $companies);
            });
        }

        // Filter by customer
        if ($customer) {
            $order_details->where('customer_id', $customer);
        }


        if ($dateFilter) {
            if ($dateFilter === 'today') {
                $order_details->whereDate('created_at', Carbon::today());
            } elseif ($dateFilter === 'this_month') {
                $order_details->whereMonth('created_at', Carbon::now()->month)
                    ->whereYear('created_at', Carbon::now()->year);
            } elseif ($dateFilter === 'last_month') {
                $order_details->whereMonth('created_at', Carbon::now()->subMonth()->month)
                    ->whereYear('created_at', Carbon::now()->subMonth()->year);
            }
        }
        // Filter by date range
        if ($fromDate && $lastDate) {
            $order_details->whereBetween('order_date', [$fromDate, $lastDate]);
        }
        // Filter by order number
        if ($orderNoId) {
            $order_details->where('order_no_id', $orderNoId);
        }

        if ($order_no) {
            $order_details->where('order_no_id', $order_no);
        }

        // Filter by product
        if ($product) {
            $order_details->whereHas('productModel.product', function ($q) use ($product) {
                $q->where('id', $product);
            });
        }


        // Filter by product
        if ($product) {
            $order_details->whereHas('productModel.product', function ($q) use ($product) {
                $q->where('id', $product);
            });
        }
        // dd($order_details->get());

        return Datatables::of($order_details)->make(true);
    }



    public function export(Request $request)
    {
        return Excel::download(new OrderReportExport($request->all()), 'OrderReportDatas_' . date('d-m-Y') . '.xlsx');
    }
}
