<?php

namespace App\Exports;

use App\Models\RawMaterial;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class RawMaterialExport implements FromCollection,WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        // Eager load the 'rawMaterialType' relationship
        return RawMaterial::with('rawMaterialType')->get()->map(function ($rawMaterial) {
            return [
                'id' => $rawMaterial->id,
                'raw_material_type_name' => $rawMaterial->rawMaterialType->name, // Access the related 'name' of RawMaterialType
                'name' => $rawMaterial->name,
                'stock' => $rawMaterial->stock,
                'created_at' => $rawMaterial->created_at,
                'updated_at' => $rawMaterial->updated_at,
            ];
        });
    }

    public function headings(): array
    {
        return [
            'Id',
            'Raw Material Type', // Column name for 'raw_material_type_name'
            'Name',
            'Stock',
            'Created At',
            'Updated At',
        ];
    }}
