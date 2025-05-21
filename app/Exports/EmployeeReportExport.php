<?php

namespace App\Exports;

use App\Models\Employee;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class EmployeeReportExport implements FromCollection, WithHeadings, WithMapping
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Employee::with([
            'company',
            'addresses',
            'identityProof',
            'financeDetail',
            'pfInfo',
            'esiInfo',
            'religion',
            'caste',
            'nationality',
            'resigningReason'
        ])->get();
    }

    public function map($employee): array
    {
        return [
            $employee->employee_code,
            $employee->employee_name,
            $this->formatDate($employee->joining_date),
            $employee->faorhus_name,
            $employee->gender,
            $this->formatDate($employee->dob),
            optional($employee->identityProof)->pan_number,
            $this->formatDate($employee->resigning_date),
            $this->formatDate($employee->confirm_date),
            $employee->prob_period,

            // Permanent Address (address_type_id = 4)
            optional($employee->addresses->where('address_type_id', 4)->first())->address,
            optional($employee->addresses->where('address_type_id', 4)->first())->city,
            optional($employee->addresses->where('address_type_id', 4)->first())->pin ?? null,
            optional($employee->addresses->where('address_type_id', 4)->first())->district->name ?? null, // Only district name
            optional($employee->addresses->where('address_type_id', 4)->first())->state->name ?? null, // Only state name

            // Correspondence Address (address_type_id = 5)
            optional($employee->addresses->where('address_type_id', 5)->first())->address,
            optional($employee->addresses->where('address_type_id', 5)->first())->city,
            optional($employee->addresses->where('address_type_id', 5)->first())->pin ?? null,
            optional($employee->addresses->where('address_type_id', 5)->first())->district->name ?? null, // Only district name
            optional($employee->addresses->where('address_type_id', 5)->first())->state->name ?? null, // Only state name


            $employee->std_code,
            $employee->phone,
            $employee->mobile,
            $employee->marital_status,
            $this->formatDate($employee->date_of_marriage),
            $employee->spouse_name,
            $employee->email,
            optional($employee->pfInfo)->uan,
            optional($employee->pfInfo)->pf_no,
            optional($employee->esiInfo)->esi_no,
            optional($employee->financeDetail)->bank_name,
            optional($employee->financeDetail)->ifsc,
            optional($employee->financeDetail)->account_number,
            optional($employee->financeDetail)->name_as_per_bank,
            $employee->work_location,
            optional($employee->religion)->name,
            optional($employee->identityProof)->aadhar_number,
            optional($employee->identityProof)->name_as_per_aadhar,
            optional($employee->company)->branch,
            optional($employee->caste)->category,
            $employee->designation,
            $employee->department,
            $employee->scale,
            $employee->pt_group,
            $employee->shift,
            $employee->payment_mode,
        ];
    }

    /**
     * Format dates to d/m/Y or return null if empty
     */
    private function formatDate($date)
    {
        return $date ? Carbon::parse($date)->format('d/m/Y') : null;
    }

    public function headings(): array
    {
        return [
            'Code',
            'Employee Name',
            'Date of Joining',
            "Father's/Husband's Name",
            'Gender',
            'DOB',
            'PAN',
            'Resignation Date',
            'Confirmation Date',
            'Probation Period',
            'Address (Permanent)',
            'City (Permanent)',
            'PIN (Permanent)',
            'District (Permanent)',
            'State (Permanent)',
            'Address (Corresp.)',
            'City (Corresp.)',
            'PIN (Corresp.)',
            'District (Corresp.)',
            'State (Corresp.)',
            'STD Code',
            'Phone',
            'Mobile',
            'Marital Status',
            'Date of Marriage',
            'Spouse Name',
            'E-Mail',
            'UAN',
            'PF No.',
            'ESI No.',
            'Bank Name',
            'IFSC',
            'A/c Number',
            'Name as per Bank',
            'Work Location',
            'Religion',
            'Aadhar Number',
            'Name as per Aadhar',
            'Branch',
            'Category',
            'Designation',
            'Department',
            'Scale',
            'PT Group',
            'Shift',
            'Payment Mode',
        ];
    }
}
