<?php

namespace App\Exports;
use App\Models\JobReceived;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class JobReceivedExport implements FromCollection,WithHeadings
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
            'Job Giving',
             'Incentive Applicable',
             'Before Days',
             'After Days',
             'Current Weight',
             'Deducation Fee',
             'Conveyance Fee',
             'Incentive Fee',
              'Total Amount',
              'Net Amount',
              'Status',
              'Receving Date',
              'Complete Quantity',
            'created_at',
            'updated_at'
        ];
    }
}
