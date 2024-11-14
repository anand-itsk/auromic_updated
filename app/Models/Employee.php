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
        'own_company'
    ];

    public function company()
    {
        return $this->belongsTo(Company::class,'company_id');
    }

    public function addresses()
    {
        return $this->morphMany(Address::class, 'addressable');
    }
    public function villageAddress()
{
    return $this->hasOne(Address::class)->where('address_type_id', 4);
}
    public function villageAddressTypeThree()
    {
        return $this->hasOne(Address::class)->where('address_type_id', 3);
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
        return $this->belongsTo(Religion::class, 'religion_id');
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


public function parentCompany()
    {
        return $this->belongsTo(CompanyHierarchy::class, 'company_id', 'company_id')
                    ->select('parent_company_id');
    }



    public function masterCompany()
    {
        return $this->belongsTo(Company::class, 'company_id', 'id')
            ->where('company_type_id', 2); // 2 for Master Company
    }

    public function clientCompany()
    {
        return $this->belongsTo(Company::class, 'company_id', 'id')
            ->where('company_type_id', 3); // 3 for Client Company
    }

    public function subClientCompany()
    {
        return $this->belongsTo(Company::class, 'company_id', 'id')
            ->where('company_type_id', 4); // 4 for Sub Client Company
    }


}
