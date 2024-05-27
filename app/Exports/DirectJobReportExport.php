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
             'Product Model',
             'Product Size',
             'Product Color',
             'quantity',
             'Weight',
            'created_at',
            'updated_at'
        ];
    }
}
