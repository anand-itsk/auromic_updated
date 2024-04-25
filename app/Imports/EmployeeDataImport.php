<?php

namespace App\Imports;

use App\Models\Address;
use App\Models\Employee;
use App\Models\PfInfo;
use App\Models\EsiInfo;
use App\Models\EmployeeBankingInfo;
use App\Models\EmployeeIdentityProof;
use DateTime;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class EmployeeDataImport implements ToCollection, WithHeadingRow
{


    /**
     * @param Collection $collection
     */
    public function collection(Collection $collection)
    {



        foreach ($collection as $row) {
            // Define the expected date format
            $dateFormat = 'd/m/y';

            // Create a DateTime object from the provided date, with error handling
            $dob = isset($row['dob']) ? DateTime::createFromFormat($dateFormat, $row['dob']) : null;

            if ($dob) {
                // If successful, format to 'Y-m-d' (ISO 8601)
                $formattedDate = $dob->format('Y-m-d');
            } else {
                // Handle invalid date parsing or null values
                $formattedDate = null;
            }

            // Check if user with the same email already exists
            $existing = Employee::where('employee_code', $row['code'])
                ->where('employee_name', $row['employee_name'])
                ->where('joining_date', $row['date_of_joining'])
                ->where('mobile', $row['mobile'])
                ->where('email', $row['e_mail'])->first();

            if ($existing) {
                // Skip this user or handle as needed
                return null;
            }


            if ($row['gender'] == "F") {
                $gender = "Female";
            } elseif ($row['gender'] == "M") {
                $gender = "Male";
            }

            $employee = Employee::create([
                'company_id' => $row['company_id'] ?? null,
                'employee_code' => $row['code'] ?? null,
                'employee_name' => $row['employee_name'] ?? null,
                'joining_date' => isset($row['date_of_joining']) ? (new DateTime($row['date_of_joining']))->format('Y-m-d') : null,
                'faorhus_name' => $row['fathershusbands_name'] ?? null,
                // 'dob' => isset($row['dob']) ? (new DateTime($row['dob']))->format('Y-d-m') : null,
                'gender' => $gender ?? null,
                'mobile' => $row['mobile'] ?? null,
                'email' => $row['email'] ?? null,
                'marital_status' => $row['marital_status'] ?? null,
                'std_code' => $row['std_code'] ?? null,
                'religion_id' => $row['religion_id'] ?? null,
                'prob_period' => $row['prob_period'] ?? null,
                'confirm_date' => isset($row['confirmation_date']) ? (new DateTime($row['confirmation_date']))->format('Y-m-d') : null,
            ]);

            if ($row['address_permanent'] != '') {


                $officeAddress = new Address();
                $officeAddress->address_type_id = 4; // Assuming this is the type ID for office addresses


                $officeAddress->address = $row['address_permanent'];
                $officeAddress->village_area = $row['city_permanent'];
                $officeAddress->pincode = $row['pin_permanent'];
                $employee->addresses()->save($officeAddress);
            }

            if ($row['address_corresp'] != '') {


                $correspAddress = new Address();
                $correspAddress->address_type_id = 5; // Assuming this is the type ID for office addresses


                $correspAddress->address = $row['address_corresp'];
                $correspAddress->village_area = $row['city_corresp'];
                $correspAddress->pincode = $row['pin_corresp'];
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
            $bankingInfo->payment_mode_id = $row['payment_mode'];
            $bankingInfo->save();

            $identity_proofInfo = new EmployeeIdentityProof();
            $identity_proofInfo->employee_id = $employee->id;
            $identity_proofInfo->aadhar_number = $row['aadhar_number'];
            $identity_proofInfo->aadhar_name = $row['name_as_per_aadhar'];
            $identity_proofInfo->save();
        }
    }
}
