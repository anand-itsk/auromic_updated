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

    public function identityProof(){
        return $this->hasOne(EmployeeIdentityProof::class);
    }
   
    public function financeDetail(){
        return $this->hasOne(EmployeeBankingInfo::class);
    }
   
    public function licInfo(){
        return $this->hasOne(LicInfo::class);
    }
   
    public function pfInfo(){
        return $this->hasOne(PfInfo::class);
    }
   
    public function esiInfo(){
        return $this->hasOne(EsiInfo::class);
    }
   
    public function familyMembers(){
        return $this->hasMany(EmployeeFamilyMemberDetail::class);
    }
   
    public function nominee(){
        return $this->hasMany(EmployeeNominee::class);
    }


}
