<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeliveryChallan extends Model
{
    use HasFactory;
    protected $fillable = [
        'company_id',
        'dc_id',
        'order_id'
    ];

    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id');
    }
    public function order_details()
    {
        return $this->belongsTo(OrderDetail::class, 'order_id');
    }
}
