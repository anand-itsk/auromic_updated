<?php

namespace App\Imports;

use App\Models\FinishingProductModel;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Validation\ValidationException;

class FinishingProductImport implements ToModel
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        try {
            $date = Carbon::parse($row[5])->format('Y-m-d'); // Parse and format the date
        } catch (\Exception $e) {
            $date = now()->format('Y-m-d'); // Use current date if parsing fails
        }

        $productId = (int) $row[0];
        $productSizeId = (int) $row[1];

        // Check if foreign key constraints exist
        if (
            !DB::table('products')->where('id', $productId)->exists() ||
            !DB::table('product_sizes')->where('id', $productSizeId)->exists()
        ) {
            Log::warning("Invalid foreign key references for row: " . json_encode($row));
            return null;
        }

        // Check for duplicate entry
        $exists = FinishingProductModel::where([
            'product_id' => $productId,
            'product_size_id' => $productSizeId,
            'model_code' => $row[2], // Model Code must be unique
        ])->exists();

        if ($exists) {
            throw ValidationException::withMessages([
                'error' => ["Duplicate entry found for Model Code: {$row[2]}"]
            ]);
        }

        return new FinishingProductModel([
            'product_id'         => $productId,
            'product_size_id'    => $productSizeId,
            'model_code'         => $row[2],
            'model_name'         => $row[3],
            'wages_one_product'  => $row[4],
            'date'               => $date,
        ]);
    }
}
