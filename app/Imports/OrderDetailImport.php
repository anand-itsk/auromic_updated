<?php

namespace App\Imports;

use App\Models\OrderDetail;
use App\Models\OrderNo;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\ToModel;

class OrderDetailImport implements ToModel
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        try {
            $orderDate = Carbon::parse($row[1])->format('Y-m-d');
        } catch (\Exception $e) {
            $orderDate = now()->format('Y-m-d');
        }

        try {
            $deliveryDate = Carbon::parse($row[8])->format('Y-m-d');
        } catch (\Exception $e) {
            $deliveryDate = now()->format('Y-m-d');
        }

        $orderNOId = (int) $row[0];
        $customerId = (int) $row[2];
        $productSizeId = (int) $row[3];
        $productModelId = (int) $row[4];
        $productColorId = (int) $row[5];
        $orderStatusId = (int) $row[9];
        $created_by = (int) $row[15];

        $orderNo = OrderNo::Create(
            ['id' => $orderNOId], 
            ['created_by' => 1]  
        );

        if (
            !DB::table('customers')->where('id', $customerId)->exists() ||
            !DB::table('product_sizes')->where('id', $productSizeId)->exists() ||
            !DB::table('product_models')->where('id', $productModelId)->exists() ||
            !DB::table('product_colors')->where('id', $productColorId)->exists() ||
            !DB::table('order_statuses')->where('id', $orderStatusId)->exists()
        ) {

            Log::warning("Invalid foreign key references for row: " . json_encode($row));
            // return null; 
        }

        return new OrderDetail([
            'order_no_id'         => $orderNo->id,
            'order_date'          => $orderDate,
            'customer_id'         => $customerId,
            'product_size_id'     => $productSizeId,
            'product_model_id'    => $productModelId,
            'product_color_id'    => $productColorId,
            'quantity'            => (int) $row[6],
            'available_quantity'  => (int) $row[7],
            'delivery_date'       => $deliveryDate,
            'order_status_id'     => $orderStatusId,
            'total_raw_material'  => (float) $row[10],
            'weight_per_item'     => (float) $row[11],
            'available_weight'    => (float) $row[12],
        ]);
    }
}
