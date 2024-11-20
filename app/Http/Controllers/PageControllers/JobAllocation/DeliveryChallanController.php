<?php

namespace App\Http\Controllers\PageControllers\JobAllocation;

use App\Http\Controllers\Controller;
use App\Models\AuthorisedPerson;
use App\Exports\DeliveryChallanExport;
use App\Imports\DeliveryChallanImport;
use App\Models\Company;
use App\Models\Customer;
use App\Models\CompanyType;
use App\Models\ProductModel;
use App\Models\ProductSize;
use App\Models\ProductColor;
use App\Models\DeliveryChallan;
use App\Models\OrderDetail;
use App\Models\CompanyHierarchy;
use App\Models\JobGiving;
use App\Models\OrderNo;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Maatwebsite\Excel\Facades\Excel;

class DeliveryChallanController extends Controller
{

    // Index Page
    public function index()
    {

        $companyType = CompanyType::all();
        $company = Company::all();
        $order_nos = OrderNo::all();
        $delivery_challan = DeliveryChallan::all();
        $product_model = ProductModel::all();
        $product_color = ProductColor::all();
        $product_size =  ProductSize::all();
        return view('pages.job_allocation.delivery_challan.index',compact('companyType','company', 'order_nos', 'delivery_challan', 'product_model', 'product_size','product_color'));
    }
    // Index DataTable
    public function indexData(Request $request)
    {
        $companyType = $request->input('company_type');
        $company = $request->input('companies');
        $customer_order_no = $request->input('customer_order_no');
        $dc_no = $request->input('dc_no');
        $product_model = $request->input('product_model');
        $product_color = $request->input('product_color');
        $product_size = $request->input('product_size');
        $fromDate = $request->input('from_date');
        $lastDate = $request->input('last_date');
        $dateFilter = $request->input('date_filter');

        $delivery_challans = DeliveryChallan::with([
                'company',
                'subCompany',
                'order_details',
                'orderDetails.productModel',
                'productSize',
                'productColor',
                'orderDetails.productModel.product'
            ]);

        // Date filter
        if ($dateFilter) {
            if ($dateFilter === 'today'
            ) {
                $delivery_challans->whereDate('created_at', Carbon::today());
            } elseif ($dateFilter === 'this_month') {
                $delivery_challans->whereMonth('created_at', Carbon::now()->month)
                ->whereYear('created_at', Carbon::now()->year);
            } elseif ($dateFilter === 'last_month') {
                $delivery_challans->whereMonth('created_at', Carbon::now()->subMonth()->month)
                ->whereYear('created_at', Carbon::now()->subMonth()->year);
            }
        }

        // Company type filter
        if ($companyType) {
            $delivery_challans->whereHas('company', function ($q) use ($companyType) {
                $q->where('company_type_id', $companyType);
            });
        }

        // Company filter
        if ($company) {
            $companies = is_array($company) ? $company : [$company];
            $delivery_challans->whereHas('company', function ($q) use ($companies) {
                $q->whereIn('id', $companies);
            });
        }

        // Customer order number filter
        if ($customer_order_no) {
            $delivery_challans->whereHas('order_details', function ($q) use ($customer_order_no) {
                $q->where('customer_order_no', 'like', '%' . $customer_order_no . '%');
            });
        }

        // DC number filter
        if ($dc_no) {
            $delivery_challans->where('dc_no', 'like', '%' . $dc_no . '%');
        }

        // Product model filter
        if ($product_model) {
            $delivery_challans->whereHas('orderDetails.productModel', function ($q) use ($product_model) {
                $q->where('id', $product_model);
            });
        }

        // Product color filter
        if ($product_color) {
            $delivery_challans->whereHas('orderDetails.productColor', function ($q) use ($product_color) {
                $q->where('id', $product_color);
            });
        }

        // Product size filter
        if ($product_size) {
            $delivery_challans->whereHas('orderDetails.productSize', function ($q) use ($product_size) {
                $q->where('id', $product_size);
            });
        }

        // Date range filter
        if ($fromDate && $lastDate) {
            $delivery_challans->whereBetween('dc_date', [$fromDate, $lastDate]);
        }

        return DataTables::of($delivery_challans)
        ->addColumn('order_number', function ($deliveryChallan) {
            return $deliveryChallan->order_details->customer_order_no ?? '-';
        })
        ->addColumn('dc_no', function ($deliveryChallan) {
            return $deliveryChallan->dc_no ?? '-';
        })
        ->addColumn('model_code', function ($deliveryChallan) {
            return $deliveryChallan->orderDetails->productModel->model_code ?? '-';
        })
        ->addColumn('model_name', function ($deliveryChallan) {
            return $deliveryChallan->orderDetails->productModel->product->name ?? '-';
        })
        ->addColumn('product_color', function ($deliveryChallan) {
            return $deliveryChallan->orderDetails->productColor->name ?? '-';
        })
        ->addColumn('product_size', function ($deliveryChallan) {
            return $deliveryChallan->orderDetails->productSize->name ?? '-';
        })
        ->addColumn('wages_product', function ($deliveryChallan) {
            return $deliveryChallan->orderDetails->productModel->wages_product ?? '-';
        })
        ->addColumn('can_delete', function ($deliveryChallan) {
            // Check if the dc_id exists in the job_giving table
            return !JobGiving::where('dc_id', $deliveryChallan->id)->exists();
        })
        ->make(true);
    }

