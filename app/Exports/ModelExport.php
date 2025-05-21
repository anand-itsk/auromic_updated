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
        // Eager load the related models to avoid N+1 query problem
        return ProductModel::with(['product', 'productSize', 'rawMaterial'])->get()->map(function ($productModel) {
            return [
                'id' => $productModel->id,
                'raw_material' => $productModel->rawMaterial->name, // Assuming 'name' is the column for raw material's name
                'product_name' => $productModel->product->name, // Assuming 'name' is the column for product's name
                'date' => $productModel->date,
                'product_size' => $productModel->productSize->name, // Assuming 'size' is the column for product size
                'model_code' => $productModel->model_code,
                'model_name' => $productModel->model_name,
                'rm_weight_per_item' => $productModel->raw_material_weight_item,
                'wages_of_one_product' => $productModel->wages_product,
                'created_at' => $productModel->created_at,
                'updated_at' => $productModel->updated_at,
            ];
        });
    }

    public function headings(): array
    {
        return [
            'Id',
            'Raw Material',
            'Product Name',
            'Date',
            'Product Size',
            'Model Code',
            'Model Name',
            'R.M Weight/Item', 
            'Wages of One Product',
            'Created At',
            'Updated At',
        ];
    }
}
