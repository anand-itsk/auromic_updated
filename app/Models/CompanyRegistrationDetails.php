<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyRegistrationDetails extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_id',
        'pf_type',
        'pf_code',
        'pf_date',
        'esi_code',
        'esi_date',
        'factory_act_no',
        'tin_no',
        'cst_no',
        'ssi_no',
        'pan_no',
        'tan_no',
        'license_no',
        'created_by',
        'updated_by',
    ];

    public function company(){
        return $this->belongsTo(Company::class);
    }
}
