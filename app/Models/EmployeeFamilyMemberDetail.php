<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeFamilyMemberDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_id',
        'name',
        'relation_with_emp',
        'dob',
        'is_residing',
        'remark',
    ];

    public function addresses()
    {
        return $this->morphMany(Address::class, 'addressable');
    }
    
}
