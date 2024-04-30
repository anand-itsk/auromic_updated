@extends('layouts.app')
<!-- DataTables CSS -->
@section('content')
    <!-- Add Select2 CSS -->
    @include('links.css.select2.select2')
    @include('links.css.wizard-form.wizard-form')
    <style>
        .employee_status {
            padding: 6px 15px 4px 10px;
            text-transform: capitalize;
            color: white;
            width: fit-content;
        }
    </style>
    <div class="wrapper">
        <div class="container-fluid">
            <!-- Page-Title -->
            <div class="row">
                <div class="col-sm-12">
                    <div class="page-title-box pb-1">
                        <div class="btn-group float-right">
                            <ol class="breadcrumb hide-phone p-0 m-0">
                                <li class="breadcrumb-item"><a href="{{ route('home') }}">Auromics</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('master.employees.index') }}">Employees</a>
                                </li>
                                {{-- <li class="breadcrumb-item">Create</li> --}}
                            </ol>
                        </div>
                        <h4 class="page-title">Employee</h4>
                    </div>
                </div>
            </div>
            <!-- end page title end breadcrumb -->
            <section class="">
                <div class="row d-flex justify-content-center">
                    <div class="col-md-12">
                        <div class="wizard">
                            <div class="row">
                                <div class="col-12">
                                    <div class="d-flex justify-content-end align-items-center pb-2">
                                        <a class="mr-2" href="{{ route('master.employees.edit', $employee->id) }}"><button
                                                class="btn btn-primary">
                                                Edit</button></a>
                                        <a class="mr-2" href="{{ route('master.employees.index') }}"><button
                                                class="btn btn-danger">
                                                Close</button></a>

                                    </div>
                                    <div class="card m-b-30">
                                        @if ($employee->status == 'working')
                                            <span class="employee_status bg-success">{{ $employee->status }}</span>
                                        @elseif($employee->status == 'relieving')
                                            <span class="employee_status bg-warning">{{ $employee->status }}</span>
                                        @else
                                            <span class="employee_status bg-danger">{{ $employee->status }}</span>
                                        @endif
                                        <div class="card-body">
                                            <div class="m-b-30">
                                                <div class="row text-center">
                                                    <div class="col-md-9">
                                                        <div class="row">
                                                            <div class="col-md-3">
                                                                <h6>Employee Code</h6>
                                                                <p class="mb-1">{{ $employee->employee_code }}</p>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <h6>Employee Name</h6>
                                                                <p class="mb-1">{{ $employee->employee_name }}</p>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <h6>Company Name</h6>
                                                                <p class="mb-1">{{ $employee->company->company_name }}</p>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <h6>Company Code</h6>
                                                                <p class="mb-1">{{ $employee->company->company_code }}
                                                                </p>
                                                            </div>
                                                        </div>


                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="profile-frame">
                                                            @if (!empty($employee->photo))
                                                                <img src="{{ asset('/storage/' . $employee->photo) }}"
                                                                    alt="Profile Image">
                                                            @else
                                                                <img src="{{ asset('assets/images/no-profile.png') }}"
                                                                    alt="No Profile Image">
                                                            @endif
                                                        </div>
                                                    </div>



                                                </div>

                                                <hr class="my-1">
                                                <h5 class="font-weight-lighter text-center text-primary">Personal Details
                                                </h5>
                                                <div class="row">
                                                    @php
                                                        $officeAddress = $employee->addresses
                                                            ->where('address_type_id', 3)
                                                            ->first();
                                                    @endphp
                                                    <div class="col-md-4">
                                                        @php
                                                            $permanentAddress = $employee->addresses
                                                                ->where('address_type_id', 4)
                                                                ->first();
                                                        @endphp
                                                        <h6 class="font-weight-lighter text-primary">Permanent Address</h6>
                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <span class="font-weight-bold">Address</span>
                                                            </div>
                                                            <div class="col-md-8 ">
                                                                <span> {{ $permanentAddress->address ?? '-' }}</span>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <span class="font-weight-bold">City</span>
                                                            </div>
                                                            <div class="col-md-8 ">
                                                                <span> {{ $permanentAddress->village_area ?? '-' }}</span>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <span class="font-weight-bold">District</span>
                                                            </div>
                                                            <div class="col-md-8 ">
                                                                <span>
                                                                    {{ $permanentAddress->district->name ?? '-' }}</span>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <span class="font-weight-bold">State</span>
                                                            </div>
                                                            <div class="col-md-8 ">
                                                                <span> {{ $permanentAddress->state->name ?? '-' }}</span>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <span class="font-weight-bold">Pin Code</span>
                                                            </div>
                                                            <div class="col-md-8 ">
                                                                <span> {{ $permanentAddress->pincode ?? '-' }}</span>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <span class="font-weight-bold">Country</span>
                                                            </div>
                                                            <div class="col-md-8 ">
                                                                <span> {{ $permanentAddress->country->name ?? '-' }}</span>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <span class="font-weight-bold">Phone</span>
                                                            </div>
                                                            <div class="col-md-8 ">
                                                                <span> {{ $employee->std_code ?? '' }}</span>
                                                                <span> {{ $employee->phone ?? '-' }}</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        @php
                                                            $address = $employee->addresses
                                                                ->where('address_type_id', 5)
                                                                ->first();
                                                        @endphp
                                                        <h6 class="font-weight-lighter text-primary">Correspondence Address
                                                        </h6>
                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <span class="font-weight-bold">Address</span>
                                                            </div>
                                                            <div class="col-md-8 ">
                                                                <span> {{ $address->address ?? '-' }}</span>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <span class="font-weight-bold">City</span>
                                                            </div>
                                                            <div class="col-md-8 ">
                                                                <span> {{ $address->village_area ?? '-' }}</span>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <span class="font-weight-bold">District</span>
                                                            </div>
                                                            <div class="col-md-8 ">
                                                                <span>
                                                                    {{ $address->district->name ?? '-' }}</span>
                                                            </div>
                                                        </div>

                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <span class="font-weight-bold">State</span>
                                                            </div>
                                                            <div class="col-md-8 ">
                                                                <span> {{ $address->state->name ?? '-' }}</span>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <span class="font-weight-bold">Pin Code</span>
                                                            </div>
                                                            <div class="col-md-8 ">
                                                                <span> {{ $address->pincode ?? '-' }}</span>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <span class="font-weight-bold">Country</span>
                                                            </div>
                                                            <div class="col-md-8 ">
                                                                <span> {{ $address->country->name ?? '-' }}</span>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <span class="font-weight-bold">Mobile</span>
                                                            </div>
                                                            <div class="col-md-8 ">
                                                                <span> {{ $employee->mobile ?? '-' }}</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">

                                                        <h6 class="font-weight-lighter text-primary">Identity Proof</h6>
                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <span class="font-weight-bold">Aadhar Number</span>
                                                            </div>
                                                            <div class="col-md-8 ">
                                                                <span>
                                                                    {{ $employee->identityProof->aadhar_number ?? '-' }} /
                                                                    {{ $employee->identityProof->aadhar_name }}</span>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <span class="font-weight-bold">Voter ID No</span>
                                                            </div>
                                                            <div class="col-md-8 ">
                                                                <span>
                                                                    {{ $employee->identityProof->voter_id_number ?? '-' }}</span>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <span class="font-weight-bold">Driving Licence No</span>
                                                            </div>
                                                            <div class="col-md-8 ">
                                                                <span>
                                                                    {{ $employee->identityProof->driving_license_number ?? '-' }}</span>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <span class="font-weight-bold">PAN No</span>
                                                            </div>
                                                            <div class="col-md-8 ">
                                                                <span>
                                                                    {{ $employee->identityProof->pan_number ?? '-' }}</span>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <span class="font-weight-bold">Passport No</span>
                                                            </div>
                                                            <div class="col-md-8 ">
                                                                <span>
                                                                    {{ $employee->identityProof->passport_number ?? '-' }}</span>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <span class="font-weight-bold">Identity Mark</span>
                                                            </div>
                                                            <div class="col-md-8 ">
                                                                <span>
                                                                    {{ $employee->identityProof->identity_mark ?? '-' }}</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- Repeat for all fields as per the modal layout -->
                                                </div>

                                                <hr class="my-1" />
                                                <h6 class="font-weight-lighter mt-4 text-primary">Other Details</h6>
                                                <div class="row">

                                                    <div class="col-md-4">
                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <span class="font-weight-bold">DOB</span>
                                                            </div>
                                                            <div class="col-md-8 ">
                                                                <span>
                                                                    {{ $employee->dob ? date('d/M/Y', strtotime($employee->dob)) : '-' }}</span>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-4">
                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <span class="font-weight-bold">Gender</span>
                                                            </div>
                                                            <div class="col-md-8 ">
                                                                <span> {{ $employee->gender ?? '-' }}</span>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-4">
                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <span class="font-weight-bold">Blood Group</span>
                                                            </div>
                                                            <div class="col-md-8 ">
                                                                <span> {{ $employee->blood_group ?? '-' }}</span>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-4">
                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <span class="font-weight-bold">Email</span>
                                                            </div>
                                                            <div class="col-md-8 ">
                                                                <span> {{ $employee->email ?? '-' }}</span>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-4">
                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <span class="font-weight-bold">Mobile</span>
                                                            </div>
                                                            <div class="col-md-8 ">
                                                                <span> {{ $employee->mobile ?? '-' }}</span>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-4">
                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <span class="font-weight-bold">Father's/Husband Name</span>
                                                            </div>
                                                            <div class="col-md-8 ">
                                                                <span> {{ $employee->faorhus_name ?? '-' }}</span>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-4">
                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <span class="font-weight-bold">Marital Status</span>
                                                            </div>
                                                            <div class="col-md-8 ">
                                                                <span> {{ $employee->marital_status ?? '-' }}</span>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-4">
                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <span class="font-weight-bold">Phone</span>
                                                            </div>
                                                            <div class="col-md-8 ">
                                                                <span> {{ $employee->std_code ?? '' }} -
                                                                    {{ $employee->phone ?? '' }}</span>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-4">
                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <span class="font-weight-bold">Religion</span>
                                                            </div>
                                                            <div class="col-md-8 ">
                                                                <span> {{ $employee->religion->name ?? '-' }}</span>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-4">
                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <span class="font-weight-bold">Caste</span>
                                                            </div>
                                                            <div class="col-md-8 ">
                                                                <span> {{ $employee->caste->name ?? '-' }}</span>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-4">
                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <span class="font-weight-bold">Nationality</span>
                                                            </div>
                                                            <div class="col-md-8 ">
                                                                <span> {{ $employee->nationality->name ?? '-' }}</span>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-4">
                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <span class="font-weight-bold">Joining Date</span>
                                                            </div>
                                                            <div class="col-md-8 ">
                                                                <span>
                                                                    {{ $employee->joining_date ? date('d/M/Y', strtotime($employee->joining_date)) : '-' }}</span>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-4">
                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <span class="font-weight-bold">Prob Period in Month</span>
                                                            </div>
                                                            <div class="col-md-8 ">
                                                                <span> {{ $employee->prob_period ?? '-' }}</span>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-4">
                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <span class="font-weight-bold">Confirm Date</span>
                                                            </div>
                                                            <div class="col-md-8 ">
                                                                <span> {{ $employee->confirm_date ?? '-' }}</span>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-4">
                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <span class="font-weight-bold">Resigning Date</span>
                                                            </div>
                                                            <div class="col-md-8 ">
                                                                <span> {{ $employee->resigning_date ?? '-' }}</span>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-4">
                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <span class="font-weight-bold">Resigning Reason</span>
                                                            </div>
                                                            <div class="col-md-8 ">
                                                                <span> {{ $employee->resigningReason->name ?? '-' }}</span>
                                                            </div>
                                                        </div>
                                                    </div>


                                                </div>

                                                <hr class="my-1" />
                                                {{-- Finance Details --}}
                                                <h5 class="font-weight-lighter text-center text-primary">Finance
                                                    Details</h5>
                                                <div class="row">
                                                    {{-- Banking Info --}}
                                                    <div class="col-md-3">
                                                        <h6 class="font-weight-lighter text-primary">Banking Info</h6>
                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <span class="font-weight-bold">Bank Name</span>
                                                            </div>
                                                            <div class="col-md-8 ">
                                                                <span>
                                                                    {{ $employee->financeDetail->bank_name ?? '-' }}</span>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <span class="font-weight-bold">Account Number</span>
                                                            </div>
                                                            <div class="col-md-8 ">
                                                                <span>
                                                                    {{ $employee->financeDetail->account_number ?? '-' }}</span>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <span class="font-weight-bold">IFSC Code</span>
                                                            </div>
                                                            <div class="col-md-8 ">
                                                                <span>
                                                                    {{ $employee->financeDetail->ifsc_code ?? '-' }}</span>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <span class="font-weight-bold">Name as per Bank</span>
                                                            </div>
                                                            <div class="col-md-8 ">
                                                                <span>
                                                                    {{ $employee->financeDetail->name_as_per_bank ?? '-' }}</span>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <span class="font-weight-bold">Address</span>
                                                            </div>
                                                            <div class="col-md-8 ">
                                                                <span>
                                                                    {{ $employee->financeDetail->address ?? '-' }}</span>
                                                            </div>
                                                        </div>

                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <span class="font-weight-bold">Payment Mode</span>
                                                            </div>
                                                            <div class="col-md-8 ">
                                                                <span>
                                                                    {{ $employee->financeDetail->paymentMode->name ?? '-' }}</span>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <span class="font-weight-bold">Account Type</span>
                                                            </div>
                                                            <div class="col-md-8 ">
                                                                <span>
                                                                    {{ $employee->financeDetail->account_type ?? '-' }}</span>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <span class="font-weight-bold">Bank Ref.no</span>
                                                            </div>
                                                            <div class="col-md-8 ">
                                                                <span>
                                                                    {{ $employee->financeDetail->bank_ref_no ?? '-' }}</span>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <span class="font-weight-bold">Ward/ Circle/ Range</span>
                                                            </div>
                                                            <div class="col-md-8 ">
                                                                <span>
                                                                    {{ $employee->financeDetail->range ?? '-' }}</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    {{-- LIC Info --}}
                                                    <div class="col-md-3">
                                                        <h6 class="font-weight-lighter text-primary">LIC Info</h6>
                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <span class="font-weight-bold">Policy No</span>
                                                            </div>
                                                            <div class="col-md-8 ">
                                                                <span>
                                                                    {{ $employee->licInfo->policy_no ?? '-' }}</span>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <span class="font-weight-bold">Policy Term</span>
                                                            </div>
                                                            <div class="col-md-8 ">
                                                                <span>
                                                                    {{ $employee->licInfo->policy_term ?? '-' }}</span>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <span class="font-weight-bold">LIC ID</span>
                                                            </div>
                                                            <div class="col-md-8 ">
                                                                <span>
                                                                    {{ $employee->licInfo->lic_id ?? '-' }}</span>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <span class="font-weight-bold">Annual Renewable Date</span>
                                                            </div>
                                                            <div class="col-md-8 ">
                                                                <span>
                                                                    {{ $employee->licInfo->annual_renewable_date ?? '-' }}</span>
                                                            </div>
                                                        </div>

                                                    </div>

                                                    {{-- PF Info --}}
                                                    <div class="col-md-3">
                                                        <h6 class="font-weight-lighter text-primary">PF Info</h6>
                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <span class="font-weight-bold">PF Applicable</span>
                                                            </div>
                                                            <div class="col-md-8 ">
                                                                <span>
                                                                    {{ isset($employee->pfInfo->pf_applicable) ? ($employee->pfInfo->pf_applicable == 1 ? 'Yes' : ($employee->pfInfo->pf_applicable === 0 ? 'No' : '-')) : '-' }}</span>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <span class="font-weight-bold">PF No</span>
                                                            </div>
                                                            <div class="col-md-8">
                                                                <span>
                                                                    {{ $employee->pfInfo->pf_no ?? '-' }}</span>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <span class="font-weight-bold">PF Joining Date</span>
                                                            </div>
                                                            <div class="col-md-8 ">
                                                                <span>
                                                                    {{ $employee->pfInfo->pf_joining_date ?? '-' }}</span>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <span class="font-weight-bold">PF Last Date</span>
                                                            </div>
                                                            <div class="col-md-8 ">
                                                                <span>
                                                                    {{ $employee->pfInfo->pf_last_date ?? '-' }}</span>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <span class="font-weight-bold">Pension Applicable</span>
                                                            </div>
                                                            <div class="col-md-8 ">
                                                                <span>
                                                                    {{ isset($employee->pfInfo->pension_applicable) ? ($employee->pfInfo->pension_applicable == 1 ? 'Yes' : ($employee->pfInfo->pension_applicable === 0 ? 'No' : '-')) : '-' }}</span>
                                                                </span>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <span class="font-weight-bold">Pension Joining Date
                                                                </span>
                                                            </div>
                                                            <div class="col-md-8">
                                                                <span>
                                                                    {{ $employee->pfInfo->pension_joining_date ?? '-' }}</span>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <span class="font-weight-bold">UAN
                                                                </span>
                                                            </div>
                                                            <div class="col-md-8">
                                                                <span>
                                                                    {{ $employee->pfInfo->uan_number ?? '-' }}</span>
                                                            </div>
                                                        </div>
                                                    </div>



                                                    {{-- ESI Info --}}
                                                    <div class="col-md-3">
                                                        <h6 class="font-weight-lighter text-primary">ESI Info</h6>
                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <span class="font-weight-bold">ESI Applicable</span>
                                                            </div>
                                                            <div class="col-md-8 ">
                                                                <span>
                                                                    {{ isset($employee->esiInfo->esi_applicable) ? ($employee->esiInfo->esi_applicable == 1 ? 'Yes' : ($employee->esiInfo->esi_applicable === 0 ? 'No' : '-')) : '-' }}</span>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <span class="font-weight-bold">ESI No</span>
                                                            </div>
                                                            <div class="col-md-8 ">
                                                                <span>
                                                                    {{ $employee->esiInfo->esi_no ?? '-' }}</span>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <span class="font-weight-bold">ESI Joining Date</span>
                                                            </div>
                                                            <div class="col-md-8 ">
                                                                <span>
                                                                    {{ $employee->esiInfo->esi_joining_date ?? '-' }}</span>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <span class="font-weight-bold">ESI Last Date</span>
                                                            </div>
                                                            <div class="col-md-8 ">
                                                                <span>
                                                                    {{ $employee->esiInfo->esi_last_date ?? '-' }}</span>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <span class="font-weight-bold">Local Office</span>
                                                            </div>
                                                            <div class="col-md-8 ">
                                                                <span>
                                                                    {{ $employee->esiInfo->localOffice->name ?? '-' }}</span>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <span class="font-weight-bold">ESI Dispensary
                                                                </span>
                                                            </div>
                                                            <div class="col-md-8 ">
                                                                <span>
                                                                    {{ $employee->esiInfo->esiDispensary->name ?? '-' }}</span>
                                                            </div>
                                                        </div>

                                                    </div>


                                                </div>


                                            </div>

                                            <hr class="my-1" />
                                            {{-- Family Members --}}
                                            <h5 class="font-weight-lighter mt-4 text-center text-primary">Family Member
                                                Details</h5>
                                            <table class="table table-striped table-bordered dt-responsive nowrap"
                                                style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                                <thead>
                                                    <tr>
                                                        <th>Name</th>
                                                        <th>Relation</th>
                                                        <th>Date of Birth</th>
                                                        <th>Residing</th>
                                                        <th>Remark</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($employee->familyMembers as $familyMember)
                                                        <tr>
                                                            <td>{{ $familyMember->name }}</td>
                                                            <td>{{ $familyMember->relation_with_emp }}</td>
                                                            <td>{{ $familyMember->dob }}</td>
                                                            <td>{{ $familyMember->is_residing ? 'Yes' : 'No' }}</td>
                                                            <td>{{ $familyMember->remark }}</td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>

                                            <hr class="my-1" />
                                            {{-- Nominess Members --}}
                                            <h5 class="font-weight-lighter mt-4 text-center text-primary">Nominee
                                                Details</h5>
                                            <table class="table table-striped table-bordered dt-responsive nowrap"
                                                style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                                <thead>
                                                    <tr>
                                                        <th>Family Member</th>
                                                        <th>Gratuity Sharing</th>
                                                        <th>Marital Status</th>
                                                        <th>Religion ID</th>
                                                        <th>Forhus Name</th>
                                                        <th>Guardian Name</th>
                                                        <th>Guardian Address</th>
                                                        <th>Guardian Relation with Emp</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($employee->nominee as $nominees)
                                                        <tr>
                                                            <td>{{ $nominees->familyMember->name }}</td>
                                                            <td>{{ $nominees->gratuity_sharing }}</td>
                                                            <td>{{ $nominees->marital_status }}</td>
                                                            <td>{{ $nominees->religion_id }}</td>
                                                            <td>{{ $nominees->faorhus_name }}</td>
                                                            <td>{{ $nominees->guardian_name }}</td>
                                                            <td>{{ $nominees->guardian_address }}</td>
                                                            <td>{{ $nominees->guardian_relation_with_emp }}</td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                            <div class="row">
                                                {{-- Banking Info --}}
                                                <div class="col-md-12">
                                                    {{-- <h6 class="font-weight-lighter text-primary">Banking Info</h6> --}}
                                                    <table></table>
                                                </div>



                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
        </div>
        </section>


    </div>
    </div>


    @include('links.js.select2.select2')
@endsection
