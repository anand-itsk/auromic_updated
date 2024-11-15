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
        // Retrieve all input data
        $input = $request->all();

        // Create a new JobAllocationHistory instance and set the data
        $jobReceived = new JobAllocationHistory();
        $jobReceived->job_giving_id = $input['job_giving_id'];
        $jobReceived->employee_id = $input['employee_id'];
        $jobReceived->receving_date = $input['receiving_date'];
        $jobReceived->quantity = $input['quantity'];

        // Check if the quantity exceeds the available balance quantity
        $balanceQuantity = $input['available_quantity'];
        if ($jobReceived->quantity > $balanceQuantity) {
            return redirect()->route('job_allocation.job_reallocation.index')
            ->with('error', 'No available quantity for this order');
        }

        // Retrieve data from JobGiving using the job_giving_id
        $jobGivingData = JobGiving::find($input['job_giving_id']);

        if (!$jobGivingData) {
            return redirect()->route('job_allocation.job_reallocation.index')
            ->with('error', 'Invalid Job Giving ID');
        }

        // Create a new JobGiving record and set additional data from the retrieved job_giving data
        $newJobGiving = new JobGiving();
        $newJobGiving->employee_id = $input['employee_id'];
        $newJobGiving->order_id = $jobGivingData->order_id;
        $newJobGiving->product_model_id = $jobGivingData->product_model_id; // Retrieved from JobGiving
        $newJobGiving->dc_id = $jobGivingData->dc_id;       // Retrieved from JobGiving
        $newJobGiving->weight = $jobGivingData->weight;          // Set from input
        $newJobGiving->excess = $jobGivingData->excess;           // Set from input
        $newJobGiving->shortage = $jobGivingData->shortage;       // Set from input
        $newJobGiving->days = $jobGivingData->days;
        $newJobGiving->quantity = $input['quantity'];      // Set from input

        // Save the new JobGiving record
        $newJobGiving->save();

        // Optionally, link this new job_giving_id to the JobAllocationHistory if needed
        $jobReceived->job_giving_id = $newJobGiving->id; // Linking the new job_giving_id
        $jobReceived->save(); // Update the JobAllocationHistory with the new job_giving_id

        // Redirect back with success message
        return redirect()->route('job_allocation.job_reallocation.index')
        ->with('success', 'Job Reallocation Created and Linked Successfully');
    }






        public function edit(Request $request, $id)
    {
       
                $Job_Giving = JobGiving::with('employee', 'order_details','product_model','deliveryChellan')->find($id);
         
                 $jobReceivedData = JobReceived::where('job_giving_id', $id)->latest()->first();

               $employee = Employee::with(['company' => function ($query) {
                $query->with('companyType');
                 }])->get();

        // dd($JobGiving);
        return view('pages.job_allocation.job_reallocation.edit', compact('Job_Giving','jobReceivedData','id','employee'));
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
