<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobAllocationHistory extends Model
{
    use HasFactory;

    protected $fillable = [
        'job_giving_id',
        'employee_id ',
        'receving_date',
        'quantity'
    ];


    public function jobGiving()
    {
        return $this->belongsTo(JobGiving::class, 'job_giving_id');
    }

    public function jobReceived()
    {
        return $this->belongsTo(JobReceived::class, 'job_giving_id');
    }
}
