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
        'product_color_id',
        'receving_date',
        'received_quantity',
        'incentive_applicable',
        'receving_date',
        'before_days',
        'after_days',
        'conveyance_fee',
        'deducation_fee',
        'incentive_fee',
        'total_amount',
        'net_amount',
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
