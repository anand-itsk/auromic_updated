<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DirectJobReceived extends Model
{
    use HasFactory;
    
     protected $fillable = [
         'direct_job_giving_id',
         'product_model_id',
         'employee_id',
         'product_color_id',
         'incentive_applicable',
         'receving_date',
    ];
}
