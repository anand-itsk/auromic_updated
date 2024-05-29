<?php

namespace App\Exports;
use App\Models\Employee;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;


class EmployeeReportExport implements FromCollection,WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
     public function collection()
    {
        return Employee::all();
    }

   public function headings(): array
    {
        return [
            'Id',
            'Company Id',
            'Employee Code',
            'Employee name',
            'DOB',
            'Gender',
            'Blood Group',
            'Email',
            'Mobile',
            'Faorhus Name',
            'Mother Name',
            'Marital Status',
            'STD Code',
            'Phone',
            'Status',
            'Religion',
            'Caste',
            'Nationality',
            'Joining Date',
            'Prob Period',
            'Confirm Date',
            'Resigning Date',
            'Photo',
            'Resigning Reason',
            'created_at',
            'updated_at'
        ];
    }

}
