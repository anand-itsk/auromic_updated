<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Incentive extends Model
{
    use HasFactory;

      protected $fillable = [
        'finishing_product_models_id', 
        'duration_period',
        'amount'
    ];

     public function productModel(){
        return $this->belongsTo(ProductModel::class,'product_model_id');
    }
    
    public function product()
{
    return $this->belongsTo(Product::class, 'product_id');
}

public function finishingProduct()
{
    return $this->belongsTo(FinishingProductModel::class, 'finishing_product_models_id');
}
}
