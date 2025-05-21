<?php

namespace App\Http\Controllers\PageControllers\JobAllocation;

use App\Http\Controllers\Controller;
use App\Models\JobGiving;
use App\Models\JobReceived;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Exports\JobReceivedExport;
use App\Models\Company;
use App\Models\CompanyType;
use App\Models\OrderNo;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Facades\Excel;

class JobReceivedController extends Controller
{
    // Index Page
    public function index()
    {
        $companyType = CompanyType::all();
        $company = Company::all();
        $order_nos = OrderNo::all();
        $product = Product::all();
        return view('pages.job_allocation.job_received.index',compact('companyType','company','order_nos','product'));
    }
    // Index DataTable
    public function indexData(Request $request)
    {
        // Extract input filters
        $status = $request->input('status');
        $companyType = $request->input('company_type');
        $company = $request->input('companies');
        $orderNoId = $request->input('orderNoId');
        $product = $request->input('product');
        $fromDate = $request->input('from_date');
        $lastDate = $request->input('last_date');
        $dateFilter = $request->input('date_filter');

        // Base query with eager loading
        $Job_Giving = JobGiving::with([
            'employee.company',
            'order_details.productColor',
            'deliveryChellan',
            'product_model.productSize',
            'jobReceived'
        ]);

        // Apply filters
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

        if ($fromDate && $lastDate) {
            $Job_Giving->whereBetween('created_at', [$fromDate, $lastDate]);
        }

        if ($companyType) {
            $Job_Giving->whereHas('employee.company', function ($q) use ($companyType) {
                $q->where('company_type_id', $companyType);
            });
        }

        if ($company) {
            $companies = is_array($company) ? $company : [$company];
            $Job_Giving->whereHas('employee.company', function ($q) use ($companies) {
                $q->whereIn('company_id', $companies);
            });
        }

        if ($status) {
            $Job_Giving->where('status', $status);
        }

        if ($orderNoId) {
            $Job_Giving->whereHas('order_details', function ($q) use ($orderNoId) {
                $q->where('order_id', $orderNoId);
            });
        }

        if ($product) {
            $Job_Giving->whereHas('product_model', function ($q) use ($product) {
                $q->where('product_id', $product);
            });
        }

        // Get filtered data
        $Job_Giving = $Job_Giving->get();

        // Map data for DataTables
        $data = $Job_Giving->map(function ($job_giving) {
            return [
                'id' => $job_giving->id,
                'company_name' => $job_giving->employee->company->company_name ?? '-',
                'employee_code' => $job_giving->employee->employee_code ?? '-',
                'employee_name' => $job_giving->employee->employee_name ?? '-',
                'customer_order_no' => $job_giving->order_details->orderNo->customer_order_no ?? '-',
                'dc_no' => $job_giving->deliveryChellan->dc_no ?? '-',
                'model_code' => $job_giving->product_model->model_code ?? '-',
                'model_name' => $job_giving->product_model->model_name ?? '-',
                'product_size' => $job_giving->product_model->productSize->code ?? '-',
                'product_color' => $job_giving->order_details->productColor->code ?? '-',
                'quantity' => $job_giving->quantity ?? '-',
                'pending_quantity' => $job_giving->pending_quantity ?? '-',
                'given_date' => $job_giving->created_at->format('d/m/Y') ?? '-',
                'received_date' => $job_giving->jobReceived
                ? Carbon::parse($job_giving->jobReceived->receving_date)->format('d-m-Y')
                : '-',
                'status' => $job_giving->status ?? '-',
            ];
        });

        // Return data to DataTables
        return DataTables::of($data)->make(true);
    }

