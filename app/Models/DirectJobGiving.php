<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DirectJobGiving extends Model
{
    use HasFactory;

     protected $fillable = [
         'employee_id',
         'finishing_product_models_id',
         'product_size_id',
         'product_color_id',
         'quantity',
         'complete_quantity',
         'weight',
    ];
   public function employee(){
        return $this->belongsTo(Employee::class,'employee_id');
    }   
    public function productModel(){
        return $this->belongsTo(ProductModel::class,'product_model_id');
    }  

     public function productSize(){
        return $this->belongsTo(ProductSize::class,'product_size_id');
    }

     public function productColor(){
        return $this->belongsTo(ProductColor::class,'product_color_id');
    }

    public function finishingProduct()
{
    return $this->belongsTo(FinishingProductModel::class, 'finishing_product_models_id');
}

}
