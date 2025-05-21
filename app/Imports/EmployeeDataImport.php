<?php

namespace App\Imports;

use App\Models\Address;
use App\Models\Company;
use App\Models\Country;
use App\Models\District;
use App\Models\Employee;
use App\Models\PfInfo;
use App\Models\EsiInfo;
use App\Models\EmployeeBankingInfo;
use App\Models\EmployeeIdentityProof;
use App\Models\Religion;
use App\Models\State;
use Carbon\Carbon;
use DateTime;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Date;
use PhpOffice\PhpSpreadsheet\Shared\Date as DateConvert;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class EmployeeDataImport implements ToCollection, WithHeadingRow
{

    protected $companyId;
    protected $errors = [];
    /**
     * @param Collection $collection
     */
    public function __construct($companyId)
    {
        $this->companyId = $companyId; // Store the company ID for use in import
    }
    public function collection(Collection $collection)
    {
        // dd($collection);
        function parseExcelDate($dateValue) {
            if (is_numeric($dateValue)) {
                // Handle Excel date (numeric format)
                return Carbon::createFromFormat('Y/m/d', '1899/12/30')->addDays($dateValue)->format('Y-m-d');
            } else {
                // Handle string date in dd/mm/yyyy format
                try {
                    return Carbon::createFromFormat('d/m/Y', $dateValue)->format('Y-m-d');
                } catch (\Exception $e) {
                    return null; // Return null if parsing fails
                }
            }
        }
        foreach ($collection as $row) {
            // dd($row);
            $joining_dateDate = parseExcelDate($row['date_of_joining']);
            $dobDate = parseExcelDate($row['dob']);
            $resigning_dateDate = parseExcelDate($row['resignation_date']);
            // dd($joining_dateDate);
            // Check if user with the same email already exists
            $existing = Employee::where('employee_code', $row['code'])
                ->where('employee_name', $row['employee_name'])
                ->where('joining_date', $joining_dateDate)
                ->where('mobile', $row['mobile'])
                ->where('email', $row['e_mail'])->first();

                if ($existing) {
                    // Add an error and continue to the next row
                    $this->errors[] = "Employee with Code {$row['code']} and Email {$row['e_mail']} already exists.";
                    continue;
                }
            
    
            // If there are errors, throw an exception before processing further
            if (!empty($this->errors)) {
                // Log::error('Import Errors: ', $this->errors);
                throw ValidationException::withMessages(['import_errors' => $this->errors]);
            }
    


            if ($row['gender'] == "F") {
                $gender = "Female";
            } elseif ($row['gender'] == "M") {
                $gender = "Male";
            }

            $religionName = $row['religion'] ?? null;
            $religionId = null;
            $companyName = $row['company_id'] ?? null;
            $companyId = null;
            if ($companyName) {
                // Check if the company exists
                $company = Company::where('company_name', $companyName)->first();

                if ($company) {
                    $companyId = $company->id;
                } else {
                    $companyId = $this->companyId; // Do nothing, just keep companyId as null
                }
            } else {
                $companyId = $this->companyId; // Explicitly set null if no company name is provided
            }

            if ($religionName) {
                // Check if the religion exists
                $religion = Religion::where('name', $religionName)->first();

                if ($religion) {
                    $religionId = $religion->id;
                } else {
                    // Create a new religion if it doesn't exist
                    $newReligion = Religion::create(['name' => $religionName]);
                    $religionId = $newReligion->id;
                }

            }

            if ($row['state_permanent']) {
                $state = State::where('name', $row['state_permanent'])->first();
                $statePermanentId = $state ? $state->id : null;
            } else {
                $statePermanentId = null;
            }

            if ($row['state_corresp']) {
                $state = State::where('name', $row['state_corresp'])->first();
                $stateCorrespId = $state ? $state->id : null;
            } else {
                $stateCorrespId = null;
            }

            $districtPermanentName = $row['district_permanent'] ?? null;
            $districtPermanentId = null;

            if ($districtPermanentName) {
                $district = District::where('name', $districtPermanentName)->first();
                if ($district) {
                    $districtPermanentId = $district->id;
                } else {
                    $newDistrict = District::create(['name' => $districtPermanentName, 'state_id' => $statePermanentId ?? 1]);
                    $districtPermanentId = $newDistrict->id;
                }
            }

            $districtCorrespName = $row['district_corresp'] ?? null;
            $districtCorrespId = null;

            if ($districtCorrespName) {
                $district = District::where('name', $districtCorrespName)->first();
                if ($district) {
                    $districtCorrespId = $district->id;
                } else {
                    $newDistrict = District::create(['name' => $districtCorrespName, 'state_id' => $stateCorrespId ?? 1]);
                    $districtCorrespId = $newDistrict->id;
                }
            }

            if (!$row['code']) {
                // Skip this user or handle as needed
                return null;
            }

            $employee = Employee::create([
                'company_id' => $companyId,
                'employee_code' => $row['code'] ?? null,
                'employee_name' => $row['employee_name'] ?? null,
                'joining_date' => $joining_dateDate ?? null,
                'faorhus_name' => $row['fathershusbands_name'] ?? null,
                'dob' =>$dobDate ?? null,
                'resigning_date' =>$resigning_dateDate ?? null,
                'gender' => $gender ?? null,
                'mobile' => $row['mobile'] ?? null,
                'email' => $row['email'] ?? null,
                'marital_status' => $row['marital_status'] ?? null,
                'std_code' => $row['std_code'] ?? null,
                'religion_id' => $religionId,
                'prob_period' => $row['prob_period'] ?? null,
                'confirm_date' => isset($row['confirmation_date']) ? (new DateTime($row['confirmation_date']))->format('Y-m-d') : null,
            ]);

            if ($row['address_permanent'] != '') {


                $officeAddress = new Address();
                $officeAddress->address_type_id = 4; // Assuming this is the type ID for office addresses


                $officeAddress->address = $row['address_permanent'];
                $officeAddress->village_area = $row['city_permanent'];
                $officeAddress->district_id = $districtPermanentId ?? 1;
                $officeAddress->state_id = $statePermanentId ?? 1;
                $officeAddress->pincode = $row['pin_permanent'];
                $officeAddress->country_id =  101;
                $employee->addresses()->save($officeAddress);
            }

            if ($row['address_corresp'] != '') {


                $correspAddress = new Address();
                $correspAddress->address_type_id = 5; // Assuming this is the type ID for office addresses


                $correspAddress->address = $row['address_corresp'];
                $correspAddress->village_area = $row['city_corresp'];
                $correspAddress->district_id =  $districtCorrespId ?? 1;
                $correspAddress->state_id =$stateCorrespId ?? 1;
                $correspAddress->pincode = $row['pin_corresp'];
                $correspAddress->country_id = 101;
                $employee->addresses()->save($correspAddress);
            }

            $pfInfo = new PfInfo();
            $pfInfo->employee_id = $employee->id;
            $pfInfo->pf_no = $row['pf_no'];
            $pfInfo->uan_number = $row['uan'];
            $pfInfo->save();

            $esiInfo = new EsiInfo();
            $esiInfo->employee_id = $employee->id;
            $esiInfo->esi_no = $row['esi_no'];
            $esiInfo->save();


            $bankingInfo = new EmployeeBankingInfo();

            $bankingInfo->employee_id = $employee->id;
            $bankingInfo->bank_name = $row['bank_name'];
            $bankingInfo->account_number = $row['ac_number'];
            $bankingInfo->ifsc_code = $row['ifsc'];
            $bankingInfo->payment_mode_id = $row['payment_mode'] ?? "1";
            $bankingInfo->name_as_per_bank = $row['name_as_per_bank'];
            $bankingInfo->save();

            $identity_proofInfo = new EmployeeIdentityProof();
            $identity_proofInfo->employee_id = $employee->id;
            $identity_proofInfo->aadhar_number = $row['aadhar_number'];
            $identity_proofInfo->aadhar_name = $row['name_as_per_aadhar'];
            $identity_proofInfo->save();

    }
}
}
