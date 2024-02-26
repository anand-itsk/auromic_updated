<?php

namespace App\Exports;

use App\Models\DeliveryChallan;

use Maatwebsite\Excel\Concerns\FromCollection;

class DeliveryChallanExport implements FromCollection
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
        ];
    }
}
