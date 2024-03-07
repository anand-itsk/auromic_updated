<?php

namespace App\Imports;

use App\Models\JobGiving;
use Maatwebsite\Excel\Concerns\ToModel;

class JobGivingImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new JobGiving([
              'employee_id'     => $row[0],
              'order_id'    => $row[1],
              'product_model_id'    => $row[2],
             
        ]);
    }
}
