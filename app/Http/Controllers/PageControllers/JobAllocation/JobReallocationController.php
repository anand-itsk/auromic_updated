<?php

namespace App\Http\Controllers\PageControllers\JobAllocation;

use App\Http\Controllers\Controller;
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
    // Edit
    public function edit(Request $request, $id)
    {
        $job_received_data = JobGiving::find($id);
        $employee = Employee::all();
        // Combine data into an array
        $data = [
            'direct_job_giving' => $job_received_data,
            'empolyee_data' => $employee,
        ];

        // Return combined data as JSON response
        return response()->json($data);
        // return response()->json($job_received_data);
    }
}
