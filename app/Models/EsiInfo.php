<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EsiInfo extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_id',
        'esi_applicable',
        'esi_joining_date',
        'esi_no',
        'esi_last_date',
        'local_office_id',
        'esi_dispensary_id',
    ];
    
}
