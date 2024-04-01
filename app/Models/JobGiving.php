<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobGiving extends Model
{
    use HasFactory;
    protected $fillable = [
        'employee_id',
        'order_id',
        'dc_id',
        'status',
        'product_model_id',
        'quantity',
        'weight',
        'excess',
        'shortage',
        'days',
        'date'
    ];
    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id');
    }
    public function order_details()
    {
        return $this->belongsTo(OrderDetail::class, 'order_id');
    }
    public function delivery_chellan()
    {
        return $this->belongsTo(DeliveryChallan::class, 'dc_id');
    }
    public function product_model()
    {
        return $this->belongsTo(ProductModel::class, 'product_model_id');
    }
 public function job_received()
{
    return $this->hasOne(JobReceived::class, 'job_giving_id');
}
}
