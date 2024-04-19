<?php

namespace App\Imports;

use App\Models\Employee;
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
            $existing = Employee::where('employee_code', $row['employee_code'])->where('employee_name', $row['employee_name'])->where('joining_date', $row['joining_date'])->where('faorhus_name', $row['faorhus_name'])->where('dob', $row['dob'])->where('gender', $row['gender'])->where('mobile', $row['mobile'])->where('email', $row['email'])->where('marital_status', $row['marital_status'])->where('std_code', $row['std_code'])->where('religion_id', $row['religion_id'])->where('prob_period', $row['prob_period'])->where('confirm_date', $row['confirm_date'])->first();

            if ($existing) {
                // Skip this user or handle as needed
                return null;
            }
            Employee::create([
                
                'employee_code' => $row['employee_code'],
                'employee_name' => $row['employee_name'],
                'joining_date' => $row['joining_date'],
                'faorhus_name' => $row['faorhus_name'],
                'dob' => $row['dob'],
                'gender' => $row['gender'],
                'mobile' => $row['mobile'],
                'email' => $row['email'],
                'marital_status' => $row['marital_status'],
                'std_code' => $row['std_code'],
                'religion_id' => $row['religion_id'],
                'prob_period' => $row['prob_period'],
                'confirm_date' => $row['confirm_date'],
                
            ]);
        }
    }
}
