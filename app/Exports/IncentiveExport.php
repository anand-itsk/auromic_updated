<?php

namespace App\Exports;
use App\Models\Incentive;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
class IncentiveExport implements FromCollection,WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
         return Incentive::all();
    }
      public function headings(): array
    {
        return [
            'Id',
            'Product name',
            'Duration Period',
            'Amount',
            'created_at',
            'updated_at'
        ];
    }
}
