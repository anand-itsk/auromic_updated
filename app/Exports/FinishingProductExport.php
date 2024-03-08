<?php

namespace App\Exports;
use App\Models\FinishingProductModel;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class FinishingProductExport implements FromCollection,WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
         return FinishingProductModel::all();
    }

     public function headings(): array
    {
        return [
            'Id',
            'Product Id',
            'Product Size',
            'Model Code',
            'Model Name',
            'Wages of Product',
            'Date',
            'created_at',
            'updated_at'
        ];
    }
}
