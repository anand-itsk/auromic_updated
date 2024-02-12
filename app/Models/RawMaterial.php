<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RawMaterial extends Model
{
    use HasFactory;

 protected $fillable = [
        'raw_material_type_id',
        'name',
        'stock',
    ];
    
     public function rawMaterialType(){
        return $this->belongsTo(RawMaterialType::class);
    }
}
