<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;

    protected $fillable = [
        'address',
        'state_id',
        'country_id',
        'district_id',
        'pincode',
        'village_area',
        'address_type_id',
    ];

    public function addressable()
    {
        return $this->morphTo();
    }

    public function country()
    {
        return $this->belongsTo(Country::class);
    }
    public function state()
    {
        return $this->belongsTo(State::class);
    }
    public function district()
    {
        return $this->belongsTo(District::class);
    }
    public function addressType()
    {
        return $this->belongsTo(AddressType::class);
    }
}
