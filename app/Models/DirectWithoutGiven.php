<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DirectWithoutGiven extends Model
{
    use HasFactory;

    protected $fillable = [

        'employee_id',
        'finishing_product_models_id',
        'receving_date',
        'received_quantity'
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id');
    }
   
    public function finishingProduct()
    {
        return $this->belongsTo(FinishingProductModel::class, 'finishing_product_models_id');
    }

}
