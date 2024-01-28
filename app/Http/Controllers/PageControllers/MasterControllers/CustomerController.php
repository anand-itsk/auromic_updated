<?php

namespace App\Http\Controllers\PageControllers\MasterControllers;

use App\Http\Controllers\Controller;
use App\Models\Address;
use App\Models\AddressType;
use App\Models\Country;
use App\Models\Customer;
use App\Models\State;
use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class CustomerController extends Controller
{
    // Index Page
    public function index()
    {
        return view('pages.master.customer.index');
    }
    // Index DataTable
    public function customersData()
    {
        // Eager load the roles relationship
        $customers = Customer::query();
        // dd($customers);
        return DataTables::of($customers)->make(true);
    }
    // Create Page
    public function create()
    {
        $countries = Country::all();
        $states = State::all();
        $addressTypes = AddressType::all();
        return view('pages.master.customer.create', ['countries' => $countries, 'states' => $states, 'addressTypes' => $addressTypes]);
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
            ->with('success', 'User created successfully');
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
    // Updata
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'confirmed',
            'role' => 'required',

        ]);

        $input = $request->all();
        if (!empty($input['password'])) {
            $input['password'] = Hash::make($input['password']);
        } else {
            $input = Arr::except($input, array('password'));
        }
        $user = User::with('roles')->find($id);
        $user->update($input);
        $user->syncRoles($input['role']);
        if ($user) {
            return redirect()->route('users')
                ->with('success', 'User updated successfully');
        }

        return back()->with('failure', 'Please try again');
    }
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return response()->json(['success' => 'User deleted successfully']);
    }

    public function block($id)
    {
        $user = User::findOrFail($id);
        $user->is_blocked = true; // Assuming you have an 'is_blocked' attribute
        $user->save();

        return response()->json(['success' => 'User blocked successfully']);
    }
    // Multi Delete
    public function deleteSelected(Request $request)
    {

        $ids = $request->ids;

        if (!is_array($ids)) {
            return response()->json(['status' => 'error', 'message' => 'Invalid input'], 400);
        }

        User::destroy($ids);
        return response()->json(['status' => 'success']);
    }
    // Import User page
    public function importUserPage()
    {
        return view('settings.masters.users.import');
    }
    // Import Users
    public function importUsers(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:xlsx,csv'
        ]);

        Excel::import(new UserDataImport, request()->file('file'));

        return redirect()->route('users')->with('success', 'Data imported successfully');
    }
}
