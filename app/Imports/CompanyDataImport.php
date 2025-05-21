<?php

namespace App\Imports;

use App\Models\Company;

use Illuminate\Validation\ValidationException;

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
    protected $duplicateCompanies = [];

    public function __construct($companyTypeId)
    {
        $this->companyTypeId = $companyTypeId;
    }
    public function collection(Collection $collection)
    {
        foreach ($collection as $row) {
            // Check if company already exists
            $existing = Company::where('company_code', $row['company_code'])
            ->where('company_name', $row['company_name'])
            ->first();

            if ($existing) {
                // Store duplicate entry for reporting
                $this->duplicateCompanies[] = $row['company_name'] . " (Code: " . $row['company_code'] . ")";
                continue;
            }

            // Insert new company if not duplicate
            Company::create([
                'company_type_id' => $this->companyTypeId,
                'company_code' => $row['company_code'],
                'company_name' => $row['company_name'],
                'created_by' => auth()->id() ?? 1,
                'updated_by' => auth()->id() ?? 1
            ]);
        }

        // If duplicates exist, throw a validation exception
        if (!empty($this->duplicateCompanies)) {
            throw ValidationException::withMessages([
                'duplicate' => 'Duplicate Companies Found: ' . implode(', ', $this->duplicateCompanies),
            ]);
        }
    }
}
