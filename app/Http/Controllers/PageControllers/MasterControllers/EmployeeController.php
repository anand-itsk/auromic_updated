<?php

namespace App\Http\Controllers\PageControllers\MasterControllers;

use App\Http\Controllers\Controller;
use App\Models\AddressType;
use App\Models\Country;
use App\Models\Employee;
use App\Models\State;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class EmployeeController extends Controller
{
    // Index Page
    public function index()
    {
        return view('pages.master.employee.index');
    }
    // Index DataTable
    public function indexData()
    {
        // Eager load the roles relationship
        $company = Employee::query();
        return DataTables::of($company)->make(true);
    }
    // Create Page
    public function create()
    {
        $countries = Country::all();
        $states = State::all();
        $addressTypes = AddressType::all();
        return view('pages.master.employee.create', ['countries' => $countries, 'states' => $states, 'addressTypes' => $addressTypes]);
    }
    // Store Date
    public function store(Request $request)
    {
        $auth_id = auth()->id();
        $validatedData = $request->validate([
            'customer_code' => 'required|max:255',
            'customer_name' => 'required|max:255',
            'std_code' => 'required_with:phone'
        ]);
        $input = $request->all();
        $customer = new Customer();

        $customer->customer_code = $input['customer_code'];
        $customer->customer_name = $input['customer_name'];
        $customer->std_code = $input['std_code'];
        $customer->phone = $input['phone'];
        $customer->email = $input['email'];
        $customer->mobile = $input['mobile'];
        $customer->tin_no = $input['tin_no'];
        $customer->tin_date = $input['tin_date'];
        $customer->cst_no = $input['cst_no'];
        $customer->cst_date = $input['cst_date'];
        $input['created_by'] = $auth_id;
        $input['updated_by'] = $auth_id;
        $customer = $customer->create($input);

        if (
            $input['office_address'] !== null ||
            $input['office_country_id'] !== "1" ||
            $input['office_pincode'] !== null
        ) {
            $address = new Address();
            $address->address_type_id = 2;
            $address->address = $input['office_address'];
            $address->country_id = $input['office_country_id'];
            $address->state_id = $input['office_state_id'] ?? 1;
            $address->pincode = $input['office_pincode'];
            $customer->addresses()->save($address);
        }

        if (
            $input['address'] !== null ||
            $input['country_id'] !== "1" ||
            $input['pincode'] !== null
        ) {
            $address = new Address();
            $address->address_type_id = 3;
            $address->address = $input['address'];
            $address->country_id = $input['country_id'];
            $address->state_id = $input['state_id'] ?? 1;
            $address->pincode = $input['pincode'];
            $customer->addresses()->save($address);
        }

        return redirect()->route('master.customers.index')
            ->with('success', 'Customer created successfully');
    }
    // Edit
    public function edit(Address $address, $id)
    {
        // dd($address);
        $user = User::with('roles')->find($id);
        $customer = Customer::with('addresses')->find($id);
        $countries = Country::all();
        // dd($customer);
        return view('pages.master.customer.edit', compact('customer', 'user', 'countries', 'address'));
    }
    // Update
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'customer_code' => 'required|max:255',
            'customer_name' => 'required|max:255',
            'std_code' => 'required_with:phone'
        ]);

        $input = $request->all();
        $customer = Customer::findOrFail($id);

        $customer->customer_code = $input['customer_code'];
        $customer->customer_name = $input['customer_name'];
        $customer->std_code = $input['std_code'];
        $customer->phone = $input['phone'];
        $customer->email = $input['email'];
        $customer->mobile = $input['mobile'];
        $customer->tin_no = $input['tin_no'];
        $customer->tin_date = $input['tin_date'];
        $customer->cst_no = $input['cst_no'];
        $customer->cst_date = $input['cst_date'];

        $customer->save();

        // Handle office address update
        if ($input['office_address'] || $input['office_country_id'] != "1" || $input['office_pincode']) {
            $officeAddress = $customer->addresses()->where('address_type_id', 2)->first() ?: new Address();
            $officeAddress->address_type_id = 2;
            $officeAddress->address = $input['office_address'];
            $officeAddress->country_id = $input['office_country_id'];
            $officeAddress->state_id = $input['office_state_id'] ?? 1;
            $officeAddress->pincode = $input['office_pincode'];
            $customer->addresses()->save($officeAddress);
        }

        // Handle home address update
        if ($input['address'] || $input['country_id'] != "1" || $input['pincode']) {
            $homeAddress = $customer->addresses()->where('address_type_id', 3)->first() ?: new Address();
            $homeAddress->address_type_id = 3;
            $homeAddress->address = $input['address'];
            $homeAddress->country_id = $input['country_id'];
            $homeAddress->state_id = $input['state_id'] ?? 1;
            $homeAddress->pincode = $input['pincode'];
            $customer->addresses()->save($homeAddress);
        }

        return redirect()->route('master.customers.index')
            ->with('success', 'Customer updated successfully');
    }
    // Show
    public function showDetails($id)
    {
        $customer = Customer::with('addresses')->findOrFail($id);
        $html = view('pages.master.customer.show', compact('customer'))->render();
        return response()->json([
            'html' => $html,
            'data' => [
                'created_by' => $customer->createdBy->name,
                'created_at' => $customer->created_at,
                'updated_at' => $customer->updated_at,
                'updated_by' => $customer->updatedBy->name,
            ]
        ]);
    }
    // Delete
    public function destroy($id)
    {
        $user = Customer::findOrFail($id);
        $user->delete();

        return response()->json(['success' => 'Customer deleted successfully']);
    }
    // Multi Delete
    public function deleteSelected(Request $request)
    {

        $ids = $request->ids;

        if (!is_array($ids)) {
            return response()->json(['status' => 'error', 'message' => 'Invalid input'], 400);
        }

        Customer::destroy($ids);
        return response()->json(['status' => 'success']);
    }
    // Import Users
    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:xlsx,csv'
        ]);

        Excel::import(new CustomerDataImport, request()->file('file'));

        return redirect()->route('master.customers.index')->with('success', 'Data imported successfully');
    }
    // Import Users
    public function export(Request $request)
    {
        return Excel::download(new CustomersExport($request->all()), 'CustomerDatas_' . date('d-m-Y') . '.xlsx');
    }
}
