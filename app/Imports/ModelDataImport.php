<?php

namespace App\Imports;

use App\Models\ProductModel;
use App\Models\Product;
use App\Models\ProductSize;
use App\Models\RawMaterial;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\Importable;
use Illuminate\Validation\ValidationException;

class ModelDataImport implements ToModel, SkipsOnFailure
{
    use Importable, SkipsFailures;

    public function model(array $row)
    {
       
        try {
            $date = Carbon::createFromFormat('d-m-Y', trim($row[2]))->format('Y-m-d');
        } catch (\Exception $e) {
            Log::warning("Invalid date format in row: " . json_encode($row));
            $date = now()->format('Y-m-d');
        }

        $rawMaterialName = trim($row[1]); 
        $productName = trim($row[2]); 
        $productSizeName = trim($row[4]); 
        $modelCode = trim($row[5]); 

       
        $rawMaterial = RawMaterial::where('name', $rawMaterialName)->first();
        $product = Product::where('name', $productName)->first();
        $productSize = ProductSize::where('name', $productSizeName)->first();

        if (!$rawMaterial || !$product || !$productSize) {
            Log::warning("Invalid foreign key references for row: " . json_encode($row));
            return null;
        }
        $exists = ProductModel::where([
            'raw_material_id' => $rawMaterial->id,
            'product_id' => $product->id,
            'product_size_id' => $productSize->id,
            'model_code' => $modelCode
        ])->exists();

        if ($exists) {
            Log::warning("Duplicate entry found for Model Code: {$modelCode}, skipping...");
            return null; 
        }

        return new ProductModel([
            'raw_material_id' => $rawMaterial->id,
            'product_id' => $product->id,
            'date' => $date,
            'product_size_id' => $productSize->id,
            'model_code' => $modelCode,
            'model_name' => trim($row[6]), 
            'raw_material_weight_item' => $row[7] ?? 0, 
            'wages_product' => $row[8] ?? 0,
        ]);
    }
}
