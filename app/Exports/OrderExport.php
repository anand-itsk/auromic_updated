<?php

namespace App\Exports;
use App\Models\OrderDetail;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class OrderExport implements FromCollection,WithHeadings
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
            'created_at',
            'updated_at'
        ];
    }
}
