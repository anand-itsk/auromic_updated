<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobReceived extends Model
{
    use HasFactory;

    protected $fillable=[
        'job_giving_id',
        'incentive_applicable',
        'status',
        'receving_date'
    ];

  
}
    