    // store
    public function store(Request $request)
{
    $input = $request->all();
    $jobGiving = JobGiving::find($input['job_giving_id']);

    // Check if JobGiving status is "Complete"
    if ($jobGiving && $jobGiving->status == 'Complete') {
        return redirect()->back()->with('error', 'This Job Giving is already completed and no quantity is available.');
    }
    $jobReceived = new JobReceived();

    $input['conveyance'] = $input['conveyance'] ?? 0;
    $input['deduction'] = $input['deduction'] ?? 0;
    $input['incentive'] = $input['incentive'] ?? 0;

    // Store JobReceived data
    $jobReceived->job_giving_id = $input['job_giving_id'];
    $jobReceived->incentive_applicable = $input['Incentive_status'];
    $jobReceived->receving_date = $input['receiving_date'];
    $jobReceived->wages = $input['wages'];
    $jobReceived->status = $input['received_status'];
    $jobReceived->complete_quantity = $input['received_quantity'];
    $jobReceived->before_days = $input['before_days'] ?? null;
    $jobReceived->after_days = $input['after_days'];
    $jobReceived->current_weight = $input['current_weight'];
    $jobReceived->conveyance_fee = $input['conveyance'];
    $jobReceived->deducation_fee = $input['deduction'];
    $jobReceived->incentive_fee = $input['incentive'];
    $jobReceived->total_amount = $input['total_amount'];
    $jobReceived->net_amount = $input['net_amount'];

    // Get JobGiving ID and pending quantity
    $jobGivingId = $input['job_giving_id'];
    $pendingQuantity = $input['pending_quantity'];

    // Check if pending_quantity is 0, set status to 'Complete'
    if ($pendingQuantity == 0) {
        $jobReceived->status = 'Complete';
    }

    // Save the JobReceived record
    $jobReceived->save();

    // Retrieve the JobGiving record and update its pending_quantity
    $jobGiving = JobGiving::find($jobGivingId);
    if ($jobGiving) {
        $jobGiving->pending_quantity = $pendingQuantity;
        
        // If pending quantity is 0, set status to 'Complete'
        if ($pendingQuantity == 0) {
            $jobGiving->status = 'Complete';
        }

        $jobGiving->save();
    }

    return redirect()->route('job_allocation.job_received.index')
        ->with('success', 'Job Received Created Successfully');
}




    public function edit(Request $request, $id)
    {
        $Job_Giving = JobGiving::with('employee', 'order_details', 'product_model', 'deliveryChellan')->find($id);
        // Fetch the job_received data
        $jobReceivedData = JobReceived::where('job_giving_id', $id)->latest()->first();
        $completeQuantitySum = intval(JobReceived::where('job_giving_id', $id)
        ->sum('complete_quantity'));
        return view('pages.job_allocation.job_received.edit', compact('Job_Giving', 'jobReceivedData', 'id', 'completeQuantitySum'));
    }

       public function export(Request $request)
    {
        return Excel::download(new JobReceivedExport($request->all()), 'JobReceivedDatas_' . date('d-m-Y') . '.xlsx');
    }


    public function getJobReceivedHistory($id)
    {
        // dd($id);
        $jobReceived = JobReceived::where('job_giving_id', $id)
            ->with(['jobGiving.product_model']) // Load related product_model
            ->select(
                'id',
                'job_giving_id', 
                'receving_date', 
                'complete_quantity', 
                'conveyance_fee', 
                'deducation_fee', 
                'incentive_fee', 
                'total_amount', 
                'wages',
                'created_at'
            )
            ->get()
            ->map(function ($item) {
                $item->receving_date = Carbon::parse($item->receving_date)->format('d/m/Y');
                $item->wages_product = $item->jobGiving->product_model->wages_product ?? 0; // Get wages data
                return $item;
            });
    
        return response()->json([
            'success' => true,
            'data' => $jobReceived,
        ]);
    }


    public function update(Request $request)
    {
        Log::info('Update request:', $request->all());
    
        $request->validate([
            'id' => 'required|exists:job_receiveds,id',
            'receving_date' => 'required|date',
            'complete_quantity' => 'required|integer|min:0',
            'conveyance_fee' => 'nullable|numeric|min:0',
            'deducation_fee' => 'nullable|numeric|min:0',
            'incentive_fee' => 'nullable|numeric|min:0',
            'total_amount' => 'required|numeric|min:0',
        ]);
    
        try {
            $jobReceived = JobReceived::findOrFail($request->id);
    
            $jobReceived->update([
                'receving_date' => $request->receving_date,
                'complete_quantity' => $request->complete_quantity,
                'conveyance_fee' => $request->conveyance_fee,
                'deducation_fee' => $request->deducation_fee,
                'incentive_fee' => $request->incentive_fee,
                'total_amount' => $request->total_amount,
            ]);
    
            return response()->json(['success' => true, 'message' => 'Record updated successfully']);
        } catch (\Exception $e) {
            Log::error('Update failed: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'Error updating record']);
        }
    }
    
    




}
    