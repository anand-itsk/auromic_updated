<?php

namespace App\Exports;

use App\Models\DirectJobReceived;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class DirectJobReceivedReportExport implements FromCollection,WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
     public function collection()
    {
         return DirectJobReceived::all();
    }

     public function headings(): array
    {
        return [
            'Id',
            'Direct Job Giving',
             'Employee',
             'Finishing Product',
             'Product Color',
             'Incentive',
             'Received Date',
            'created_at',
            'updated_at'
        ];
    }
}
