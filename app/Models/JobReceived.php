<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobReceived extends Model
{
    use HasFactory;

    protected $fillable = [
        'job_giving_id',
        'incentive_applicable',
        'status',
        'receving_date',
        'complete_quantity',
        'before_days',
        'after_days',
        'current_weight',
        'conveyance_fee',
        'deducation_fee',
        'incentive_fee',
        'total_amount',
        'net_amount',
    ];
}
