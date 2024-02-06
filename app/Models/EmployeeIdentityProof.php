<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeIdentityProof extends Model
{
    use HasFactory;

    protected $fillable = [
        'voter_id_number',
        'driving_license_number',
        'pan_number',
        'passport_number',
        'identity_mark',
    ];
}
