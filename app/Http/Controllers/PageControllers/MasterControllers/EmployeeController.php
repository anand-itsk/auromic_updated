<?php

namespace App\Http\Controllers\PageControllers\MasterControllers;

use App\Http\Controllers\Controller;
use App\Models\Address;
use App\Models\AddressType;
use App\Models\Caste;
use App\Models\Company;
use App\Models\CompanyType;
use App\Models\Country;
use App\Models\Customer;
use App\Models\Employee;
use App\Exports\EmployeeExport;
use App\Imports\EmployeeImport;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\EmployeeFamilyMemberDetail;
use App\Models\EmployeeNominee;
use App\Models\EsiDispensary;
use App\Models\LocalOffice;
use App\Models\Nationality;
use App\Models\PaymentMode;
use App\Models\Religion;
use App\Models\ResigningReason;
use App\Models\State;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
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

    // Show Family Member table
    public function getFamilyMembers(Request $request)
    {
        $employeeId = $request->employee_id; // Assuming you pass an employee ID
        $employee = Employee::with('familyMembers')->find($employeeId);

        if (!$employee) {
            return response()->json(['message' => 'Employee not found'], 404);
        }

        return response()->json($employee->familyMembers);
    }

    public function editFamilyMember(Request $request, $id)
    {
        $familyMember = EmployeeFamilyMemberDetail::with('addresses')->find($id);
        if (!$familyMember) {
            return response()->json(['error' => 'Family member not found.'], 404);
        }

        return response()->json($familyMember);
        // return response()->json([
        //     'name' => $familyMember->name,
        //     'relation_with_emp' => $familyMember->relation_with_emp,
        //     'dob' => $familyMember->dob,
        //     'is_residing' => $familyMember->is_residing
        // ]);
    }

    public function updateFamilyMember(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $familyMember = EmployeeFamilyMemberDetail::find($id);
        if (!$familyMember) {
            return response()->json(['error' => 'Family member not found'], 404);
        }

        $familyDetails = $familyMember->update([
            'name' => $request->name,
            'relation_with_emp' => $request->relation_with_emp,
            'dob' => $request->dob,
            'is_residing' => $request->is_residing,
            'remark' => $request->remark,
        ]);

        // Check if the finance detail already has an office address
        if ($familyMember->addresses()->where('address_type_id', 4)->exists()) {
            $address = $familyMember->addresses()->where('address_type_id', 4)->first();
        } else {
            $address = new Address();
            $address->address_type_id = 4; // Assuming this is the type ID for office addresses
        }

        // Update or set office address details for finance detail
        $address->address = $request->family_address;
        $address->village_area = $request->family_area;
        $address->country_id = $request->family_country_id;
        $address->state_id = $request->family_state_id ?? 1;
        $address->district_id = $request->family_district_id ?? 1;
        $address->pincode = $request->family_pincode;

        // Save the address to the finance detail
        $familyMember->addresses()->save($address);

        // Update family member data
        // $familyMember->update($request->all());

        return response()->json([
            'success' => 'Family member updated successfully',
            'emp_id' => $familyMember->employee_id
        ]);
    }

    public function deleteFamilyMember($id)
    {
        $familyMember = EmployeeFamilyMemberDetail::find($id);
        if (!$familyMember) {
            return response()->json(['error' => 'Family member not found.'], 404);
        }
        $emp_id = $familyMember->employee_id;
        $familyMember->delete();


        return response()->json([
            'success' => 'Family member deleted successfully.',
            'emp_id' => $emp_id
        ]);

        // Delete the family member
        // Return success or error message as JSON
    }

    // Create Page
    public function create()
    {
        $countries = Country::all();
        $states = State::all();
        $addressTypes = AddressType::all();
        $company_types = CompanyType::all();
        $religions = Religion::all();
        $castes = Caste::all();
        $nationality = Nationality::all();
        $payment_modes = PaymentMode::all();
        $local_offices = LocalOffice::all();
        $esi_despensaries = EsiDispensary::all();
        $family_members = EmployeeFamilyMemberDetail::all();

        return view('pages.master.employee.create', [
            'company_types' => $company_types,
            'countries' => $countries,
            'states' => $states,
            'addressTypes' => $addressTypes,
            'religions' => $religions,
            'castes' => $castes,
            'nationality' => $nationality,
            'payment_modes' => $payment_modes,
            'local_offices' => $local_offices,
            'esi_despensaries' => $esi_despensaries,
            'family_members' => $family_members
        ]);
    }

    // Store Personal Data
    public function storePersonal(Request $request, $id)
    {
        // dd($request->same_as_permanent_address);
        $rules = [
            'employee_code' => 'required',
            'employee_name' => 'required',
            'dob'   => 'required',
            'joining_date' => 'required'
        ];


        // Validate request
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            // Return error messages if validation fails
            return response()->json(['success' => false, 'errors' => $validator->errors()], 422);
        }

        $employee = Employee::findOrFail($id);
        // dd($request);
        if ($request->hasFile('employee_profile')) {
            $filename = $request->file('employee_profile')->store('employee/profile/image', 'public');
            $employee->photo = $filename;
        }
        // Store data
        $employee->update([
            'company_id' => $request->company_id,
            'employee_code' => $request->employee_code,
            'employee_name' => $request->employee_name,
            'dob' => $request->dob,
            'gender' => $request->gender,
            'blood_group' => $request->blood_group,
            'email' => $request->email,
            'mobile' => $request->mobile,
            'faorhus_name' => $request->faorhus_name,
            'mother_name' => $request->mother_name,
            'marital_status' => $request->marital_status,
            'std_code' => $request->std_code,
            'phone' => $request->phone,
            'religion_id' => $request->religion_id,
            'caste_id' => $request->caste_id,
            'nationality_id' => $request->nationality_id,
            'joining_date' => $request->joining_date,
            'prob_period' => $request->prob_period,
            'confirm_date' => $request->confirm_date,
            'resigning_date' => $request->resigning_date,
            'resigning_reason_id' => 1, // Assuming this is hardcoded or fetched from some other part of the request
        ]);

        if (
            $request->voter_id_number !== null ||
            $request->driving_license_number !== null ||
            $request->pan_number !== null ||
            $request->passport_number !== null ||
            $request->identity_mark !== null
        ) {
            if ($employee->identityProof) {
                $employee->identityProof->update([
                    'voter_id_number' => $request->voter_id_number,
                    'driving_license_number' => $request->driving_license_number,
                    'pan_number' => $request->pan_number,
                    'passport_number' => $request->passport_number,
                    'identity_mark' => $request->identity_mark,
                ]);
            } else {
                $employee->identityProof()->create([
                    'voter_id_number' => $request->voter_id_number,
                    'driving_license_number' => $request->driving_license_number,
                    'pan_number' => $request->pan_number,
                    'passport_number' => $request->passport_number,
                    'identity_mark' => $request->identity_mark,
                ]);
            }
        }


        if ($employee->addresses()->where('address_type_id', 3)->exists()) {
            $officeAddress = $employee->addresses()->where('address_type_id', 3)->first();
        } else {
            $officeAddress = new Address();
            $officeAddress->address_type_id = 3; // Assuming this is the type ID for office addresses
        }
        // Update or set office address details
        $officeAddress->address = $request->office_address;
        $officeAddress->village_area = $request->office_area;
        $officeAddress->country_id = $request->office_country_id;
        $officeAddress->state_id = $request->office_state_id ?? 1;
        $officeAddress->district_id = $request->office_district_id ?? 1;
        $officeAddress->pincode = $request->office_pincode;
        $employee->addresses()->save($officeAddress);

        if ($request->same_as_permanent_address == null) {


            if (
                $request->corrs_address !== null ||
                $request->corrs_country_id !== "1" ||
                $request->corrs_area !== null ||
                $request->corrs_pincode !== null
            ) {
                if ($employee->addresses()->where('address_type_id', 4)->exists()) {
                    $corrs_Address = $employee->addresses()->where('address_type_id', 4)->first();
                } else {
                    $corrs_Address = new Address();
                    $corrs_Address->address_type_id = 4; // Assuming this is the type ID for office addresses
                }
                // Update or set office address details
                $corrs_Address->address = $request->corrs_address;
                $corrs_Address->village_area = $request->corrs_area;
                $corrs_Address->country_id = $request->corrs_country_id;
                $corrs_Address->state_id = $request->corrs_state_id ?? 1;
                $corrs_Address->district_id = $request->corrs_district_id ?? 1;
                $corrs_Address->pincode = $request->corrs_pincode;
                $employee->addresses()->save($corrs_Address);
            }
        } else {
            if ($employee->addresses()->where('address_type_id', 4)->exists()) {
                $corrs_Address = $employee->addresses()->where('address_type_id', 4)->first();
            } else {
                $corrs_Address = new Address();
                $corrs_Address->address_type_id = 4; // Assuming this is the type ID for office addresses
            }
            // Update or set office address details
            $corrs_Address->address = $request->office_address;
            $corrs_Address->village_area = $request->office_area;
            $corrs_Address->country_id = $request->office_country_id;
            $corrs_Address->state_id = $request->office_state_id ?? 1;
            $corrs_Address->district_id = $request->office_district_id ?? 1;
            $corrs_Address->pincode = $request->office_pincode;
            $employee->addresses()->save($corrs_Address);
        }

        // Return success response
        return response()->json(['success' => true, 'message' => 'Step 1 completed successfully.']);
    }

    // Store Finance Data
    public function storeFinance(Request $request, $id)
    {


        $employee = Employee::findOrFail($id);

        if ($employee->financeDetail) {
            $employee->financeDetail->update([
                'bank_name' => $request->bank_name,
                'address' => $request->address,
                'account_number' => $request->account_number,
                'payment_mode_id' => $request->payment_mode_id,
                'account_type' => $request->account_type,
                'bank_ref_no' => $request->bank_ref_no,
                'range' => $request->range,
            ]);
        } else {
            $employee->financeDetail()->create([
                'bank_name' => $request->bank_name,
                'address' => $request->address,
                'account_number' => $request->account_number,
                'payment_mode_id' => $request->payment_mode_id,
                'account_type' => $request->account_type,
                'bank_ref_no' => $request->bank_ref_no,
                'range' => $request->range,
            ]);
        }

        //LIC Info
        if (
            $request->policy_no !== null ||
            $request->policy_term !== null ||
            $request->lic_id !== null ||
            $request->annual_renewable_date !== null
        ) {
            if ($employee->licInfo) {
                $employee->licInfo->update([
                    'policy_no' => $request->policy_no,
                    'policy_term' => $request->policy_term,
                    'lic_id' => $request->lic_id,
                    'annual_renewable_date' => $request->annual_renewable_date,
                ]);
            } else {
                $employee->licInfo()->create([
                    'policy_no' => $request->policy_no,
                    'policy_term' => $request->policy_term,
                    'lic_id' => $request->lic_id,
                    'annual_renewable_date' => $request->annual_renewable_date,
                ]);
            }
        }

        //PF Info
        if (
            $request->pf_applicable !== null ||
            $request->pf_joining_date !== null ||
            $request->pf_no !== null ||
            $request->pf_last_date !== null ||
            $request->pension_joining_date !== null ||
            $request->pension_applicable !== null
        ) {
            if ($employee->pfInfo) {
                $employee->pfInfo->update([
                    'pf_applicable' => $request->pf_applicable ?? '0',
                    'pf_joining_date' => $request->pf_joining_date,
                    'pf_no' => $request->pf_no,
                    'pf_last_date' => $request->pf_last_date,
                    'pension_joining_date' => $request->pension_joining_date,
                    'pension_applicable' => $request->pension_applicable ?? '0',
                ]);
            } else {
                $employee->pfInfo()->create([
                    'pf_applicable' => $request->pf_applicable ?? '0',
                    'pf_joining_date' => $request->pf_joining_date,
                    'pf_no' => $request->pf_no,
                    'pf_last_date' => $request->pf_last_date,
                    'pension_joining_date' => $request->pension_joining_date,
                    'pension_applicable' => $request->pension_applicable  ?? '0',
                ]);
            }
        }

        //ESI Info
        if (
            $request->esi_applicable !== null ||
            $request->esi_joining_date !== null ||
            $request->esi_no !== null ||
            $request->esi_last_date !== null ||
            $request->local_office_id !== null ||
            $request->esi_dispensary_id !== null
        ) {
            if ($employee->esiInfo) {
                $employee->esiInfo->update([
                    'esi_applicable' => $request->esi_applicable ?? '0',
                    'esi_joining_date' => $request->esi_joining_date,
                    'esi_no' => $request->esi_no,
                    'esi_last_date' => $request->esi_last_date,
                    'local_office_id' => $request->local_office_id ?? 1,
                    'esi_dispensary_id' => $request->esi_dispensary_id ?? 1,
                ]);
            } else {
                $employee->esiInfo()->create([
                    'esi_applicable' => $request->esi_applicable ?? '0',
                    'esi_joining_date' => $request->esi_joining_date,
                    'esi_no' => $request->esi_no,
                    'esi_last_date' => $request->esi_last_date,
                    'local_office_id' => $request->local_office_id,
                    'esi_dispensary_id' => $request->esi_dispensary_id,
                ]);
            }
        }


        // Return success response
        return response()->json(['success' => true, 'message' => 'Step 2 completed successfully.']);
    }

    // Store Family Data
    public function storeFamily(Request $request, $id)
    {

        // dd("inside family");
        $employee = Employee::findOrFail($id);

        $financeDetail = $employee->familyMembers()->create([
            'name' => $request->name,
            'relation_with_emp' => $request->relation_with_emp,
            'dob' => $request->dob,
            'is_residing' => $request->is_residing ?? "0",
            'remark' => $request->remark,
        ]);

        // Check if the finance detail already has an office address
        if ($financeDetail->addresses()->where('address_type_id', 4)->exists()) {
            $address = $financeDetail->addresses()->where('address_type_id', 4)->first();
        } else {
            $address = new Address();
            $address->address_type_id = 4; // Assuming this is the type ID for office addresses
        }

        // Update or set office address details for finance detail
        $address->address = $request->family_address;
        $address->village_area = $request->family_area;
        $address->country_id = $request->family_country_id;
        $address->state_id = $request->family_state_id ?? 1;
        $address->district_id = $request->family_district_id ?? 1;
        $address->pincode = $request->family_pincode;

        // Save the address to the finance detail
        $financeDetail->addresses()->save($address);

        // Return success response
        return response()->json([
            'success' => true, 'message' => 'Step 3 completed successfully.',
            'emp_id' => $employee->id
        ]);
    }

    // Store Nominee Data
    public function storeNominee(Request $request, $id)
    {

        $employee = Employee::findOrFail($id);

        $employee->nominee()->create([
            'family_member_id' => $request->family_memeber_id,
            'gratuity_sharing' => $request->gratuity_sharing,
            'marital_status' => $request->marital_status,
            'religion_id' => $request->religion_id,
            'faorhus_name' => $request->faorhus_name,
            'guardian_name' => $request->guardian_name,
            'guardian_address' => $request->guardian_address,
            'guardian_relation_with_emp' => $request->guardian_relation_with_emp,
        ]);

        // Return success response
        return response()->json([
            'success' => true, 'message' => 'Step 3 completed successfully.',
            'emp_id' => $employee->id
        ]);
    }

    // Show Nominees Member table
    public function getNominee(Request $request)
    {
        $employeeId = $request->employee_id; // Assuming you pass an employee ID
        // dd($employeeId);
        $employee = Employee::with('familyMembers', 'nominee', 'nominee.familyMember')->find($employeeId);

        if (!$employee) {
            return response()->json(['message' => 'Nominees not found'], 404);
        }

        return response()->json([
            'nominee' => $employee->nominee,
            'employee' => $employee->familyMembers
        ]);
    }

    public function editNominee(Request $request, $id)
    {
        $nominee = EmployeeNominee::find($id);
        if (!$nominee) {
            return response()->json(['error' => 'Family member not found.'], 404);
        }

        return response()->json($nominee);
    }

    public function updateNominee(Request $request, $id)
    {
        // dd($request);   
        $request->validate([
            'family_member_id' => 'required',
        ]);

        $nomineeMember = EmployeeNominee::find($id);
        if (!$nomineeMember) {
            return response()->json(['error' => 'Nominee member not found'], 404);
        }

        $NomineeDetails = $nomineeMember->update([
            'family_member_id' => $request->family_member_id,
            // 'employee_id' => $request->employee_id,
            'gratuity_sharing' => $request->gratuity_sharing,
            'marital_status' => $request->marital_status,
            'religion_id' => $request->religion_id,
            'faorhus_name' => $request->faorhus_name,
             'guardian_name' => $request->guardian_name,
              'guardian_address' => $request->guardian_address,
               'guardian_relation_with_emp' => $request->guardian_relation_with_emp,
        ]);

        // Check if the finance detail already has an office address
        // if ($familyMember->addresses()->where('address_type_id', 4)->exists()) {
        //     $address = $familyMember->addresses()->where('address_type_id', 4)->first();
        // } else {
        //     $address = new Address();
        //     $address->address_type_id = 4; 
        // }

        // Update or set office address details for finance detail
        // $address->address = $request->family_address;
        // $address->village_area = $request->family_area;
        // $address->country_id = $request->family_country_id;
        // $address->state_id = $request->family_state_id ?? 1;
        // $address->district_id = $request->family_district_id ?? 1;
        // $address->pincode = $request->family_pincode;

        // Save the address to the finance detail
        // $familyMember->addresses()->save($address);

        // Update family member data
        // $familyMember->update($request->all());

        return response()->json([
            'success' => 'Nominee member updated successfully',
            'emp_id' => $nomineeMember->employee_id
        ]);
    }

    public function employeeFamily($id)
    {
        // dd($id);
        $employeeFamily = EmployeeFamilyMemberDetail::where('employee_id', $id)->get();
        return response()->json([
            'success' => 'Family member deleted successfully.',
            'emp_family' => $employeeFamily
        ]);
    }

    public function deleteNominee($id)
    {
        $nominee = EmployeeNominee::find($id);
        if (!$nominee) {
            return response()->json(['error' => 'Family member not found.'], 404);
        }
        $emp_id = $nominee->employee_id;
        $nominee->delete();


        return response()->json([
            'success' => 'Nominee member deleted successfully.',
            'emp_id' => $emp_id
        ]);

        // Delete the family member
        // Return success or error message as JSON
    }


    // Store Date
    public function store(Request $request)
    {

        $auth_id = auth()->id();
        $validatedData = $request->validate([
            'employee_code' => 'required|max:255',
            'employee_name' => 'required|max:255',
            'dob' => 'required'
        ]);

        $input = $request->all();
        $employee = new Employee();
        $employee = $employee->create($input);


        return redirect()->route('master.employees.edit', ['id' => $employee->id])
            ->with('success', 'Employee created successfully');
    }
    // Edit
    public function edit(Address $address, $id)
    {

        $user = User::with('roles')->find($id);
        $employee = Employee::with('addresses')->find($id);

        $countries = Country::all();
        $states = State::all();
        $addressTypes = AddressType::all();
        $company_types = CompanyType::all();
        $religions = Religion::all();
        $castes = Caste::all();
        $nationality = Nationality::all();
        $payment_modes = PaymentMode::all();
        $local_offices = LocalOffice::all();
        $esi_despensaries = EsiDispensary::all();
        $family_members = EmployeeFamilyMemberDetail::where('employee_id', $id)->get();
        $resigning_reason = ResigningReason::all();
        $photoPath = $employee->photo ?? null;


        return view('pages.master.employee.edit', [
            'employee' => $employee,
            'company_types' => $company_types,
            'countries' => $countries,
            'states' => $states,
            'addressTypes' => $addressTypes,
            'religions' => $religions,
            'castes' => $castes,
            'nationality' => $nationality,
            'payment_modes' => $payment_modes,
            'local_offices' => $local_offices,
            'esi_despensaries' => $esi_despensaries,
            'family_members' => $family_members,
            'resigning_reason' => $resigning_reason,
            'photoPath' => $photoPath
        ]);
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

    // Delete
    public function destroy($id)
    {
        $employee = Employee::findOrFail($id);
        $employee->delete();

        return response()->json(['success' => 'Employee deleted successfully']);
    }
    // Multi Delete
    public function deleteSelected(Request $request)
    {

        $ids = $request->ids;

        if (!is_array($ids)) {
            return response()->json(['status' => 'error', 'message' => 'Invalid input'], 400);
        }

        Employee::destroy($ids);
        return response()->json(['status' => 'success']);
    }
    // Import Users
    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:xlsx,csv'
        ]);

        Excel::import(new EmployeeImport, request()->file('file'));

        return redirect()->route('master.employees.index')->with('success', 'Data imported successfully');
    }
    // Import Users
    public function export(Request $request)
    {
        return Excel::download(new EmployeeExport($request->all()), 'EmployeeDatas_' . date('d-m-Y') . '.xlsx');
    }

    public function getCompanies($companytypeid)
    {
        $companies = Company::where('company_type_id', $companytypeid)->with('authorisedPerson')->get();
        return response()->json($companies);
    }
    // Show
    public function showDetails($id)
    {
        // $employee = Employee::where('id', $id)->first();
        $employee = Employee::where('id', $id)->first();
        return view('pages.master.employee.show', ['employee' => $employee]);
    }
}
