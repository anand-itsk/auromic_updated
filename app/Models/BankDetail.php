<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BankDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'bank_name',
        'account_number',
        'address',
        'branch_code',
        'branch_name',
        'ifsc_code',
    ];

    public function companies()
    {
        return $this->belongsToMany(Company::class, 'company_bank_details');
    }
    public function companyBankDetails()
    {
        return $this->hasMany(CompanyBankDetail::class, 'bank_detail_id', 'id');
    }
}