    // Create Page
    public function create()
    {
        $latestDeliveryChallan = DeliveryChallan::latest()->first();
        if ($latestDeliveryChallan) {
            $dcNumber = (int)substr($latestDeliveryChallan->dc_no, 2); // Extract the numeric part
            $dcNumber++;
        } else {
            $dcNumber = 1;
        }

        // Format the DC number with leading zeros
        $formattedDCNumber = 'DC' . str_pad($dcNumber, 3, '0', STR_PAD_LEFT);

        $customer = Customer::all();
        $company = Company::all();
        $company_types = CompanyType::all();
        $authorised_people = AuthorisedPerson::all();
        $order_details = OrderDetail::all();
       $order_nos = OrderNo::whereIn('id', OrderDetail::pluck('order_no_id'))->get();
        $productModels = ProductModel::with(['rawMaterial.rawMaterialType'])->get();
        $product_size = ProductSize::all();
        $product_color = ProductColor::all();
        $company_hierarchy = CompanyHierarchy::all();



        return view('pages.job_allocation.delivery_challan.create', compact('company', 'authorised_people', 'order_details', 'company_types', 'customer', 'productModels', 'product_size', 'product_color', 'formattedDCNumber', 'order_nos','company_hierarchy'));
    }

    public function getSubCompanies($companyId)
{
       
        // dd($companyId);

       $companyHierarchy = CompanyHierarchy::where('parent_company_id', $companyId)
        ->with('company') 
        ->get();
    
        //  dd($companyHierarchy);
    
       return response()->json($companyHierarchy);
}

    public function getCompanies($companytypeid)
    {
        $companies = Company::where('company_type_id', $companytypeid)->with('authorisedPerson')->get();
        return response()->json($companies);
    }

    public function getModelsByOrderId(Request $request)
    {
        $orderId = $request->order_id;
        // Retrieve models based on the selected order_id
        $models = OrderDetail::where('order_no_id', $orderId)->distinct('product_model_id')->pluck('product_model_id');

        // Assuming your models have a relationship to a ProductModel model
        $productModels = ProductModel::whereIn('id', $models)->get();

        return response()->json($productModels);
    }


