<?php

namespace App\Imports;

use App\Models\Incentive;
use Maatwebsite\Excel\Concerns\ToModel;

class IncentiveImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Incentive([
              'product_id '     => $row[0],
              'model_size'    => $row[1],
              'duration_period '    => $row[2],
              
        ]);
    }
}
