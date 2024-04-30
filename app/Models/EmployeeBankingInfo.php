<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeBankingInfo extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_id',
        'bank_name',
        'address',
        'account_number',
        'ifsc_code',
        'payment_mode_id',
        'account_type',
        'bank_ref_no',
        'name_as_per_bank',
        'range',
    ];

    public function paymentMode(){
        return $this->belongsTo(PaymentMode::class);
    }

}
