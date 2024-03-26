@extends('layouts.app')
<!-- DataTables CSS -->
@section('content')
    <!-- Add Select2 CSS -->
    @include('links.css.select2.select2')
    @include('links.css.wizard-form.wizard-form')

    <div class="wrapper">
        <div class="container-fluid">
            <!-- Page-Title -->
            <div class="row">
                <div class="col-sm-12">
                    <div class="page-title-box pb-0">
                        <div class="btn-group float-right">
                            <ol class="breadcrumb hide-phone p-0 m-0">
                                <li class="breadcrumb-item"><a href="{{ route('home') }}">Auromics</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('master.employees.index') }}">Employees</a>
                                </li>
                                <li class="breadcrumb-item">Create</li>
                            </ol>
                        </div>
                        <h4 class="page-title">Create Employee</h4>
                    </div>
                </div>
            </div>
            <!-- end page title end breadcrumb -->
            <section class="pt-5">
                <div class="row d-flex justify-content-center">
                    <div class="col-md-12">

                        <div class="wizard">
                            <div class="wizard-inner">
                                <div class="connecting-line"></div>
                                <ul class="nav nav-tabs" role="tablist">
                                    <li role="presentation" class="active">
                                        <a href="#step1" data-toggle="tab" aria-controls="step1" role="tab"
                                            aria-expanded="true"><span class="round-tab">1 </span> <i>Personal</i></a>
                                    </li>
                                    <li role="presentation" class="disabled">
                                        <a href="#step2" data-toggle="tab" aria-controls="step2" role="tab"
                                            aria-expanded="false"><span class="round-tab">2</span> <i>Finance</i></a>
                                    </li>
                                    <li role="presentation" class="disabled">
                                        <a href="#step3" data-toggle="tab" aria-controls="step3" role="tab"><span
                                                class="round-tab">3</span> <i>Family</i></a>
                                    </li>
                                    <li role="presentation" class="disabled">
                                        <a href="#step4" data-toggle="tab" aria-controls="step4" role="tab"><span
                                                class="round-tab">4</span> <i>Nominee

                                                
                                                </i></a>
                                    </li>
                                </ul>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="d-flex justify-content-end align-items-center mb-2">
                                        <a class="mr-2" href="{{ route('master.employees.show', $employee->id) }}"><button
                                                class="btn btn-warning py-1">
                                                Preview</button></a>
                                        <a class="mr-2" href="{{ route('master.employees.index') }}"><button
                                                class="btn btn-danger py-1">
                                                Close</button></a>

                                    </div>
                                    <div class="card m-b-30">
                                        <div class="card-body pt-0">
                                            <div class="">
                                                {{-- <form role="form" action="index.html" class="login-box"> --}}
                                                <div class="tab-content" id="main_form">
                                                    <div class="tab-pane active" role="tabpanel" id="step1">
                                                        <h4 class="text-center m-0">Personal</h4>
                                                        <form role="form"
                                                            action="{{ route('master.employees.store.personal', $employee->id) }}"
                                                            method="post" class="login-box" enctype="multipart/form-data">
                                                            <input type="hidden" name="_token"
                                                                value="{{ csrf_token() }}">
                                                            {{-- Company Info --}}
                                                            <div class="row m-2">
                                                                <h5 class="text-primary w-100">Company Info</h5>
                                                                <div class="col-md-10">
                                                                    <div class="form-group row w-100 mb-0">

                                                                        <label for="company_type_id"
                                                                            class="col-sm-2 col-form-label">Company
                                                                            Type</label>
                                                                        <div class="col-sm-4 mb-4">

                                                                            <select class="form-control select2 w-100"
                                                                                name="company_type_id" id="company_type_id">
                                                                                <option value="">Select</option>
                                                                                @foreach ($company_types as $item)
                                                                                    <option value="{{ $item->id }}"
                                                                                        {{ $employee->company && $employee->company->company_type_id == $item->id ? 'selected' : '' }}>
                                                                                        {{ $item->name }}</option>
                                                                                @endforeach
                                                                            </select>
                                                                            @error('company_type_id')
                                                                                <span class="error"
                                                                                    style="color: red;">{{ $message }}</span>
                                                                            @enderror
                                                                        </div>


                                                                        <label for="company_type_id"
                                                                            class="col-sm-2 col-form-label">Companies</label>
                                                                        <div class="col-sm-4 mb-4">

                                                                            <select class="form-control select2 w-100"
                                                                                name="company_id" id="company_id" disabled>
                                                                            </select>
                                                                            @error('company_id')
                                                                                <span class="error"
                                                                                    style="color: red;">{{ $message }}</span>
                                                                            @enderror
                                                                        </div>

                                                                        <label for="employee_code"
                                                                            class="col-sm-2 col-form-label mandatory">Employee
                                                                            Code</label>
                                                                        <div class="col-sm-4">

                                                                            <input class="form-control" type="text"
                                                                                value="{{ $employee->employee_code }}" readonly
                                                                                name="employee_code" id="employee_code">
                                                                            <span class="error-message text-danger"></span>
                                                                        </div>



                                                                        <label for="employee_name"
                                                                            class="col-sm-2 col-form-label mandatory">Employee
                                                                            Name</label>
                                                                        <div class="col-sm-4">

                                                                            <input class="form-control" type="text"
                                                                                value="{{ $employee->employee_name }}"
                                                                                name="employee_name" id="employee_name">
                                                                            @error('employee_name')
                                                                                <span class="error"
                                                                                    style="color: red;">{{ $message }}</span>
                                                                            @enderror
                                                                        </div>

                                                                    </div>

                                                                </div>
                                                                <div class="col-md-2">
                                                                    <div class="container">
                                                                        <div class="picture-container">
                                                                            <div class="picture">
                                                                                @if ($photoPath)
                                                                                    <img src="{{ asset('storage/' . $photoPath) }}"
                                                                                        class="picture-src"
                                                                                        id="wizardPicturePreview"
                                                                                        title="">
                                                                                @else
                                                                                    <img src=""
                                                                                        class="picture-src"
                                                                                        id="wizardPicturePreview"
                                                                                        title=""
                                                                                        style="display: none;">
                                                                                @endif
                                                                                <input type="file"
                                                                                    name="employee_profile"
                                                                                    id="wizard-picture" class="">
                                                                            </div>
                                                                            <h6 class="m-0">Choose Picture</h6>
                                                                            <p style="color: red;" class="mb-0">500x500
                                                                            </p>
                                                                        </div>
                                                                    </div>
                                                                    {{-- <label for="employee_profile"
                                                                        class="col-sm-2 col-form-label mandatory text-nowrap">Profile</label>
                                                                    <div class="col-sm-2 mb-4">

                                                                        <input class="" type="file"
                                                                            name="employee_profile" id="employee_profile">
                                                                        @error('employee_profile')
                                                                            <span class="error"
                                                                                style="color: red;">{{ $message }}</span>
                                                                        @enderror
                                                                    </div> --}}
                                                                </div>
                                                            </div>
                                                            <hr />
                                                            {{-- Permanent Address --}}
                                                            <div class="row mx-2 mt-0">
                                                                @php
                                                                    $officeAddress = $employee->addresses->where('address_type_id', 3)->first();
                                                                @endphp
                                                                {{-- {{ dd($officeAddress->district_id) }} --}}
                                                                <h5 class="text-primary w-100 mt-0">Permanent Address</h5>

                                                                <div class="form-group row w-100">
                                                                    <label for="office_address"
                                                                        class="col-sm-2 col-form-label">Address</label>
                                                                    <div class="col-sm-4 mb-4">
                                                                        <textarea class="form-control" name="office_address" id="office_address" cols="10" rows="3"> {{ $officeAddress->address ?? '' }}</textarea>

                                                                        @error('office_address')
                                                                            <span class="error"
                                                                                style="color: red;">{{ $message }}</span>
                                                                        @enderror
                                                                    </div>

                                                                    <label for="office_area"
                                                                        class="col-sm-2 col-form-label">Village/Area</label>
                                                                    <div class="col-sm-4 mb-4">
                                                                        <input class="form-control" type="text"
                                                                            value="{{ $officeAddress->village_area ?? '' }}"
                                                                            name="office_area" id="office_area">

                                                                        @error('office_area')
                                                                            <span class="error"
                                                                                style="color: red;">{{ $message }}</span>
                                                                        @enderror
                                                                    </div>

                                                                    <label class="col-sm-2 col-form-label">Country</label>
                                                                    <div class="col-sm-4 mb-4">
                                                                        <select class="form-control select2"
                                                                            name="office_country_id"
                                                                            id="office_country_id">
                                                                            @foreach ($countries as $item)
                                                                                <option value="{{ $item->id }}"
                                                                                    {{ $officeAddress && $officeAddress->country_id == $item->id ? 'selected' : '' }}>
                                                                                    {{ $item->name }}</option>
                                                                            @endforeach
                                                                        </select>
                                                                        @error('office_country_id')
                                                                            <span class="error"
                                                                                style="color: red;">{{ $message }}</span>
                                                                        @enderror
                                                                    </div>

                                                                    <label class="col-sm-2 col-form-label">State</label>
                                                                    <div class="col-sm-4 mb-4">
                                                                        <select class="form-control select2 w-100"
                                                                            name="office_state_id" id="office_state_id"
                                                                            disabled>
                                                                        </select>
                                                                        @error('office_state_id')
                                                                            <span class="error"
                                                                                style="color: red;">{{ $message }}</span>
                                                                        @enderror
                                                                    </div>

                                                                    <label class="col-sm-2 col-form-label">District</label>
                                                                    <div class="col-sm-4">
                                                                        <select class="form-control select2 w-100"
                                                                            name="office_district_id"
                                                                            id="office_district_id" disabled>
                                                                        </select>
                                                                        @error('office_district_id')
                                                                            <span class="error"
                                                                                style="color: red;">{{ $message }}</span>
                                                                        @enderror
                                                                    </div>

                                                                    <label for="office_pincode"
                                                                        class="col-sm-2 col-form-label">Pincode</label>
                                                                    <div class="col-sm-4">
                                                                        <input class="form-control" type="text"
                                                                            value="{{ $officeAddress->pincode ?? '' }}"
                                                                            name="office_pincode" id="office_pincode">
                                                                        @error('office_pincode')
                                                                            <span class="error"
                                                                                style="color: red;">{{ $message }}</span>
                                                                        @enderror
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <hr />
                                                            {{-- Correspondence Address --}}
                                                            @php
                                                                $corrs_address = $employee->addresses->where('address_type_id', 4)->first();
                                                            @endphp
                                                            <div class="row m-2">
                                                                <div class="d-flex" style="flex-wrap: inherit">
                                                                    <h5 class="text-primary w-100 mt-0">Correspondence
                                                                        Address
                                                                    </h5>

                                                                    <div class="">
                                                                        <input class=""
                                                                            name="same_as_permanent_address"
                                                                            type="checkbox" id="sameAsPermanentAddress">
                                                                        <label class=""
                                                                            for="sameAsPermanentAddress">
                                                                            Same as Permanent Address
                                                                        </label>
                                                                    </div>
                                                                </div>

                                                                <div class="form-group row w-100 corrs_address">
                                                                    <label for="corrs_address"
                                                                        class="col-sm-2 col-form-label">Address</label>
                                                                    <div class="col-sm-4 mb-4">
                                                                        <textarea class="form-control" name="corrs_address" id="corrs_address" cols="10" rows="3"> {{ $corrs_address->address ?? '' }} </textarea>

                                                                        @error('corrs_address')
                                                                            <span class="error"
                                                                                style="color: red;">{{ $message }}</span>
                                                                        @enderror
                                                                    </div>

                                                                    <label for="corrs_area"
                                                                        class="col-sm-2 col-form-label">Village/Area</label>
                                                                    <div class="col-sm-4 mb-4">
                                                                        <input class="form-control" type="text"
                                                                            name="corrs_area" id="corrs_area">

                                                                        @error('corrs_area')
                                                                            <span class="error"
                                                                                style="color: red;">{{ $message }}</span>
                                                                        @enderror
                                                                    </div>

                                                                    <label class="col-sm-2 col-form-label">Country</label>
                                                                    <div class="col-sm-4 mb-4">
                                                                        <select class="form-control select2"
                                                                            name="corrs_country_id" id="corrs_country_id">
                                                                            @foreach ($countries as $item)
                                                                                <option value="{{ $item->id }}">
                                                                                    {{ $item->name }}
                                                                                </option>
                                                                            @endforeach
                                                                        </select>
                                                                        @error('corrs_country_id')
                                                                            <span class="error"
                                                                                style="color: red;">{{ $message }}</span>
                                                                        @enderror
                                                                    </div>

                                                                    <label class="col-sm-2 col-form-label">State</label>
                                                                    <div class="col-sm-4 mb-4">
                                                                        <select class="form-control select2 w-100"
                                                                            name="corrs_state_id" id="corrs_state_id"
                                                                            disabled>
                                                                        </select>
                                                                        @error('corrs_state_id')
                                                                            <span class="error"
                                                                                style="color: red;">{{ $message }}</span>
                                                                        @enderror
                                                                    </div>

                                                                    <label class="col-sm-2 col-form-label">District</label>
                                                                    <div class="col-sm-4">
                                                                        <select class="form-control select2 w-100"
                                                                            name="corrs_district_id"
                                                                            id="corrs_district_id" disabled>
                                                                        </select>
                                                                        @error('corrs_district_id')
                                                                            <span class="error"
                                                                                style="color: red;">{{ $message }}</span>
                                                                        @enderror
                                                                    </div>

                                                                    <label for="corrs_pincode"
                                                                        class="col-sm-2 col-form-label">Pincode</label>
                                                                    <div class="col-sm-4">
                                                                        <input class="form-control" type="text"
                                                                            name="corrs_pincode" id="corrs_pincode">
                                                                        @error('corrs_pincode')
                                                                            <span class="error"
                                                                                style="color: red;">{{ $message }}</span>
                                                                        @enderror
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <hr />
                                                            {{-- Identity  Proof --}}
                                                            <div class="row m-2">
                                                                <h5 class="text-primary w-100 mt-0">Identity Proof
                                                                </h5>
                                                                <div class="form-group row">

                                                                    <label for="voter_id_number"
                                                                        class="col-sm-2 col-form-label">Voter ID
                                                                        Number</label>
                                                                    <div class="col-sm-4 mb-4">
                                                                        <input class="form-control" type="text"
                                                                            value="{{ $employee->identityProof->voter_id_number ?? '' }}"
                                                                            name="voter_id_number" id="voter_id_number">
                                                                        @error('voter_id_number')
                                                                            <span class="error"
                                                                                style="color: red;">{{ $message }}</span>
                                                                        @enderror
                                                                    </div>

                                                                    <label for="driving_license_number"
                                                                        class="col-sm-2 col-form-label">Driving License
                                                                        Number</label>
                                                                    <div class="col-sm-4 mb-4">
                                                                        <input class="form-control" type="text"
                                                                            value="{{ $employee->identityProof->driving_license_number ?? '' }}"
                                                                            name="driving_license_number"
                                                                            id="driving_license_number">
                                                                        @error('driving_license_number')
                                                                            <span class="error"
                                                                                style="color: red;">{{ $message }}</span>
                                                                        @enderror
                                                                    </div>
                                                                    <label for="pan_number"
                                                                        class="col-sm-2 col-form-label">Pan Number</label>
                                                                    <div class="col-sm-4 mb-4">
                                                                        <input class="form-control" type="text"
                                                                            value="{{ $employee->identityProof->pan_number ?? '' }}"
                                                                            name="pan_number" id="pan_number">
                                                                        @error('pan_number')
                                                                            <span class="error"
                                                                                style="color: red;">{{ $message }}</span>
                                                                        @enderror
                                                                    </div>
                                                                    <label for="passport_number"
                                                                        class="col-sm-2 col-form-label">Passport
                                                                        Number</label>
                                                                    <div class="col-sm-4">
                                                                        <input class="form-control" type="text"
                                                                            value="{{ $employee->identityProof->passport_number ?? '' }}"
                                                                            name="passport_number" id="passport_number">
                                                                        @error('passport_number')
                                                                            <span class="error"
                                                                                style="color: red;">{{ $message }}</span>
                                                                        @enderror
                                                                    </div>
                                                                    <label for="identity_mark"
                                                                        class="col-sm-2 col-form-label">Identity
                                                                        Mark</label>
                                                                    <div class="col-sm-4">
                                                                        <input class="form-control" type="text"
                                                                            value="{{ $employee->identityProof->identity_mark ?? '' }}"
                                                                            name="identity_mark" id="identity_mark">
                                                                        @error('identity_mark')
                                                                            <span class="error"
                                                                                style="color: red;">{{ $message }}</span>
                                                                        @enderror
                                                                    </div>
                                                                    <label for="aadhar_number"
                                                                        class="col-sm-2 col-form-label">Aadhar Number</label>
                                                                    <div class="col-sm-4">
                                                                        <input class="form-control" type="text"
                                                                            value="{{ $employee->identityProof->aadhar_number ?? '' }}"
                                                                            name="aadhar_number" id="aadhar_number">
                                                                        @error('aadhar_number')
                                                                            <span class="error"
                                                                                style="color: red;">{{ $message }}</span>
                                                                        @enderror
                                                                    </div>
                                                                    
                                                                    <label for="aadhar_name" class="col-sm-2 mt-4 col-form-label">Aadhar Name</label>
