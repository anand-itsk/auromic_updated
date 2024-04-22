<?php

namespace App\Imports;

use App\Models\Address;
use App\Models\Employee;
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
                // 'dob' => isset($row['dob']) ? (new DateTime($row['dob']))->format('Y-m-d') : null,
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
                $correspAddress->address_type_id = 4; // Assuming this is the type ID for office addresses


                $correspAddress->address = $row['address_corresp'];
                $correspAddress->village_area = $row['city_corresp'];
                $correspAddress->pincode = $row['pin_corresp'];
                $employee->addresses()->save($correspAddress);
            }
        }
    }
}
