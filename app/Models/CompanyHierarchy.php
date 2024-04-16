<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyHierarchy extends Model
{
    use HasFactory;

        protected $fillable = [
        'company_id',
        'parent_company_id',
        
    ];
     public function company()
    {
        return $this->belongsTo(Company::class, 'company_id');
    }
}
