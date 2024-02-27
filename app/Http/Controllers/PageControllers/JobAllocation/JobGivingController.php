<?php

namespace App\Http\Controllers\PageControllers\JobAllocation;

use App\Http\Controllers\Controller;
use App\Models\DeliveryChallan;
use App\Models\Employee;
use App\Models\Company;
use App\Models\JobGiving;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class JobGivingController extends Controller
{

    // Index Page
    public function index()
    {
        return view('pages.job_allocation.job_giving.index');
    }
    // Index DataTable
    public function indexData()
    {
        $Job_Giving = JobGiving::with('employee', 'order_details', 'delivery_chellan')->get();
        return DataTables::of($Job_Giving)->make(true);
    }
    // Create Page
    public function create()
    {
        $delivery_challan = DeliveryChallan::all();
        $order_details = OrderDetail::all();
        $employee = Employee::all();

        
        return view('pages.job_allocation.job_giving.create', compact('delivery_challan', 'order_details', 'employee'));
    }

 
    // Store Date
    public function store(Request $request)
    {
        $input = $request->all();
        // dd($input);
        $job_giving = new JobGiving();
        $job_giving->employee_id = $input['employee_id'];
        $job_giving->order_id = $input['order_id'];
        // Check if dc_number is provided in the request
        if (isset($input['dc_number'])) {
            $job_giving->dc_id = $input['dc_number'];
        } else {
            $job_giving->dc_id = null; // Set dc_id to null if dc_number is not provided
        }

        $job_giving->status = $input['status'];

        $job_giving->save();

        return redirect()->route('job_allocation.job_giving.index')
            ->with('success', 'Job Giving Created Successfully');
    }

    // Edit
    public function edit(Request $request, $id)
    {
        // $delivery_challans = DeliveryChallan::find($id);
        // $company = Company::all();
        // $authorised_people = AuthorisedPerson::all();
        // $order_details = OrderDetail::all();
        // return view('pages.job_allocation.delivery_challan.edit', compact('company', 'authorised_people', 'order_details', 'delivery_challans'));
        $delivery_challan = DeliveryChallan::all();
        $order_details = OrderDetail::all();
        $employee = Employee::all();
        $JobGiving = JobGiving::find($id);
        // dd($JobGiving);
        return view('pages.job_allocation.job_giving.edit', compact('delivery_challan', 'order_details', 'employee', 'JobGiving'));
    }
    // Update
    public function update(Request $request, $id)
    {

        $input = $request->all();

        $job_giving = JobGiving::find($id);
        $job_giving->employee_id = $input['employee_id'];
        $job_giving->order_id = $input['order_id'];
        if (isset($input['dc_number'])) {
            $job_giving->dc_id = $input['dc_number'];
        } else {
            $job_giving->dc_id = null; // Set dc_id to null if dc_number is not provided
        }

        $job_giving->status = $input['status'];

        $job_giving->save();


        return redirect()->route('job_allocation.job_giving.index')
            ->with('success', 'Job Giving Updated successfully');
    }

    // Multi Delete
    public function deleteSelected(Request $request)
    {

        $ids = $request->ids;

        if (!is_array($ids)) {
            return response()->json(['status' => 'error', 'message' => 'Invalid input'], 400);
        }

        JobGiving::destroy($ids);
        return response()->json(['status' => 'success']);
    }
}
