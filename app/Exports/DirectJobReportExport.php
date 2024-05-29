<?php

namespace App\Exports;

use App\Models\DirectJobGiving;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class DirectJobReportExport implements FromCollection,WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
         return DirectJobGiving::all();
    }

     public function headings(): array
    {
        return [
            'Id',
            'Employee Name',
             'Finishing Product Model',
             'Product Size',
             'Product Color',
             'Meter',
             'Useage Meter',
             'Clothes cutting',
             'total Cutting Pieces',
             'Total Quantity',
            'created_at',
            'updated_at'
        ];
    }
}
