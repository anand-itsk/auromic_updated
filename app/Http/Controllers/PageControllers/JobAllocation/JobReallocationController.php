<?php

namespace App\Http\Controllers\PageControllers\JobAllocation;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Employee;
use App\Models\JobAllocationHistory;
use App\Models\JobGiving;
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
        return DataTables::of($Job_Giving)->make(true);
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
        // Save the job received data
        $jobReceived->save();

        // Update the status in the JobGiving table
        $jobGivingId = $input['job_giving_id'];
        $employee_id = $input['employee_id'];

        // Update the status in the JobGiving table
        JobGiving::where('id', $jobGivingId)->update(['employee_id' => $employee_id]);


        // Redirect back with success message
        return redirect()->route('job_allocation.job_reallocation.index')
            ->with('success', 'Job Reallocation Updated Successfully');
    }
   

        public function edit(Request $request, $id)
    {
       
                $Job_Giving = JobGiving::with('employee', 'order_details','product_model')->find($id);
         
               $received_date = $Job_Giving->job_received->receving_date ?? '';

               $employee = Employee::with(['company' => function ($query) {
                $query->with('companyType');
                 }])->get();

        // dd($JobGiving);
        return view('pages.job_allocation.job_reallocation.edit', compact('Job_Giving','received_date','id','employee'));
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
