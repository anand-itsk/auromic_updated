<?php

namespace App\Imports;

use App\Models\FinishingProductModel;
use Maatwebsite\Excel\Concerns\ToModel;

class FinishingProductImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new FinishingProductModel([
           'product_id'     => $row[0],
            'product_size_id'    => $row[1],
            'model_code'    => $row[2],
            'model_name'    => $row[3],
            'wages_one_product'    => $row[4],
            'date'    => $row[5],
        ]);
    }
}
