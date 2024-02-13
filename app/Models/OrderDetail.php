<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    use HasFactory;
     protected $fillable = [
        'order_no',
        'order_date',
        'customer_id',
        'product_size_id',
        'product_model_id',
        'product_color_id',
        'quantity',
        'delivery_date	',
        'oder_status_id ',
        'total_raw_material',
    ];
}
