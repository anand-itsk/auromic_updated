<?php

namespace App\Exports;

use App\Models\JobGiving;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class JobGivingReportExport implements FromCollection,WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
         return JobGiving::all();
    }
    public function headings(): array
    {
        return [
            'Id',
            'Employee Name',
            'Order Number',
            'Product Model',
            'DC NO',
             'Status',
             'quantity',
             'Weight',
             'excess',
             'Shortage',
             'Days',
             'Date',
            'created_at',
            'updated_at'
        ];
    }
}
