<?php

namespace App\Exports;

use App\Models\DeliveryChallan;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class DeliveryChallanExport implements FromCollection,WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
         return DeliveryChallan::all();
    }
      public function headings(): array
    {
        return [
            'Id',
            'Company Name',
            'Order Number',
            'DC NO',
             'DC Date',
            'created_at',
            'updated_at'
        ];
    }
}
