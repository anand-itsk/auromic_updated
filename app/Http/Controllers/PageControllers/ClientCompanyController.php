<?php

namespace App\Http\Controllers\PageControllers;

use App\Exports\CompanyExport;
use App\Http\Controllers\Controller;
use App\Imports\CompanyDataImport;
use App\Models\Address;
use App\Models\AddressType;
use App\Models\AuthorisedPerson;
use App\Models\Company;
use App\Models\CompanyRegistrationDetails;
use App\Models\Country;
use App\Models\State;
use App\Models\User;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\DataTables\DataTables;

class ClientCompanyController extends Controller
{
    // Index Page
    public function index()
    {
        return view('pages.profile.client_company.index');
    }
    // Index DataTable
    public function indexData()
    {
        // Eager load the roles relationship
        $company = Company::query()->where('company_type_id', 3);
        return DataTables::of($company)->make(true);
    }
    // Create Page
    public function create()
    {
        $countries = Country::all();
        $states = State::all();
        $addressTypes = AddressType::all();
        $master_companies = Company::with('authorisedPerson')
            ->where('company_type_id', 2)
            ->get();
        return view('pages.profile.client_company.create', ['master_companies' => $master_companies, 'countries' => $countries, 'states' => $states, 'addressTypes' => $addressTypes]);
    }
    // Store Date
    public function store(Request $request)
    {
        $auth_id = auth()->id();
        $validatedData = $request->validate([
            'company_code' => 'required|max:255',
            'company_name' => 'required|max:255',
            'name' => 'required',
            'photo' => 'nullable|image|max:200000',
            'person_email' => 'required|email|unique:authorised_people',
        ]);
        $input = $request->all();

         if ($request->hasFile('photo')) {
        $filename = $request->file('photo')->store('profile_images/Client Company', 'public');
        $input['photo'] = $filename;
    }
        $company = new Company();

        $input['company_type_id'] = 3;
        $input['created_by'] = $auth_id;
        $input['updated_by'] = $auth_id;

        $company = $company->create($input);

        $input['company_id'] = $company->id;
        $company_registration_details = CompanyRegistrationDetails::create($input);
        $authorised_person = AuthorisedPerson::create($input);

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
            $company->addresses()->save($address);
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
            $company->addresses()->save($address);
        }

