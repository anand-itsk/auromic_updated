<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeNominee extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_id',
        'family_member_id',
        'gratuity_sharing',
        'marital_status',
        'religion_id',
        'faorhus_name',
        'guardian_name',
        'guardian_address',
        'guardian_relation_with_emp',
    ];

    public function familyMember()
    {
        return $this->belongsTo(EmployeeFamilyMemberDetail::class, 'family_member_id');
    }

    public function religion()
    {
        return $this->belongsTo(Religion::class, 'religion_id');
    }
}
