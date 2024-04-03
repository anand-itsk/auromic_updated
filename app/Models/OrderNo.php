<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OrderNo extends Model
{
    use HasFactory;

    protected $fillable = [
        'last_order_number',
        'customer_order_no',
        'created_by'
    ];
}
