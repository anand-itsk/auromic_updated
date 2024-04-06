<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FinishingProductModel extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'product_size_id',
        'model_code',
        'model_name',
        'meters_one_product',
        'cutting_charge',
        'date'

    ];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function productSize()
    {
        return $this->belongsTo(ProductSize::class, 'product_size_id');
    }
}
