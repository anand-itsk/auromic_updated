<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Incentive extends Model
{
    use HasFactory;

      protected $fillable = [
        'product_model_id', 
        'model_size',
        'duration_period'
    ];

     public function productModel(){
        return $this->belongsTo(ProductModel::class,'product_model_id');
    }
    
    public function product()
{
    return $this->belongsTo(Product::class, 'product_id');
}
}
