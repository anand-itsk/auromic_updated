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
        $job_received = JobReceived::get();
        return DataTables::of($Job_Giving, $job_received)->make(true);
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
        $jobReceived->complete_quantity = $input['received_quantity'];
        $jobReceived->before_days = $input['before_days'];
        $jobReceived->after_days = $input['after_days'];
        $jobReceived->current_weight = $input['current_weight'];
        $jobReceived->conveyance_fee = $input['conveyance'];
        $jobReceived->deducation_fee = $input['deduction'];
        $jobReceived->incentive_fee = $input['incentive'];
        $jobReceived->total_amount = $input['total_amount'];
        $jobReceived->net_amount = $input['net_amount'];

        // dd($jobReceived);
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

    public function edit(Request $request, $id)
    {
        $Job_Giving = JobGiving::with('employee', 'order_details', 'product_model', 'delivery_chellan')->find($id);
        // Fetch the job_received data
        $jobReceivedData = JobReceived::where('job_giving_id', $id)->latest()->first();
        return view('pages.job_allocation.job_received.edit', compact('Job_Giving', 'jobReceivedData', 'id'));
    }
}
