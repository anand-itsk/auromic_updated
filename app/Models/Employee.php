<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_id',
        'employee_code',
        'employee_name',
        'dob',
        'gender',
        'blood_group',
        'email',
        'mobile',
        'faorhus_name',
        'mother_name',
        'marital_status',
        'std_code',
        'phone',
        'status',
        'photo',
        'religion_id',
        'caste_id',
        'nationality_id',
        'joining_date',
        'prob_period',
        'confirm_date',
        'resigning_date',
        'resigning_reason_id',
    ];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function addresses()
    {
        return $this->morphMany(Address::class, 'addressable');
    }
    public function villageAddress()
{
    return $this->hasOne(Address::class)->where('address_type_id', 4);
}

    public function identityProof()
    {
        return $this->hasOne(EmployeeIdentityProof::class);
    }

    public function financeDetail()
    {
        return $this->hasOne(EmployeeBankingInfo::class);
    }

    public function licInfo()
    {
        return $this->hasOne(LicInfo::class);
    }

    public function pfInfo()
    {
        return $this->hasOne(PfInfo::class);
    }

    public function esiInfo()
    {
        return $this->hasOne(EsiInfo::class);
    }

    public function familyMembers()
    {
        return $this->hasMany(EmployeeFamilyMemberDetail::class);
    }

    public function nominee()
    {
        return $this->hasMany(EmployeeNominee::class);
    }

    public function religion()
    {
        return $this->belongsTo(Religion::class);
    }

    public function caste()
    {
        return $this->belongsTo(Caste::class);
    }

    public function nationality()
    {
        return $this->belongsTo(Nationality::class);
    }

    public function resigningReason()
    {
        return $this->belongsTo(ResigningReason::class);
    }
}
