<?php

namespace App\Imports;

use App\Models\DeliveryChallan;
use Maatwebsite\Excel\Concerns\ToModel;

class DeliveryChallanImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new DeliveryChallan([
              'company_id  '     => $row[0],
              'order_id '    => $row[1],
              'dc_no '    => $row[2],
              'dc_date '    => $row[3],
        ]);
    }
}
