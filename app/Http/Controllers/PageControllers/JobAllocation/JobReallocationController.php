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
        $Job_Giving = JobGiving::with('employee', 'order_details', 'delivery_chellan')->get();
        $data = $Job_Giving->map(function ($job_giving) {
        return [
            'id' => $job_giving->id,
            'employee_name' => $job_giving->employee->employee_name ?? null,
            'last_order_number' => $job_giving->order_details->orderNo->last_order_number ?? null,
            'dc_no' => $job_giving->delivery_chellan->dc_no ?? null,
            'status' => $job_giving->status ?? null,
        ];
    });
        return DataTables::of($data)->make(true);
    }
    // store
    public function store(Request $request)
{
    // Create a new JobReceived instance
    $input = $request->all();
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

    // Save the job received data
    $jobReceived->save();

    // Update the status in the JobGiving table
    $jobGivingId = $input['job_giving_id'];
    $employee_id = $input['employee_id'];
    JobGiving::where('id', $jobGivingId)->update(['employee_id' => $employee_id]);

    // Redirect back with success message
    return redirect()->route('job_allocation.job_reallocation.index')
        ->with('success', 'Job Reallocation Updated Successfully');
}


        public function edit(Request $request, $id)
    {
       
                $Job_Giving = JobGiving::with('employee', 'order_details','product_model','delivery_chellan')->find($id);
         
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
}
