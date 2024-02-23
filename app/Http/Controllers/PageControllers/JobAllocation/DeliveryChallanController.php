<?php

namespace App\Http\Controllers\PageControllers\JobAllocation;

use App\Http\Controllers\Controller;
use App\Models\AuthorisedPerson;
use App\Models\Company;
use App\Models\DeliveryChallan;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class DeliveryChallanController extends Controller
{

    // Index Page
    public function index()
    {
        return view('pages.job_allocation.delivery_challan.index');
    }
    // Index DataTable
    public function indexData()
    {
        $delivery_challans = DeliveryChallan::with('company', 'order_details')->get();
        return DataTables::of($delivery_challans)->make(true);
    }
    // Create Page
    public function create()
    {
        $company = Company::all();
        $authorised_people = AuthorisedPerson::all();
        $order_details = OrderDetail::all();
        return view('pages.job_allocation.delivery_challan.create', compact('company', 'authorised_people', 'order_details'));
    }
    // Store Date
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'company_id' => 'required',
            'dc_number' => 'required',
            'order_id' => 'required'
        ]);
        $input = $request->all();
        $delivery_challan = new DeliveryChallan();
        $delivery_challan->company_id = $input['company_id'];
        $delivery_challan->dc_no = $input['dc_number'];
        $delivery_challan->order_id = $input['order_id'];

        $delivery_challan->save();

        return redirect()->route('job_allocation.delivery_challan.index')
            ->with('success', 'Delivery challan created successfully');
    }

    // Edit
    public function edit(Request $request, $id)
    {
        $delivery_challans = DeliveryChallan::find($id);
        $company = Company::all();
        $authorised_people = AuthorisedPerson::all();
        $order_details = OrderDetail::all();
        return view('pages.job_allocation.delivery_challan.edit', compact('company', 'authorised_people', 'order_details', 'delivery_challans'));
    }
    // Update
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'company_id' => 'required',
            'dc_number' => 'required',
            'order_id' => 'required'
        ]);
        $input = $request->all();

        $delivery_challan = DeliveryChallan::find($id);
        $delivery_challan->company_id = $input['company_id'];
        $delivery_challan->dc_no = $input['dc_number'];
        $delivery_challan->order_id = $input['order_id'];

        $delivery_challan->save();


        return redirect()->route('job_allocation.delivery_challan.index')
            ->with('success', 'Delivery challan Updated successfully');
    }
    // Multi Delete
    public function deleteSelected(Request $request)
    {

        $ids = $request->ids;

        if (!is_array($ids)) {
            return response()->json(['status' => 'error', 'message' => 'Invalid input'], 400);
        }

        DeliveryChallan::destroy($ids);
        return response()->json(['status' => 'success']);
    }
}
