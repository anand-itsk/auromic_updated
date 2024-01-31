<?php

namespace App\Imports;

use App\Models\Customer;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class CustomerDataImport implements ToCollection, WithHeadingRow
{
    /**
     * @param Collection $collection
     */
    public function collection(Collection $collection)
    {
        

        foreach ($collection as $row) {
            // Check if user with the same email already exists
            $existing = Customer::where('customer_code', $row['customer_code'])->where('customer_name', $row['customer_name'])->first();

            if ($existing) {
                // Skip this user or handle as needed
                return null;
            }
            Customer::create([
                'customer_code' => $row['customer_code'],
                'customer_name' => $row['customer_name'],
                'created_by' => auth()->id() ?? 1,
                'updated_by' => auth()->id() ?? 1
            ]);
        }
    }
}
