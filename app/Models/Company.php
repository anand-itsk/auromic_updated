<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_type_id',
        'company_code',
        'company_name',
        'std_code',
        'phone',
        'starting_date',
        'business_nature',
        'company_email',
        'website',
        'status',
        'created_by',
        'updated_by',
    ];

    public function addresses()
    {
        return $this->morphMany(Address::class, 'addressable');
    }

    public function companyRegistrationDetail()
    {
        return $this->hasOne(CompanyRegistrationDetails::class);
    }
    public function authorisedPerson()
    {
        return $this->hasOne(AuthorisedPerson::class);
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updatedBy()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    public function bankDetail()
    {
        return $this->belongsToMany(BankDetail::class, 'company_bank_details');
    }
}
