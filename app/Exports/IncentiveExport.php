<?php

namespace App\Exports;
use App\Models\Incentive;
use Maatwebsite\Excel\Concerns\FromCollection;

class IncentiveExport implements FromCollection
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
            'Model Size',
            'Duration Period',
        ];
    }
}
