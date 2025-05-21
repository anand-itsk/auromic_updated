<?php

namespace App\Http\Controllers\PageControllers\JobAllocation;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Employee;
use App\Models\JobAllocationHistory;
use App\Models\JobGiving;
use App\Models\JobReceived;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\JobReallocationExport;
use App\Models\CompanyType;
use App\Models\DeliveryChallan;
use App\Models\OrderNo;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class JobReallocationController extends Controller
{
    // Index Page
    public function index()
    {
        $companyType = CompanyType::all();
        $company = Company::all();
        $order_nos = OrderNo::all();
        $product = Product::all();
        $employee = Employee::all();
        return view('pages.job_allocation.job_reallocation.index', compact('companyType', 'company', 'order_nos', 'product', 'employee'));
    }
    // Index DataTable
    public function indexData(Request $request)
    {
        $status = $request->input('status');
        $companyType = $request->input('company_type');
        $company = $request->input('companies');
        $orderNoId = $request->input('orderNoId');
        $product = $request->input('product');
        $fromDate = $request->input('from_date');
        $lastDate = $request->input('last_date');
        $dateFilter = $request->input('date_filter');
        $employeeCode = $request->input('employee_code');
        $employeeName = $request->input('employee_name');

        // Initialize query with relationships
        $Job_Giving = JobGiving::with([
            'employee.company',
            'order_details.orderNo',
            'order_details.productColor',
            'deliveryChellan',
            'product_model.productSize'
        ])
            ->where('status', 'Pending')->where('quantity', '>', 0)->where(function ($query) {
            $query->whereNull('pending_quantity')
            ->orWhere('pending_quantity', '>', 0);
        });





        // Date Filters
        if ($dateFilter) {
            if ($dateFilter === 'today') {
                $Job_Giving->whereDate('created_at', Carbon::today());
            } elseif ($dateFilter === 'this_month') {
                $Job_Giving->whereMonth('created_at', Carbon::now()->month)
                    ->whereYear('created_at', Carbon::now()->year);
            } elseif ($dateFilter === 'last_month') {
                $Job_Giving->whereMonth('created_at', Carbon::now()->subMonth()->month)
                    ->whereYear('created_at', Carbon::now()->subMonth()->year);
            }
        }

        // From Date and To Date Filters
        if ($fromDate && $lastDate) {
            $Job_Giving->whereBetween('created_at', [$fromDate, $lastDate]);
        }

        if ($employeeCode) {
            $Job_Giving->whereHas('employee', function ($query) use ($employeeCode) {
                $query->where('id', 'LIKE', "%$employeeCode%");
            });
        }

        if ($employeeName) {
            $Job_Giving->whereHas('employee', function ($query) use ($employeeName) {
                $query->where('id', 'LIKE', "%$employeeName%");
            });
        }
        // Filter by Company Type
        if ($companyType) {
            $Job_Giving->whereHas('employee.company', function ($q) use ($companyType) {
                $q->where('company_type_id', $companyType);
            });
        }

        // Filter by Company
        if ($company) {
            $companies = is_array($company) ? $company : [$company];
            $Job_Giving->whereHas('employee.company', function ($q) use ($companies) {
                $q->whereIn('id', $companies); // Ensure `id` matches the company column
            });
        }

        // Filter by Status
        if ($status) {
            $Job_Giving->where('status', $status);
        }

        // Filter by Order Number
        if ($orderNoId) {
            $Job_Giving->whereHas('order_details', function ($q) use ($orderNoId) {
                $q->where('order_id', $orderNoId);
            });
        }

        // Filter by Product
        if ($product) {
            $Job_Giving->whereHas('product_model', function ($q) use ($product) {
                $q->where('product_id', $product);
            });
        }

        // Retrieve filtered data
        $Job_Giving = $Job_Giving->get();

        // dd($Job_Giving);

        // Map the data for DataTable
        $data = $Job_Giving->map(function ($job_giving) {
            return [
                'id' => $job_giving->id,
                'company_name' => $job_giving->employee->company->company_name ?? null,
                'employee_code' => $job_giving->employee->employee_code ?? null,
                'employee_name' => $job_giving->employee->employee_name ?? null,
                'customer_order_no' => $job_giving->order_details->orderNo->customer_order_no ?? null,
                'dc_no' => $job_giving->deliveryChellan->dc_no ?? null,
                'model_code' => $job_giving->product_model->model_code ?? null,
                'model_name' => $job_giving->product_model->model_name ?? null,
                'product_size' => $job_giving->product_model->productSize->code ?? null,
                'product_color' => $job_giving->order_details->productColor->code ?? null,
                'quantity' => $job_giving->quantity ?? null,
                'pending_quantity' => $job_giving->pending_quantity ?? null,
                'given_date' => $job_giving->created_at ? $job_giving->created_at->format('d/m/Y') : null,
                'status' => $job_giving->status ?? null,
            ];
        });

        // Return DataTable response
        return DataTables::of($data)->make(true);
    }
    // store
    public function store(Request $request)
    {
        // dd($request);
        $validated = $request->validate([
            'job_giving_id' => 'required|exists:job_givings,id',
            'employee_id' => 'required|exists:employees,id',
            'quantity' => 'required|numeric|min:1',
            'available_quantity' => 'required|numeric|min:1',
            'company_id' => 'required|exists:companies,id',
            'total_amount' => 'required|numeric|min:0',
            'date' => 'required|date',
        ]);
        DB::beginTransaction();
        try {
            // Fetch job giving data
            $jobGivingData = JobGiving::find($validated['job_giving_id']);
            if (!$jobGivingData) {
                return redirect()->route('job_allocation.job_reallocation.index')
                    ->with('error', 'Invalid Job Giving ID');
            }

            // Check if quantity exceeds balance
            if ($validated['quantity'] > $validated['available_quantity']) {
                return redirect()->route('job_allocation.job_reallocation.index')
                    ->with('error', 'No available quantity for this order');
            }

            $existingAllocation = JobGiving::where('order_id', $jobGivingData->order_id)
                ->where('employee_id', $validated['employee_id'])
                ->first();

            if ($existingAllocation) {
                // Update existing allocation
                $existingAllocation->quantity += $validated['quantity'];
                $existingAllocation->pending_quantity += $validated['quantity'];
                $existingAllocation->save();
            } else {
                // Create new allocation for the employee
                // $newAllocation = new JobGiving();
                // $newAllocation->order_id = $jobGivingData->order_id;
                // $newAllocation->employee_id = $validated['employee_id'];
                // $newAllocation->quantity = $validated['quantity'];
                // $newAllocation->pending_quantity = $validated['quantity'];
                // $newAllocation->save();
                $newPendingQuantity = $jobGivingData->pending_quantity - $validated['quantity'];

                // dd($newPendingQuantity);
                // Save new JobGiving
                $newJobGiving = new JobGiving();
                $newJobGiving->employee_id = $validated['employee_id'];
                $newJobGiving->order_id = $jobGivingData->order_id;
                $newJobGiving->product_model_id = $jobGivingData->product_model_id;
                $newJobGiving->dc_id = $jobGivingData->dc_id;
                $newJobGiving->weight = $jobGivingData->weight;
                $newJobGiving->excess = $jobGivingData->excess;
                $newJobGiving->shortage = $jobGivingData->shortage;
                $newJobGiving->days = $jobGivingData->days;
                $newJobGiving->quantity = $validated['quantity'];
                $newJobGiving->pending_quantity = $newPendingQuantity;
                $newJobGiving->save();
            }


            // Save JobAllocationHistory
            $jobReceived = new JobAllocationHistory();
            $jobReceived->job_giving_id = $validated['job_giving_id'];
            $jobReceived->employee_id = $validated['employee_id'];
            $jobReceived->date = $validated['date'];
            $jobReceived->quantity = $validated['quantity'];
            $jobReceived->save();

            $jobGivingData->pending_quantity -= $validated['quantity'];
            $jobGivingData->quantity -= $validated['quantity'];
            //    dd($jobGivingData); // Subtract allocated quantity
            $jobGivingData->save();

            $newPendingQuantity = $jobGivingData->pending_quantity - $validated['quantity'];


            // Save new DeliveryChallan
            $deliveryChallan = DeliveryChallan::find($jobGivingData->dc_id);
            if ($deliveryChallan) {
                $newDeliveryChallan = $deliveryChallan->replicate();
                $newDeliveryChallan->company_id = $validated['company_id'];
                $newDeliveryChallan->quantity = $validated['quantity'];
                $newDeliveryChallan->available_quantity = $validated['quantity'];
                $newDeliveryChallan->save();
            }

            DB::commit();
            return redirect()->route('job_allocation.job_reallocation.index')
                ->with('success', 'Job Reallocation Created and Linked Successfully');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('job_allocation.job_reallocation.index')
                ->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    public function edit(Request $request, $id)
    {

        $Job_Giving = JobGiving::with('employee', 'order_details', 'product_model', 'deliveryChellan')->find($id);

        $jobReceivedData = JobReceived::where('job_giving_id', $id)->latest()->first();

        $employee = Employee::with(['company' => function ($query) {
            $query->with('companyType');
        }])->get();

        $completeQuantitySum = intval(JobReceived::where('job_giving_id', $id)
            ->sum('complete_quantity'));
        // dd($completeQuantitySum);
        return view('pages.job_allocation.job_reallocation.edit', compact('Job_Giving', 'jobReceivedData', 'id', 'employee', 'completeQuantitySum'));
    }

    public function cancelJobGiving($id)
    {
        // Find the JobGiving record
        $jobGiving = JobGiving::find($id);

        if ($jobGiving) {
            // Find the associated JobReceived record
            $jobReceived = $jobGiving->jobReceived;

            // Restore stock for the raw material used in the product model
            $productModel = $jobGiving->product_model;
            if ($productModel) {
                $rawMaterial = $productModel->rawMaterial;
                if ($rawMaterial) {
                    // Add the job giving quantity back to the raw material stock
                    $rawMaterial->stock += $jobGiving->pending_quantity;
                    $rawMaterial->save();
                }
            }

            if ($jobReceived) {
                $jobGiving->quantity = $jobReceived->complete_quantity;
                $jobGiving->pending_quantity = 0;
            }

            // Update the status to 'Cancelled'
            $jobGiving->status = 'Complete';
            $jobGiving->save();

            return redirect()->route('job_allocation.job_reallocation.index')
                ->with('success', 'Job Giving Cancelled Successfully and Stock Updated');
        } else {
            // Handle case where JobGiving record is not found
            return redirect()->route('job_allocation.job_reallocation.index')
                ->with('error', 'Job Giving not found');
        }
    }



    public function export(Request $request)
    {
        return Excel::download(new JobReallocationExport($request->all()), 'JobReallocationExportDatas_' . date('d-m-Y') . '.xlsx');
    }
}
