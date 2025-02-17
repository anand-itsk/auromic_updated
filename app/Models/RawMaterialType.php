<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RawMaterialType extends Model
{
    use HasFactory;
    
 protected $fillable = [
        
        'name',
        'code',
    ];
     public function productModels()
    {
        return $this->hasMany(ProductModel::class,'name');
    }
}
