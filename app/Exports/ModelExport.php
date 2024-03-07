<?php

namespace App\Exports;
use App\Models\ProductModel;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ModelExport implements FromCollection,WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return ProductModel::all();
 
    }


    public function headings(): array
    {
        return [
            'Id',
            'R.M',
            'R.M Type',
            'R.M Stock',
            'Product Name',
            'Product Size',
            'Model Code',
            'Model Name',
            'R.M Weight/Item',
            'Wages of one Product',
            'created_at',
            'updated_at'
        ];
    }
}
