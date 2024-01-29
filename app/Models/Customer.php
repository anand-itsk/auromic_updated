<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_code',
        'customer_name',
        'std_code',
        'phone',
        'email',
        'mobile',
        'tin_no',
        'tin_date',
        'cst_no',
        'cst_date',
        'license_no',
        'website',
    ];

    public function addresses()
    {
        return $this->morphMany(Address::class, 'addressable');
    }
}