        return redirect()->route('profile.clients.index')
            ->with('success', 'Client Company created successfully');
    }
    // Edit
    public function edit(Address $address, $id)
    {
        // dd($address);
        $user = User::with('roles')->find($id);
        $company = Company::with('addresses','authorisedPerson')->find($id);
        $countries = Country::all();
        return view('pages.profile.client_company.edit', compact('company', 'user', 'countries', 'address'));
    }
    // Update
    public function update(Request $request, $id)
    {
        $auth_id = auth()->id();

        $validatedData = $request->validate([
            'company_code' => 'required|max:255',
            'company_name' => 'required|max:255',
            'name' => 'required',
             'photo' => 'nullable|image|max:200000',
            //  'person_email' => 'required|email|unique:authorised_people',
        ]);

        $input = $request->all();
        $company = Company::findOrFail($id);

        $company->company_type_id = 3;
        $company->company_code = $input['company_code'];
        $company->company_name = $input['company_name'];
        $company->std_code = $input['std_code'];
        $company->phone = $input['phone'];
        $company->company_email = $input['company_email'];
        $company->starting_date = $input['starting_date'];
        $company->business_nature = $input['business_nature'];
        $company->website = $input['website'];
        $company->updated_by = $auth_id;

        $company->save();
        $company_registration_details = CompanyRegistrationDetails::firstOrNew(['company_id' => $company->id]);
        // dd($company_registration_details);

        $company_registration_details->pf_code = $input['pf_code'];
        $company_registration_details->pf_date = $input['pf_date'];
        $company_registration_details->esi_code = $input['esi_code'];
        $company_registration_details->esi_date = $input['esi_date'];
        $company_registration_details->factory_act_no = $input['factory_act_no'];
        $company_registration_details->tin_no = $input['tin_no'];
        $company_registration_details->cst_no = $input['cst_no'];
        $company_registration_details->ssi_no = $input['ssi_no'];
        $company_registration_details->pan_no = $input['pan_no'];
        $company_registration_details->tan_no = $input['tan_no'];
        $company_registration_details->license_no = $input['license_no'];
        $company_registration_details->tin_no = $input['tin_no'];
        $company_registration_details->updated_by = $auth_id;

        $company_registration_details->save();

        $authorised_person = AuthorisedPerson::firstOrNew(['company_id' => $company->id]);
        $authorised_person->name = $input['name'];
        $authorised_person->faorhus_name = $input['faorhus_name'];
        $authorised_person->gender = $input['gender'];
        $authorised_person->blood_group = $input['blood_group'];
        $authorised_person->dob = $input['dob'];
       $authorised_person->person_email = $input['person_email'];
        $authorised_person->pan_no = $input['pan_no'];
        $authorised_person->std_code = $input['std_code'];
        $authorised_person->phone = $input['phone'];
        $authorised_person->mobile = $input['mobile'];

        if ($request->hasFile('photo')) {
        $filename1 = $request->file('photo')->store('profile_images/Client Company', 'public');
        $authorised_person->update(['photo' => $filename1]);
    }

        $authorised_person->save();


        // Handle office address update
        if ($input['office_address'] || $input['office_country_id'] != "1" || $input['office_pincode']) {
            $officeAddress = $company->addresses()->where('address_type_id', 2)->first() ?: new Address();
            $officeAddress->address_type_id = 2;
            $officeAddress->address = $input['office_address'];
            $officeAddress->country_id = $input['office_country_id'];
            $officeAddress->state_id = $input['office_state_id'] ?? 1;
            $officeAddress->pincode = $input['office_pincode'];
            $company->addresses()->save($officeAddress);
        }

        // Handle home address update
        if ($input['address'] || $input['country_id'] != "1" || $input['pincode']) {
            $homeAddress = $company->addresses()->where('address_type_id', 3)->first() ?: new Address();
            $homeAddress->address_type_id = 3;
            $homeAddress->address = $input['address'];
            $homeAddress->country_id = $input['country_id'];
            $homeAddress->state_id = $input['state_id'] ?? 1;
            $homeAddress->pincode = $input['pincode'];
            $company->addresses()->save($homeAddress);
        }
        return redirect()->route('profile.clients.index')
            ->with('success', 'Client Company Updated successfully');
    }
    // Show
    public function showDetails($id)
    {
        $company = Company::with('addresses', 'companyRegistrationDetail', 'authorisedPerson')->findOrFail($id);
        $html = view('pages.profile.client_company.show', compact('company'))->render();
        return response()->json([
            'html' => $html,
            'data' => [
                'created_by' => $company->createdBy->name,
                'created_at' => $company->created_at,
                'updated_at' => $company->updated_at,
                'updated_by' => $company->updatedBy->name,
            ]
        ]);
    }
    // Delete
    public function destroy($id)
    {
        $company = Company::findOrFail($id);
        $company->delete();

        return response()->json(['success' => 'Company deleted successfully']);
    }
    // Multi Delete
    public function deleteSelected(Request $request)
    {

        $ids = $request->ids;

        if (!is_array($ids)) {
            return response()->json(['status' => 'error', 'message' => 'Invalid input'], 400);
        }

        Company::destroy($ids);
        return response()->json(['status' => 'success']);
    }

     
    // Import Users
    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:xlsx,csv'
        ]);
        $company_type_id = 3;
        Excel::import(new CompanyDataImport($company_type_id), request()->file('file'));

        return redirect()->route('profile.clients.index')->with('success', 'Data imported successfully');
    }
    // Import Users
    public function export(Request $request)
    {
        return Excel::download(new CompanyExport($request->all()), 'CustomerDatas_' . date('d-m-Y') . '.xlsx');
    }
}