<?php

namespace App\Imports;

use App\Models\OrderDetail;
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
        return new OrderDetail([
              'order_no'     => $row[0],
              'order_date'    => $row[1],
              'customer_id '    => $row[2],
              
        ]);
    }
}
