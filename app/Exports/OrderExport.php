<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;

class OrderExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return OrderDetail::all();
    }


    public function headings(): array
    {
        return [
            'Id',
            'Order_no',
            'Order_date',
            'Customer',
            'Product_model',
            'Product_size',
            'Product_color',
            'Quantity',
            'Delivery_date',
            'Order_status',
            'Total_raw_material	',
        ];
    }
}
