<?php

namespace App\Exports;

use App\Models\JobReceived;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class JobReceivedReportExport implements FromCollection,WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
         return JobReceived::all();
    }
     public function headings(): array
    {
        return [
            'Id',
            'Employee Code',
            'Employee Name',
            'Model Name',
             'Size',
             'Color',
             'Received quantity',
              'Total Amount',
              'Ded',
              'Conv',
              'INC',
              'Village',
              'Weight',
            'created_at',
            'updated_at'
        ];
    }
}
