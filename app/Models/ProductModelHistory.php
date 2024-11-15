<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductModelHistory extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_model_id',
        'wages_product ',
        'date'
    ];

    public function productModel()
    {
        return $this->belongsTo(ProductModel::class);
    }
}
