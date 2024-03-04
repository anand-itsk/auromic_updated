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
            'Model Size',
            'Duration Period',
            'created_at',
            'updated_at'
        ];
    }
}
