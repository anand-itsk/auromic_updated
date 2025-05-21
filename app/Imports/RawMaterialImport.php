<?php

namespace App\Imports;

use App\Models\RawMaterial;
use App\Models\RawMaterialType;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\ToModel;

class RawMaterialImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        // Skip the header row if it contains 'ID', 'Raw Material Type', 'Name', and 'Stock'
        if (strtolower(trim($row[0])) == 'id' && strtolower(trim($row[1])) == 'raw material type' && strtolower(trim($row[2])) == 'name' && strtolower(trim($row[3])) == 'stock') {
            return null; // Skip this row (header)
        }

        // Check if raw material type name exists in the RawMaterialType table
        $rawMaterialType = RawMaterialType::where('name', trim($row[1]))->first();
    
        if (!$rawMaterialType) {
            // Optionally, log an error if RawMaterialType is not found
            Log::error("Raw Material Type not found for: " . $row[1]);
            return null; // Skip this row if RawMaterialType is not found
        }

        // Proceed to insert the record if the raw_material_type_id exists
        return new RawMaterial([
            'id' => $row[0], 
            'raw_material_type_id' => $rawMaterialType->id,  // Use the ID of the found RawMaterialType
            'name' => $row[2], 
            'stock' => $row[3], 
        ]);
    }
}
