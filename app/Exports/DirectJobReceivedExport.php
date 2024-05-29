<?php

namespace App\Exports;

use App\Models\DirectJobReceived;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class DirectJobReceivedExport implements FromCollection,WithHeadings
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
             'Incentive Applicable',
             'Received Date',
             'Cutting',
             'Balance Meter',
             'Quantity',
             'Wages One Product',
             'Usage',
             'Shortage',
             'Wastage',
             'Before Days',
             'After Days',
             'Conveyance Fees',
              'Deducation Fees',
              'Incentive Fees',
              'Total Amount',
              'Net Amount',
            'created_at',
            'updated_at'
        ];
    }
}
