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
use App\Models\DeliveryChallan;
use Illuminate\Support\Facades\DB;

class JobReallocationController extends Controller
{
    // Index Page
    public function index()
    {
        return view('pages.job_allocation.job_reallocation.index');
    }
    // Index DataTable
    public function indexData()
    {
        $Job_Giving = JobGiving::with('employee', 'order_details', 'deliveryChellan')->get();
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
                'given_date' => $job_giving->created_at->format('d/m/Y') ?? null,
                'status' => $job_giving->status ?? null,
        ];
    });
        return DataTables::of($data)->make(true);
    }
    // store
    public function store(Request $request)
    {
        // dd($request);
        $validated = $request->validate([
            'job_giving_id' => 'required|exists:job_givings,id',
            'employee_id' => 'required|exists:employees,id',
            'receiving_date' => 'required|date',
            'quantity' => 'required|numeric|min:1',
            'available_quantity' => 'required|numeric|min:1',
            'company_id' => 'required|exists:companies,id',
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

            // Save JobAllocationHistory
            $jobReceived = new JobAllocationHistory();
            $jobReceived->job_giving_id = $validated['job_giving_id'];
            $jobReceived->employee_id = $validated['employee_id'];
            $jobReceived->receving_date = $validated['receiving_date'];
            $jobReceived->quantity = $validated['quantity'];
            $jobReceived->save();
            
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
            $newJobGiving->quantity = $jobGivingData->quantity;
            $newJobGiving->pending_quantity = $newPendingQuantity;
            $newJobGiving->save();

            // Save new DeliveryChallan
            $deliveryChallan = DeliveryChallan::find($jobGivingData->dc_id);
            if ($deliveryChallan) {
                $newDeliveryChallan = $deliveryChallan->replicate();
                $newDeliveryChallan->company_id = $validated['company_id'];
                $newDeliveryChallan->save();
            }

            // Save to JobReceived with complete_quantity
            $jobReceivedEntry = new JobReceived();
            $jobReceivedEntry->job_giving_id = $validated['job_giving_id'];
            $jobReceivedEntry->receving_date = $validated['receiving_date'];
            $jobReceivedEntry->complete_quantity = $validated['quantity'];
            $jobReceivedEntry->total_amount = $validated['total_amount'];
            $jobReceivedEntry->net_amount = $validated['total_amount']; 
            $jobReceivedEntry->save();


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
       
                $Job_Giving = JobGiving::with('employee', 'order_details','product_model','deliveryChellan')->find($id);
         
                 $jobReceivedData = JobReceived::where('job_giving_id', $id)->latest()->first();

               $employee = Employee::with(['company' => function ($query) {
                $query->with('companyType');
                 }])->get();

        $completeQuantitySum = intval(JobReceived::where('job_giving_id', $id)
        ->sum('complete_quantity'));
        // dd($completeQuantitySum);
        return view('pages.job_allocation.job_reallocation.edit', compact('Job_Giving','jobReceivedData','id','employee', 'completeQuantitySum'));
    }

    public function cancelJobGiving($id)
{
    // Find the job giving record
    $jobGiving = JobGiving::find($id);

    if ($jobGiving) {
        // Update the status to 'Cancelled'
        $jobGiving->status = 'Cancelled';
        $jobGiving->save();

        return redirect()->route('job_allocation.job_reallocation.index')
            ->with('success', 'Job Giving Cancelled Successfully');
    } else {
        // Handle case where job giving record is not found
        return redirect()->route('job_allocation.job_reallocation.index')
            ->with('error', 'Job Giving not found');
    }
}

 public function export(Request $request)
    {
        return Excel::download(new JobReallocationExport($request->all()), 'JobReallocationExportDatas_' . date('d-m-Y') . '.xlsx');
    }
}
