<?php

namespace App\Http\Controllers\PageControllers\JobAllocation;

use App\Http\Controllers\Controller;
use App\Models\JobGiving;
use App\Models\JobReceived;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class JobReceivedController extends Controller
{
    // Index Page
    public function index()
    {
        return view('pages.job_allocation.job_received.index');
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
        $jobReceived = new JobReceived();
        $jobReceived->job_giving_id = $input['job_giving_id'];
        $jobReceived->incentive_applicable = $input['Incentive_status'];
        $jobReceived->receving_date = $input['receiving_date'];
        $jobReceived->status = $input['received_status'];

        // Save the job received data
        $jobReceived->save();

        // Update the status in the JobGiving table
        $jobGivingId = $input['job_giving_id'];
        $newStatus = $input['received_status'];

        // Update the status in the JobGiving table
        JobGiving::where('id', $jobGivingId)->update(['status' => $newStatus]);


        // Redirect back with success message
        return redirect()->route('job_allocation.job_received.index')
            ->with('success', 'Job Received Created Successfully');
    }
    // Edit
    public function edit(Request $request, $id)
    {
        $job_received_data = JobGiving::find($id);
        return response()->json($job_received_data);
    }
}
