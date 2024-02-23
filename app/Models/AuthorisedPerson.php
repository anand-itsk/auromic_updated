<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AuthorisedPerson extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_id',
        'name',
        'faorhus_name',
        'gender',
        'blood_group',
        'dob',
        'person_email',
        'pan_no',
        'std_code',
        'phone',
        'mobile',
        'percent',
        'photo',
        'status',
    ];
    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id');
    }
}
