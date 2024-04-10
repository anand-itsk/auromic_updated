<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DirectJobReceived extends Model
{
    use HasFactory;

    protected $fillable = [
        'direct_job_giving_id',
        'employee_id',
        'finishing_product_models_id',
        'product_color_id',
        'incentive_applicable',
        'receving_date',
        'is_cutting',
        'balance_meter',
        'quantity',
        'wages_for_product',
        'usage',
        'shortage',
        'wastage',
        'before_days',
        'after_days',
        'conveyance_fee',
        'deducation_fee',
        'incentive_fee',
        'total_amount',
        'net_amount',
    ];

       public function employee(){
        return $this->belongsTo(Employee::class,'employee_id');
    }   

       public function directJobGiven(){
        return $this->belongsTo(DirectJobGiving::class,'direct_job_giving_id');
    } 
  

     public function productColor(){
        return $this->belongsTo(ProductColor::class,'product_color_id');
    }

    public function finishingProduct()
{
    return $this->belongsTo(FinishingProductModel::class, 'finishing_product_models_id');
}
}
