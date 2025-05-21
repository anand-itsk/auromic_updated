<?php

namespace App\Imports;

use App\Models\Customer;
use Illuminate\Support\Collection;
use Illuminate\Validation\ValidationException;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class CustomerDataImport implements ToCollection, WithHeadingRow
{
    protected $duplicateCustomers = [];

    public function collection(Collection $collection)
    {
        foreach ($collection as $row) {
            // Check if the customer already exists
            $existing = Customer::where('customer_code', $row['customer_code'])
                ->where('customer_name', $row['customer_name'])
                ->first();

            if ($existing) {
                // Store duplicate entry for reporting
                $this->duplicateCustomers[] = $row['customer_name'] . " (Code: " . $row['customer_code'] . ")";
                continue;
            }

            // Insert new customer if not duplicate
            Customer::create([
                'customer_code' => $row['customer_code'],
                'customer_name' => $row['customer_name'],
                'created_by' => auth()->id() ?? 1,
                'updated_by' => auth()->id() ?? 1
            ]);
        }

        // If duplicates exist, throw a validation exception
        if (!empty($this->duplicateCustomers)) {
            throw ValidationException::withMessages([
                'duplicate' => 'Duplicate Customers Found: ' . implode(', ', $this->duplicateCustomers),
            ]);
        }
    }
}
