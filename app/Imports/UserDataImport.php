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
        foreach ($collection as $row) 
        {
            User::create([
                'name' => $row['Name'],
                'name' => $row['Email'],
                'password' => Hash::make('password'),
                'created_by' => 1,
                'updated_by' => 1
            ]);
        }
    }
}
