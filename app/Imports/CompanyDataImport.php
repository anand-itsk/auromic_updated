<?php

namespace App\Imports;

use App\Models\Company;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class CompanyDataImport implements ToCollection, WithHeadingRow
{
    /**
     * @param Collection $collection
     */

    protected $companyTypeId;

    public function __construct($companyTypeId)
    {
        $this->companyTypeId = $companyTypeId;
    }
    public function collection(Collection $collection)
    {


        foreach ($collection as $row) {
            // Check if user with the same email already exists
            $existing = Company::where('company_code', $row['company_code'])->where('company_name', $row['company_name'])->first();

            if ($existing) {
                // Skip this user or handle as needed
                return null;
            }
            Company::create([
                'company_type_id' => $this->companyTypeId,
                'company_code' => $row['company_code'],
                'company_name' => $row['company_name'],
                'created_by' => auth()->id() ?? 1,
                'updated_by' => auth()->id() ?? 1
            ]);
        }
    }
}
