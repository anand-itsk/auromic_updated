<?php

namespace App\Imports;

use App\Models\ProductModel;
use Maatwebsite\Excel\Concerns\ToModel;

class ModelDataImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new ProductModel([
            'product_id'     => $row[0],
            'model_code'    => $row[1],
            'model_name'    => $row[2],
            
        ]);
    }
}