    public function getProductDetails(Request $request)
    {
        $productModelId = $request->input('product_model');
        $productDetails = ProductModel::with(['product', 'rawMaterial.rawMaterialType'])->find($productModelId);

        return response()->json([
            'product' => $productDetails->product->name,
            'raw_material_name' => $productDetails->rawMaterial->name,
            'raw_material_type' => $productDetails->rawMaterial->rawMaterialType->name,
            'product_size_code' => $productDetails->productSize->code,
            'product_size_id' => $productDetails->productSize->id,
        ]);
    }
    public function getOrderDetails(Request $request)
    {
        $orderId = $request->input('order_id');
         $productModelId = $request->input('product_model');
       $orderDetail = OrderDetail::where('order_no_id', $orderId)
                               ->where('product_model_id', $productModelId)
                               ->first();

        if ($orderDetail) {
        return response()->json([
            'order_date' => $orderDetail->order_date,
            'total_quantity' => $orderDetail->quantity,
            'available_quantity' => $orderDetail->available_quantity,
            'total_r_w_weight' => $orderDetail->total_raw_material,
            'weight_per_item' => $orderDetail->weight_per_item,
            'available_weight' => $orderDetail->available_weight,
            'product_color_id' => $orderDetail->productColor->name,
            'product_size_id' => $orderDetail->productSize->code,
        ]);
    } else {
        return response()->json([
            'error' => 'No matching order details found.'
        ], 404); // Return 404 status code if no matching order details found
    }
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'company_type_id' => 'required',
            'company_id' => 'required',
            'product_model' => 'required',
            'dc_number' => 'required',
            'dc_date' => 'required',
            'order_id' => 'required',
            'quantity' => 'required',
            'weight' => 'required',
        ]);

        $input = $request->all();

        // Retrieve the order detail (change get() to first())
        $orderDetail = OrderDetail::where('order_no_id', $input['order_id'])->first();

        // Check if the order detail exists
        if (!$orderDetail) {
            return redirect()->route('job_allocation.delivery_challan.index')
            ->with('error', 'Order detail not found for this order ID');
        }

        // Calculate total delivered quantity for the order
        $totalDeliveredQuantity = DeliveryChallan::where('order_id', $input['order_id'])->sum('quantity');

        // Calculate available quantity
        $availableQuantity = $orderDetail->quantity - $totalDeliveredQuantity;

        // Check if the input quantity exceeds the available quantity
        if ($input['quantity'] > $availableQuantity) {
            // If the input quantity is greater than the available quantity, show an error message
            return redirect()->route('job_allocation.delivery_challan.index')
            ->with('error', 'No available quantity for this order');
        }

        // Create and save the delivery challan
        $delivery_challan = new DeliveryChallan();
        $delivery_challan->company_id = $input['company_id'];
        $delivery_challan->sub_company_id = isset($input['parent_company_id']) && !empty($input['parent_company_id']) ? $input['parent_company_id'] : null;
        $delivery_challan->dc_no = $input['dc_number'];
        $delivery_challan->order_id = $input['order_id'];
        $delivery_challan->dc_date = $input['dc_date'];
        $delivery_challan->quantity = $input['quantity'];
        $delivery_challan->available_quantity = $input['quantity']; // This may need to be adjusted based on your business logic
        $delivery_challan->weight = $input['weight'];
        $delivery_challan->excess = isset($input['excess_weight']) ? $input['excess_weight'] : 0;
        $delivery_challan->shortage = isset($input['shortage_weight']) ? $input['shortage_weight'] : 0;

        $delivery_challan->save();

        // Update available quantity in order details
        $orderDetail->available_quantity = $availableQuantity - $input['quantity'];
        $orderDetail->save();

        // Set success message for display
        return redirect()->route('job_allocation.delivery_challan.index')
        ->with('success', 'Order Allocation created successfully');
    }




    // Edit
    public function edit(Request $request, $id)
    {
        $delivery_challans = DeliveryChallan::find($id);
        $company = Company::all();
        $customer = Customer::all();
        $company_types = CompanyType::all();
        $authorised_people = AuthorisedPerson::all();
        $order_details = OrderDetail::all();
        $order_nos = OrderNo::all();
        $productModels = ProductModel::with(['rawMaterial.rawMaterialType', 'product'])->get();

        // dd($productModels);
        $product_size = ProductSize::all();
        $product_color = ProductColor::all();
        // Fetch order details based on conditions
        $order_detail = OrderDetail::where('customer_id', $request->customer_id)
            ->where('order_date', $request->order_date)
            ->where('product_model_id', $request->product_model)
            ->get();

             $companyHierarchy = CompanyHierarchy::where('company_id', $delivery_challans->sub_company_id)->first();
$subCompanyName = $companyHierarchy ? $companyHierarchy->company->company_name : null;

        return view('pages.job_allocation.delivery_challan.edit', compact('company', 'authorised_people', 'order_details', 'delivery_challans', 'company_types', 'productModels', 'product_size', 'product_color', 'customer', 'order_detail', 'order_nos','subCompanyName','companyHierarchy'));
    }


    // Update
    public function update(Request $request, $id)
    {
        $input = $request->all();

        // Retrieve the delivery challan to update
        $delivery_challan = DeliveryChallan::find($id);

        // Retrieve the corresponding order detail
        $orderDetail = OrderDetail::findOrFail($delivery_challan->order_id);

        // Calculate total delivered quantity for the order excluding the current delivery challan being updated
        $totalDeliveredQuantity = DeliveryChallan::where('order_id', $delivery_challan->order_id)
            ->where('id', '!=', $id)
            ->sum('quantity');

        // Calculate available quantity before the update
        $availableQuantityBeforeUpdate = $orderDetail->quantity - $totalDeliveredQuantity + $delivery_challan->quantity;

        // Calculate the difference between the old quantity and the new quantity
        $quantityDifference = $delivery_challan->quantity - $input['quantity'];

        // Update delivery challan details
        $delivery_challan->company_id = $input['company_id'];
        $delivery_challan->dc_no = $input['dc_number'];
        $delivery_challan->dc_date = $input['dc_date'];
        $delivery_challan->quantity = $input['quantity'];
        $delivery_challan->weight = $input['weight'];
        $delivery_challan->excess = isset($input['excess_weight']) ? $input['excess_weight'] : 0;
        $delivery_challan->shortage = isset($input['shortage_weight']) ? $input['shortage_weight'] : 0;

        $delivery_challan->save();

        // Update available quantity in order details
        $orderDetail->available_quantity += $quantityDifference;
        $orderDetail->save();

        return redirect()->route('job_allocation.delivery_challan.index')
            ->with('success', 'Order Allocation updated successfully');
    }


    // Multi Delete
    public function deleteSelected(Request $request)
    {

        $ids = $request->ids;

        if (!is_array($ids)) {
            return response()->json(['status' => 'error', 'message' => 'Invalid input'], 400);
        }

        DeliveryChallan::destroy($ids);
        return response()->json(['status' => 'success']);
    }

    public function delete($id)
    {
        $delivery_challan = DeliveryChallan::find($id);

        // Check if there are any JobGiving records associated with this dc_id
        $jobGivingRecords = JobGiving::where('dc_id', $id)->exists();

        if ($jobGivingRecords) {
            // Return an error message if dc_id is associated with JobGiving records
            return response()->json([
                'status' => 'error',
                'message' => 'Cannot delete this Delivery Challan as it is associated with existing Job Giving records.'
            ]);
        }

        // Delete the Delivery Challan if no associated JobGiving records
        $delivery_challan->delete();

        // Return a success message
        return response()->json([
            'status' => 'success',
            'message' => 'Delivery Challan deleted successfully!'
        ]);
    }

    public function export(Request $request)
    {
        return Excel::download(new DeliveryChallanExport($request->all()), 'OrderAllocationDatas_' . date('d-m-Y') . '.xlsx');
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:xlsx,csv'
        ]);

        Excel::import(new DeliveryChallanImport, request()->file('file'));

        return redirect()->route('job_allocation.delivery_challan.index')->with('success', 'Data imported successfully');
    }
}
