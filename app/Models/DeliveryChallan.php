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
        'order_id',
        'product_size_id',
        'product_color_id',
        'quantity'
    ];

    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id');
    }
    public function order_details()
    {
        return $this->belongsTo(OrderDetail::class, 'order_id');
    }
      public function productSize(){
        return $this->belongsTo(ProductSize::class,'product_size_id');
    }

     public function productColor(){
        return $this->belongsTo(ProductColor::class,'product_color_id');
    }
}
