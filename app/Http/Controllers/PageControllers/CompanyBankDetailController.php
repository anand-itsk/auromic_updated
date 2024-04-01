<?php

namespace App\Http\Controllers\PageControllers;

use App\Http\Controllers\Controller;
use App\Models\BankDetail;
use App\Models\Company;
use App\Models\CompanyBankDetail;
use App\Models\CompanyBankDetails;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Services\RazorpayIFSCService;

class CompanyBankDetailController extends Controller
{
    // Index Page
    public function index()
    {
        return view('pages.profile.company_bank.index');
    }
    // Index DataTable
    public function indexData()
    {
        // Eager load the roles relationship
        $company = Company::query();
        return DataTables::of($company)->make(true);
    }
    // Create Page
    public function create()
    {

        $companies = Company::with('authorisedPerson', 'bankDetail')
            ->get();
        // dd($companies);
        return view('pages.profile.company_bank.create', ['companies' => $companies]);
    }
    // Store Date
    public function store(Request $request)
    {
        $auth_id = auth()->id();
        $validatedData = $request->validate([
            'company_id' => 'required|string|max:255',
            'bank_name' => 'required|string|max:255',
            'account_number' => 'required|string|max:255',
        ]);
        $input = $request->all();
        $bank_detail = new BankDetail();

        $bank_detail = $bank_detail->create($input);

        $company = Company::find($input['company_id']);
        $company->bankDetail()->attach($bank_detail->id);


        return redirect()->route('profile.bank_details.index')
            ->with('success', 'Bank Details created successfully');
    }
    // Edit
    public function edit(Address $address, $id)
    {
        // dd($address);
        $user = User::with('roles')->find($id);
        $company = Company::with('addresses')->find($id);
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
            'name' => 'required'
        ]);

        $input = $request->all();
        $company = Company::findOrFail($id);

        $company->company_type_id = 2;
        $company->company_code = $input['company_code'];
        $company->company_name = $input['company_name'];
        $company->std_code = $input['std_code'];
        $company->phone = $input['phone'];
        $company->email = $input['email'];
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
        $company_registration_details->gst_no = $input['gst_no'];
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
        $authorised_person->email = $input['email'];
        $authorised_person->pan_no = $input['pan_no'];
        $authorised_person->std_code = $input['std_code'];
        $authorised_person->phone = $input['phone'];
        $authorised_person->mobile = $input['mobile'];

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
            ->with('success', 'Customer created successfully');
    }
    // Show
    public function showDetails($id)
    {
//        $company_bank_details = CompanyBankDetail::get();
//        return $company_bank_details;

//        if($company_bank_details->company_id === $id)

// {
    

// }       
$company = Company::with('addresses', 'companyRegistrationDetail', 'authorisedPerson')->findOrFail($id);
         $bank_details = CompanyBankDetail::where('company_id', $id)->with('bankDetail')->get();
        $html = view('pages.profile.company_bank.show', compact('company','bank_details'))->render();
        // dd($html);
        // return "sample";
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
        $company_type_id = 2;
        Excel::import(new CompanyDataImport($company_type_id), request()->file('file'));

        return redirect()->route('profile.clients.index')->with('success', 'Data imported successfully');
    }
    // Import Users
    public function export(Request $request)
    {
        return Excel::download(new CompanyExport($request->all()), 'CustomerDatas_' . date('d-m-Y') . '.xlsx');
    }



        public function getIFSC(Request $request, RazorpayIFSCService $razorpayIFSCService)
    {

        $bankName = $request->input('bank_name');
        $branchName = $request->input('branch_name');

         $razorpayIFSCService = new RazorpayIFSCService();
          $ifscData = $razorpayIFSCService->searchIFSCByBankAndBranch($bankName, $branchName);

        // Process $ifscData as needed

        return response()->json($ifscData);
    }
}
