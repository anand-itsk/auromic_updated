<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductModel extends Model
{
    use HasFactory;

     protected $fillable = [
        'raw_material_id ',
        'product_id ',
        'product_size_id ',
        'model_code ',
         'model_name ',
         'raw_material_weight_item ',
         'wages_product ',
    ];

    public function rawMaterial()
{
    return $this->belongsTo(RawMaterial::class, 'raw_material_id');
}


public function product()
{
    return $this->belongsTo(Product::class, 'product_id');
}

public function productSize()
{
    return $this->belongsTo(ProductSize::class, 'product_size_id');
}

    public function orderDetail()
    {
        return $this->hasMany(Product::class, 'product_id');
    }
    
}
