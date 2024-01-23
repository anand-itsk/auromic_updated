<?php

namespace App\Imports;

use App\Models\User;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class UserDataImport implements ToCollection, WithHeadingRow
{
    /**
     * @param Collection $collection
     */
    public function collection(Collection $collection)
    {

        foreach ($collection as $row) {

            // Check if user with the same email already exists
            $existingUser = User::where('email', $row['email'])->first();

            if ($existingUser) {
                // Skip this user or handle as needed
                return null;
            }
            User::create([
                'name' => $row['name'],
                'email' => $row['email'],
                'password' => Hash::make('password'),
                'created_by' => auth()->id() ?? 1,
                'updated_by' => auth()->id() ?? 1
            ]);
        }
    }
}
