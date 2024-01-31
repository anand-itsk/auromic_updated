<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyBankDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_id',
        'bank_detail_id'
    ];
}
