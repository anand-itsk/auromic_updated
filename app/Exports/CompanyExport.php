<?php

namespace App\Exports;

use App\Models\Company;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class CompanyExport implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Company::all()->map(function ($company) {
            $officeAddress = $company->addresses()->where('address_type_id', 2)->first();
            $residentialAddress = $company->addresses()->where('address_type_id', 3)->first();

            return [
                'Company Id' => $company->id,
                'Company Code' => $company->company_code,
                'Company Name' => $company->company_name,
                'Office Address' => $officeAddress ? $officeAddress->address : '',
                'Office Country' => $officeAddress ? $officeAddress->country->name : '',
                'Office State' => $officeAddress ? $officeAddress->state->name : '',
                'Office Pincode' => $officeAddress ? $officeAddress->pincode : '',
                'STD Code' => $company->std_code ?? '',
                'Phone' => $company->phone ?? '',
                'Residential Address' => $residentialAddress ? $residentialAddress->address : '',
                'Residential Country' => $residentialAddress ? $residentialAddress->country->name : '',
                'Residential State' => $residentialAddress ? $residentialAddress->state->name : '',
                'Residential Pincode' => $residentialAddress ? $residentialAddress->pincode : '',
                'Mobile' => $company->mobile ?? '',
                'Email' => $company->email ?? '',
                'TIN No' => $company->tin_no ?? '',
                'TIN Date' => $company->tin_date ?? '',
                'GST No' => $company->gst_no ?? '',
                'GST Date' => $company->cst_date ?? '',
            ];
        });
    }

    public function headings(): array
    {
        return [
            'Company Id',
            'Company Code',
            'Company Name',
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
