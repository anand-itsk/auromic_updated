<?php

namespace App\Exports;

use App\Models\Customer;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class CustomersExport implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Customer::all()->map(function ($customer) {
            $officeAddress = $customer->addresses()->where('address_type_id', 2)->first();
            $residentialAddress = $customer->addresses()->where('address_type_id', 3)->first();

            return [
                'Customer Id' => $customer->id,
                'Customer Code' => $customer->customer_code,
                'Customer Name' => $customer->customer_name,
                'Office Address' => $officeAddress ? $officeAddress->address : '',
                'Office Country' => $officeAddress ? $officeAddress->country->name : '',
                'Office State' => $officeAddress ? $officeAddress->state->name : '',
                'Office Pincode' => $officeAddress ? $officeAddress->pincode : '',
                'STD Code' => $customer->std_code ?? '',
                'Phone' => $customer->phone ?? '',
                'Residential Address' => $residentialAddress ? $residentialAddress->address : '',
                'Residential Country' => $residentialAddress ? $residentialAddress->country->name : '',
                'Residential State' => $residentialAddress ? $residentialAddress->state->name : '',
                'Residential Pincode' => $residentialAddress ? $residentialAddress->pincode : '',
                'Mobile' => $customer->mobile ?? '',
                'Email' => $customer->email ?? '',
                'TIN No' => $customer->tin_no ?? '',
                'TIN Date' => $customer->tin_date ?? '',
                'GST No' => $customer->gst_no ?? '',
                'CST Date' => $customer->cst_date ?? '',
            ];
        });
    }

    public function headings(): array
    {
        return [
            'Customer Id',
            'Customer Code',
            'Customer Name',
            'Office Address',
            'Country',
            'State',
            'Pincode',
            'STD Code',
            'Phone',
            'Address',
            'Country',
            'State',
            'Pincode',
            'Mobile',
            'Email',
            'TIN No',
            'TIN Date',
            'GST No',
            'CST Date',
            'created_at',
            'updated_at'
        ];
    }
}
