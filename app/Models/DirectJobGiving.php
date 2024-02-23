<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DirectJobGiving extends Model
{
    use HasFactory;

     protected $fillable = [
        'employee_id',
        'product_model_id',
    ];
   public function employee(){
        return $this->belongsTo(Employee::class,'employee_id');
    }   
    public function productModel(){
        return $this->belongsTo(ProductModel::class,'product_model_id');
    }  

}
