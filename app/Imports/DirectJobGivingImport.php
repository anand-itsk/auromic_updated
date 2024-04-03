<?php

namespace App\Imports;

use App\Models\DirectJobGiving;
use Maatwebsite\Excel\Concerns\ToModel;

class DirectJobGivingImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new DirectJobGiving([
             'employee_id'     => $row[0],
              'product_model_id'    => $row[1],
              
        ]);
    }
}
