<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    use HasFactory;
    protected $fillable = [
        'order_no_id',
        'order_date',
        'customer_id',
        'product_size_id',
        'product_model_id',
        'product_color_id',
        'quantity',
        'available_quantity',
        'delivery_date	',
        'order_status_id ',
        'weight_per_item',
        'available_weight',
        'total_raw_material',
    ];

    public function orderNo()
    {
        return $this->belongsTo(OrderNo::class, 'order_no_id');
    }

    public function productSize()
    {
        return $this->belongsTo(ProductSize::class, 'product_size_id');
    }

    public function productColor()
    {
        return $this->belongsTo(ProductColor::class, 'product_color_id');
    }
    public function orderStatus()
    {
        return $this->belongsTo(OrderStatus::class, 'order_status_id');
    }
public function productModel()
{
    return $this->belongsTo(ProductModel::class, 'product_model_id')->with('product');
}
    
    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }

    public function deliveryChallans()
{
    return $this->hasMany(DeliveryChallan::class, 'order_id');
}
}
