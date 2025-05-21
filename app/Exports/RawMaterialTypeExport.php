<?php

namespace App\Exports;

use App\Models\RawMaterialType;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class RawMaterialTypeExport implements FromCollection,WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return RawMaterialType::all();
    }

    public function headings(): array
    {
        return [
            'Id',
            'Name',
            'Code',
            'Created At',
            'Updated At',
    
        ];
    }
}
