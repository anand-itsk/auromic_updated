<?php

namespace App\Imports;

use App\Models\RawMaterialType;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\SkipsFailures;

class RawMaterialTypeImport implements ToModel, SkipsOnFailure
{
    use SkipsFailures;

    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        // Skip the first row if it contains headers (ID, Name, Code)
        if (strtolower(trim($row[0])) == 'id' && strtolower(trim($row[1])) == 'name' && strtolower(trim($row[2])) == 'code') {
            return null; // Skip this row (header)
        }

        return new RawMaterialType([ 
            'id' => $row[0], 
            'name' => $row[1],  
            'code' => $row[2],  
        ]);
    }
}
