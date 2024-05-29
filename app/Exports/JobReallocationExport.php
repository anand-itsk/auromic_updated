<?php

namespace App\Exports;
use App\Models\JobAllocationHistory;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class JobReallocationExport implements FromCollection,WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
         return JobAllocationHistory::all();
    }
     public function headings(): array
    {
        return [
            'Id',
            'Job Giving',
             'Employee',
              'Receving Date',
              'Quantity',
            'created_at',
            'updated_at'
        ];
    }
}
