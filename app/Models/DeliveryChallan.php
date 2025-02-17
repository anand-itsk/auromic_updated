<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeliveryChallan extends Model
{
    use HasFactory;
    protected $fillable = [
        'company_id',
         'sub_company_id',
        'dc_no',
        'order_id',
        'dc_date',
        'quantity',
        'weight',
        'available_quantity',
        'excess',
        'shortage'
    ];


    public function orderDetails()
    {
        return $this->belongsTo(OrderDetail::class, 'order_id');
    }
    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id');
    }
    public function order_details()
    {
        return $this->belongsTo(OrderNo::class, 'order_id');
    }
    public function productSize()
    {
        return $this->belongsTo(ProductSize::class, 'product_size_id');
    }

    public function productColor()
    {
        return $this->belongsTo(ProductColor::class, 'product_color_id');
    }
    public function subCompany()
    {
        return $this->belongsTo(CompanyHierarchy::class, 'sub_company_id', 'company_id');
    }


    
}