<div class="col-sm-4 mt-4"> <!-- Added mt-4 class here -->
    <input class="form-control" type="text" value="{{ $employee->identityProof->aadhar_name ?? '' }}" name="aadhar_name" id="aadhar_name">
    @error('aadhar_name')
        <span class="error" style="color: red;">{{ $message }}</span>
    @enderror
</div>
                                                                </div>
                                                            </div>

                                                            <hr />

                                                            {{-- Other  Details --}}
                                                            <div class="row m-2">
                                                                <h5 class="text-primary w-100 mt-0">Other Details
                                                                </h5>
                                                                <div class="form-group row">
                                                                    <label for="dob"
                                                                        class="col-sm-2 col-form-label mandatory">Date of
                                                                        Birth</label>
                                                                    <div class="col-sm-4 mb-4">
                                                                        <input class="form-control" type="date"
                                                                            name="dob" id="dob"
                                                                            value="{{ $employee->dob }}">
                                                                        @error('dob')
                                                                            <span class="error"
                                                                                style="color: red;">{{ $message }}</span>
                                                                        @enderror
                                                                    </div>

                                                                    <label for="gender"
                                                                        class="col-sm-2 col-form-label">Gender</label>
                                                                    <div class="col-sm-4 mb-4">
                                                                        <select class="form-control" name="gender"
                                                                            id="gender">
                                                                            <option value=""
                                                                                {{ $employee->gender == null ? 'selected' : '' }}>
                                                                                Select</option>
                                                                            <option value="Male"
                                                                                {{ $employee->gender == 'Male' ? 'selected' : '' }}>
                                                                                Male</option>
                                                                            <option value="Female"
                                                                                {{ $employee->gender == 'Female' ? 'selected' : '' }}>
                                                                                Female</option>
                                                                            <option value="Other"
                                                                                {{ $employee->gender == 'Other' ? 'selected' : '' }}>
                                                                                Others</option>
                                                                        </select>

                                                                        @error('gender')
                                                                            <span class="error"
                                                                                style="color: red;">{{ $message }}</span>
                                                                        @enderror
                                                                    </div>

                                                                    <label for="blood_group"
                                                                        class="col-sm-2 col-form-label">Blood Group</label>
                                                                    <div class="col-sm-4 mb-4">
                                                                        <select class="form-control" name="blood_group"
                                                                            id="blood_group">
                                                                            <option value="">Select</option>
                                                                            <option value="A+"
                                                                                {{ $employee->blood_group == 'A+' ? 'selected' : '' }}>
                                                                                A+</option>
                                                                            <option value="A-"
                                                                                {{ $employee->blood_group == 'A-' ? 'selected' : '' }}>
                                                                                A-</option>
                                                                            <option value="B+"
                                                                                {{ $employee->blood_group == 'B+' ? 'selected' : '' }}>
                                                                                B+</option>
                                                                            <option value="B-"
                                                                                {{ $employee->blood_group == 'B-' ? 'selected' : '' }}>
                                                                                B-</option>
                                                                            <option value="AB+"
                                                                                {{ $employee->blood_group == 'AB+' ? 'selected' : '' }}>
                                                                                AB+</option>
                                                                            <option value="AB-"
                                                                                {{ $employee->blood_group == 'AB-' ? 'selected' : '' }}>
                                                                                AB-</option>
                                                                            <option value="O+"
                                                                                {{ $employee->blood_group == 'O+' ? 'selected' : '' }}>
                                                                                O+</option>
                                                                            <option value="O-"
                                                                                {{ $employee->blood_group == 'O-' ? 'selected' : '' }}>
                                                                                O-</option>
                                                                        </select>

                                                                        @error('blood_group')
                                                                            <span class="error"
                                                                                style="color: red;">{{ $message }}</span>
                                                                        @enderror
                                                                    </div>

                                                                    <label for="email"
                                                                        class="col-sm-2 col-form-label">Email Id</label>
                                                                    <div class="col-sm-4 mb-4">
                                                                        <input class="form-control" type="email"
                                                                            value="{{ $employee->email }}" name="email"
                                                                            id="email">
                                                                        @error('email')
                                                                            <span class="error"
                                                                                style="color: red;">{{ $message }}</span>
                                                                        @enderror
                                                                    </div>

                                                                    <label for="mobile"
                                                                        class="col-sm-2 col-form-label">Mobile</label>
                                                                    <div class="col-sm-4 mb-4">
                                                                        <input class="form-control" type="text"
                                                                            value="{{ $employee->mobile }}"
                                                                            name="mobile" id="mobile">
                                                                        @error('mobile')
                                                                            <span class="error"
                                                                                style="color: red;">{{ $message }}</span>
                                                                        @enderror
                                                                    </div>

                                                                    <label for="faorhus_name"
                                                                        class="col-sm-2 col-form-label">Father's/Husband
                                                                        Name</label>
                                                                    <div class="col-sm-4 mb-4">
                                                                        <input class="form-control" type="text"
                                                                            value="{{ $employee->faorhus_name }}"
                                                                            name="faorhus_name" id="faorhus_name">
                                                                        @error('faorhus_name')
                                                                            <span class="error"
                                                                                style="color: red;">{{ $message }}</span>
                                                                        @enderror
                                                                    </div>

                                                                    <label for="marital_status"
                                                                        class="col-sm-2 col-form-label">Marital
                                                                        Status</label>
                                                                    <div class="col-sm-4 mb-4">
                                                                        <select name="marital_status" id="marital_status"
                                                                            class="form-control">
                                                                            <option value=""
                                                                                {{ $employee->marital_status == null ? 'selected' : '' }}>
                                                                                Select</option>
                                                                            <option value="single"
                                                                                {{ $employee->marital_status == 'single' ? 'selected' : '' }}>
                                                                                Single</option>
                                                                            <option value="married"
                                                                                {{ $employee->marital_status == 'married' ? 'selected' : '' }}>
                                                                                Married</option>
                                                                            <option value="divorced"
                                                                                {{ $employee->marital_status == 'sivorced' ? 'selected' : '' }}>
                                                                                Divorced</option>
                                                                            <option value="widowed"
                                                                                {{ $employee->marital_status == 'widowed' ? 'selected' : '' }}>
                                                                                Widowed</option>
                                                                            <option value="separated"
                                                                                {{ $employee->marital_status == 'separated' ? 'selected' : '' }}>
                                                                                Separated</option>
                                                                            <option value="other"
                                                                                {{ $employee->marital_status == 'other' ? 'selected' : '' }}>
                                                                                Other</option>
                                                                        </select>
                                                                        @error('marital_status')
                                                                            <span class="error"
                                                                                style="color: red;">{{ $message }}</span>
                                                                        @enderror
                                                                    </div>

                                                                    <label for="phone_no"
                                                                        class="col-sm-2 col-form-label">Phone No</label>
                                                                    <div class="col-sm-1 mb-4">
                                                                        <input class="form-control" type="std_code"
                                                                            value="{{ $employee->std_code }}"
                                                                            name="std_code" id="std_code">
                                                                        @error('std_code')
                                                                            <span class="error"
                                                                                style="color: red;">{{ $message }}</span>
                                                                        @enderror
                                                                    </div>
                                                                    <div class="col-sm-3 mb-4">
                                                                        <input class="form-control" type="text"
                                                                            value="{{ $employee->phone }}" name="phone"
                                                                            id="phone">
                                                                        @error('phone')
                                                                            <span class="error"
                                                                                style="color: red;">{{ $message }}</span>
                                                                        @enderror
                                                                    </div>

                                                                    <label class="col-sm-2 col-form-label">Religion</label>
                                                                    <div class="col-sm-4 mb-4">
                                                                        <select class="form-control select2"
                                                                            name="religion_id" id="religion_id">
                                                                            @foreach ($religions as $item)
                                                                                <option value="{{ $item->id }}"
                                                                                    {{ $employee && $employee->religion_id == $item->id ? 'selected' : '' }}>
                                                                                    {{ $item->name }}</option>
                                                                            @endforeach
                                                                        </select>
                                                                        @error('religion_id')
                                                                            <span class="error"
                                                                                style="color: red;">{{ $message }}</span>
                                                                        @enderror
                                                                    </div>

                                                                    <label class="col-sm-2 col-form-label">Caste</label>
                                                                    <div class="col-sm-4 mb-4">
                                                                        <select class="form-control select2"
                                                                            name="caste_id" id="caste_id">
                                                                            @foreach ($castes as $item)
                                                                                <option value="{{ $item->id }}"
                                                                                    {{ $employee && $employee->caste_id == $item->id ? 'selected' : '' }}>
                                                                                    {{ $item->name }}</option>
                                                                            @endforeach
                                                                        </select>
                                                                        @error('caste_id')
                                                                            <span class="error"
                                                                                style="color: red;">{{ $message }}</span>
                                                                        @enderror
                                                                    </div>

                                                                    <label
                                                                        class="col-sm-2 col-form-label">Nationality</label>
                                                                    <div class="col-sm-4 mb-4">
                                                                        <select class="form-control select2"
                                                                            name="nationality_id" id="nationality_id">
                                                                            @foreach ($nationality as $item)
                                                                                <option value="{{ $item->id }}"
                                                                                    {{ $employee && $employee->nationality_id == $item->id ? 'selected' : '' }}>
                                                                                    {{ $item->name }}</option>
                                                                            @endforeach
                                                                        </select>
                                                                        @error('nationality_id')
                                                                            <span class="error"
                                                                                style="color: red;">{{ $message }}</span>
                                                                        @enderror
                                                                    </div>

                                                                    <label for="joining_date"
                                                                        class="col-sm-2 col-form-label mandatory">Joining
                                                                        Date</label>
                                                                    <div class="col-sm-4 mb-4">
                                                                        <input class="form-control" type="date"
                                                                            value="{{ $employee->joining_date }}"
                                                                            name="joining_date" id="joining_date">
                                                                        @error('joining_date')
                                                                            <span class="error"
                                                                                style="color: red;">{{ $message }}</span>
                                                                        @enderror
                                                                    </div>
                                                                   
                                                                    <label for="prob_period"
                                                                        class="col-sm-2 col-form-label">Prob Period in
                                                                        Month</label>
                                                                    <div class="col-sm-4 mb-4">
                                                                        <input class="form-control" type="text"
                                                                            value="{{ $employee->prob_period }}"
                                                                            name="prob_period" id="prob_period">
                                                                        @error('prob_period')
                                                                            <span class="error"
                                                                                style="color: red;">{{ $message }}</span>
                                                                        @enderror
                                                                    </div>

                                                                    <label for="confirm_date"
                                                                        class="col-sm-2 col-form-label">Confirm
                                                                        Date</label>
                                                                    <div class="col-sm-4 mb-4">
                                                                        <input class="form-control" type="date"
                                                                            value="{{ $employee->confirm_date }}"
                                                                            name="confirm_date" id="confirm_date">
                                                                        @error('confirm_date')
                                                                            <span class="error"
                                                                                style="color: red;">{{ $message }}</span>
                                                                        @enderror
                                                                    </div>

                                                                    <label for="resigning_date"
                                                                        class="col-sm-2 col-form-label">Resigning Date
                                                                        Date</label>
                                                                    <div class="col-sm-4">
                                                                        <input class="form-control" type="date"
                                                                            value="{{ $employee->resigning_date }}"
                                                                            name="resigning_date" id="resigning_date">
                                                                        @error('resigning_date')
                                                                            <span class="error"
                                                                                style="color: red;">{{ $message }}</span>
                                                                        @enderror
                                                                    </div>

                                                                    <label class="col-sm-2 col-form-label">Select with
                                                                        reason</label>
                                                                    <div class="col-sm-4">
                                                                        <select class="form-control select2"
                                                                            name="resigning_reason_id"
                                                                            id="resigning_reason_id">
                                                                            @foreach ($resigning_reason as $item)
                                                                                <option value="{{ $item->id }}">
                                                                                    {{ $item->name }}</option>
                                                                            @endforeach
                                                                        </select>
                                                                        @error('resigning_reason_id')
                                                                            <span class="error"
                                                                                style="color: red;">{{ $message }}</span>
                                                                        @enderror
                                                                    </div>

                                                                </div>
                                                            </div>

                                                            <ul class="list-inline pull-right">
                                                                <li><button type="button"
                                                                        class="default-btn next-step mt-0 text-white"
                                                                        data-url="{{ route('master.employees.store.personal', $employee->id) }}">Continue
                                                                        to next step</button></li>
                                                            </ul>
                                                        </form>
                                                    </div>
                                                    @include('pages.master.employee.create_finance')
                                                    @include('pages.master.employee.create_family')
                                                    @include('pages.master.employee.create_nominee')
                                                    <div class="clearfix"></div>
                                                </div>

                                                {{-- </form> --}}

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
    <script>
        // ------------step-wizard-------------
        $(document).ready(function() {
            employeeId = "{{ $employee->id }}";

            familyMemberTable(employeeId);
            nomineeTable(employeeId);
            $('.nav-tabs > li a[title]').tooltip();

            //Wizard
            $('a[data-toggle="tab"]').on('shown.bs.tab', function(e) {

                var target = $(e.target);

                if (target.parent().hasClass('disabled')) {
                    return false;
                }
            });

            // $(".next-step").click(function(e) {

            //     var active = $('.wizard .nav-tabs li.active');
            //     active.next().removeClass('disabled');
            //     nextTab(active);

            // });
            $(".prev-step").click(function(e) {

                var active = $('.wizard .nav-tabs li.active');
                prevTab(active);

            });


            var selectedCompanyId = "{{ $employee->company_id ?? '' }}";

            // Process initial state based on the current value of #company_type_id without waiting for a change event
            let selectedCompanyTypeId = $('#company_type_id').val();
            processCompanyTypeSelection(selectedCompanyTypeId, selectedCompanyId);

            // Setup change event handler for subsequent changes
            $('#company_type_id').on('change', function() {
                let companyTypeId = $(this).val();
                processCompanyTypeSelection(companyTypeId, selectedCompanyId);
            });

            $("#wizard-picture").change(function() {
                readURL(this);
            });
        });

        function processCompanyTypeSelection(companyTypeId, selectedCompanyId) {
            let isDisabled = companyTypeId != 1; // Enable #company_id if company type is not 1
            $('#company_id').prop('disabled', !isDisabled);

            if (companyTypeId != 1) { // Load companies only if company type is not 1
                loadCompanies(companyTypeId, 'company_id', selectedCompanyId);
            }
        }

        function loadCompanies(companyTypeId, companyIdElementId, selectedCompanyId = null) {
            $.ajax({
                url: '/get-companies/' + companyTypeId,
                type: 'GET',
                success: function(companies) {
                    let $companyIdElement = $('#' + companyIdElementId);
                    $companyIdElement.empty().append('<option value="">Select Company</option>');

                    companies.forEach(function(company) {
                        let isSelected = selectedCompanyId == company.id ? 'selected' : '';
                        let authorisedPersonName = company.authorised_person ? company.authorised_person
                            .name : 'N/A';
                        $companyIdElement.append(
                            `<option value="${company.id}" ${isSelected}>${company.company_name} (${authorisedPersonName})</option>`
                        );
                    });

                    $companyIdElement.trigger('change');
                }
            });
        }

        function nextTab(elem) {
            $(elem).next().find('a[data-toggle="tab"]').click();
        }

        function prevTab(elem) {
            $(elem).prev().find('a[data-toggle="tab"]').click();
        }


        $('.nav-tabs').on('click', 'li', function() {
            $('.nav-tabs li.active').removeClass('active');
            $(this).addClass('active');
        });


        // Fetch Datas's
        var selectedOfficeStateId = "{{ $officeAddress->state_id ?? '' }}";
        var selectedOfficeDistrictId = "{{ $officeAddress->district_id ?? '' }}";
        var selectedStateId = "{{ $address->state_id ?? '' }}";
        var selectedDistrictId = "{{ $address->district_id ?? '' }}";
        var selectedCompanyId = "";
        let selectedCompanyTypeId = $('#company_type_id').val();
        if (selectedCompanyTypeId != 1) {
            $('#company_id').prop('disabled', false).trigger('change');
            loadCompanies(selectedCompanyTypeId, 'company_id', selectedCompanyId);
        }

        $('#company_type_id').on('change', function() {
            loadCompanies($(this).val(), 'company_id');
        });

        function loadCompanies(companyTypeId, companyId, selectedCompanyId = null) {
            $.ajax({
                url: '/get-companies/' + companyTypeId,
                type: 'GET',
                success: function(datas) {
                    $('#' + companyId).empty().append('<option value="">Select Company</option>');
                    datas.forEach(function(data) {

                        let isSelected = selectedCompanyId == data.id ? 'selected' : '';
                        let authorisedPersonName = data.authorised_person ? data.authorised_person
                            .name :
                            'N/A';
                        $('#' + companyId).append('<option value="' + data.id + '" ' + isSelected +
                            '>' + data.company_name + ' (' + authorisedPersonName + ')</option>'
                        );
                    });
                    $('#' + companyId).trigger('change');
                }
            });
        }

        document.getElementById('sameAsPermanentAddress').addEventListener('change', function() {
            var elements = document.getElementsByClassName("corrs_address");
            if (this.checked) {
                // Hide elements
                for (var i = 0; i < elements.length; i++) {
                    elements[i].style.display = 'none';
                }
            } else {
                // Show elements by reverting display property to default
                for (var i = 0; i < elements.length; i++) {
                    elements[i].style.display = ''; // This will revert to the default display style
                }
            }
        });

        $(".next-step").click(function(e) {
            e.preventDefault();

            var activeTab = $('.wizard .nav-tabs li.active');
            var form = $(this).closest('form');
            var formData = new FormData(form[0]);
            var url = form.attr('action'); // Set form action attribute to the appropriate Laravel route.
            console.log(url);
            // AJAX submission to Laravel
            $.ajax({
                type: 'POST',
                url: url,
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    // If save is successful, move to the next tab
                    activeTab.next().removeClass('disabled');
                    nextTab(activeTab);
                },
                error: function(response) {
                    if (response.status === 422) { // Unprocessable Entity (Validation Error)
                        let errors = response.responseJSON.errors;
                        let firstInvalidInput = null;

                        for (let key in errors) {
                            if (errors.hasOwnProperty(key)) {
                                let inputField = form.find('[name="' + key + '"]');
                                let errorMessage = errors[key][
                                    0
                                ]; // First error message for this field

                                // Append error message and add invalid input styling
                                inputField.addClass('is-invalid').after(
                                    '<span class="error-message text-danger">' + errorMessage +
                                    '</span>');

                                // Focus the first invalid input
                                if (!firstInvalidInput) {
                                    firstInvalidInput = inputField;
                                }
                            }
                        }

                        if (firstInvalidInput) {
                            firstInvalidInput.focus();
                        }
                    } else {
                        // Handle other types of errors
                        console.log('An error occurred:', response.statusText);
                    }
                }
            });
        });

        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('#wizardPicturePreview').attr('src', e.target.result).fadeIn('slow');
                }
                reader.readAsDataURL(input.files[0]);
            }
        }

        $('a[href="#step4"]').click(function(e) {
            e.preventDefault(); // Prevent the default anchor action
            console.log("fetch_famail");
            if ($(this).parent().hasClass('disabled')) {
                // The element is disabled, perform AJAX call
                $.ajax({
                    url: `/master/employees/nominee/family/${employeeId}`,
                    type: 'GET',
                    dataType: 'json', // expected data format from server
                    success: function(data) {
                        console.log(data.emp_family);
                        var familyMemberDropdown = $('#family_memeber_id');
                        familyMemberDropdown.empty(); // Clear existing options
                        $.each(data.emp_family, function(key, value) {
                            familyMemberDropdown.append($('<option></option>').attr('value',
                                value.id).text(value.name));
                        });
                    },
                    error: function(xhr, status, error) {
                        // Handle error
                        console.log('Error:', error);
                    }
                });
            }
        });
    </script>
@endsection
