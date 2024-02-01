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
                    <div class="page-title-box">
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
                                                class="round-tab">4</span> <i>Nominee</i></a>
                                    </li>
                                </ul>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="card m-b-30">
                                        <div class="card-body">
                                            <div class="m-b-30">
                                                <form role="form" action="index.html" class="login-box">
                                                    <div class="tab-content" id="main_form">
                                                        <div class="tab-pane active" role="tabpanel" id="step1">
                                                            <h4 class="text-center pb-4">Personal</h4>
                                                            {{-- Company Info --}}
                                                            <div class="row m-2">
                                                                <h5 class="text-primary">Company Info</h5>
                                                                <div class="form-group row">
                                                                    <label for="company_type_id"
                                                                        class="col-sm-2 col-form-label">Company Type</label>
                                                                    <div class="col-sm-4 mb-4">

                                                                        <select class="form-control select2"
                                                                            name="company_type_id" id="company_type_id">
                                                                            <option value="">Select</option>
                                                                            @foreach ($company_types as $item)
                                                                                <option value="{{ $item->id }}">
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
                                                                    <div class="col-sm-4 mb-4">

                                                                        <input class="form-control" type="text"
                                                                            name="employee_code" id="employee_code">
                                                                        @error('employee_code')
                                                                            <span class="error"
                                                                                style="color: red;">{{ $message }}</span>
                                                                        @enderror
                                                                    </div>



                                                                    <label for="employee_name"
                                                                        class="col-sm-2 col-form-label mandatory">Employee
                                                                        Code</label>
                                                                    <div class="col-sm-4 mb-4">

                                                                        <input class="form-control" type="text"
                                                                            name="employee_name" id="employee_name">
                                                                        @error('employee_name')
                                                                            <span class="error"
                                                                                style="color: red;">{{ $message }}</span>
                                                                        @enderror
                                                                    </div>

                                                                </div>
                                                            </div>

                                                            {{-- Permanent Address --}}
                                                            <div class="row m-2">
                                                                <h5 class="text-primary">Permanent Address</h5>

                                                                <div class="form-group row">
                                                                    <label for="office_address"
                                                                        class="col-sm-2 col-form-label">Office
                                                                        Address</label>
                                                                    <div class="col-sm-10 mb-4">
                                                                        <textarea class="form-control" name="office_address" id="office_address" cols="10" rows="3"></textarea>

                                                                        @error('office_address')
                                                                            <span class="error"
                                                                                style="color: red;">{{ $message }}</span>
                                                                        @enderror
                                                                    </div>

                                                                    <label for="office_area"
                                                                        class="col-sm-2 col-form-label">Village/Area</label>
                                                                    <div class="col-sm-4 mb-4">
                                                                        <input class="form-control" type="text"
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
                                                                                <option value="{{ $item->id }}">
                                                                                    {{ $item->name }}
                                                                                </option>
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
                                                                    <div class="col-sm-4 mb-4">
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
                                                                    <div class="col-sm-4 mb-4">
                                                                        <input class="form-control" type="text"
                                                                            name="office_pincode" id="office_pincode">
                                                                        @error('office_pincode')
                                                                            <span class="error"
                                                                                style="color: red;">{{ $message }}</span>
                                                                        @enderror
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            {{-- Correspondence Address --}}
                                                            <div class="row m-2">
                                                                <h5 class="text-primary">Correspondence Address</h5>
                                                                <div class="form-check">
                                                                    <input class="form-check-input" type="checkbox"
                                                                        id="sameAsPermanentAddress">
                                                                    <label class="form-check-label"
                                                                        for="sameAsPermanentAddress">
                                                                        Same as Permanent Address
                                                                    </label>
                                                                </div>
                                                                <div class="form-group row">
                                                                    <label for="address"
                                                                        class="col-sm-2 col-form-label">Address</label>
                                                                    <div class="col-sm-10 mb-4">
                                                                        <textarea class="form-control" name="address" id="address" cols="10" rows="3"></textarea>

                                                                        @error('address')
                                                                            <span class="error"
                                                                                style="color: red;">{{ $message }}</span>
                                                                        @enderror
                                                                    </div>

                                                                    <label for="area"
                                                                        class="col-sm-2 col-form-label">Village/Area</label>
                                                                    <div class="col-sm-4 mb-4">
                                                                        <input class="form-control" type="text"
                                                                            name="area" id="area">

                                                                        @error('area')
                                                                            <span class="error"
                                                                                style="color: red;">{{ $message }}</span>
                                                                        @enderror
                                                                    </div>

                                                                    <label class="col-sm-2 col-form-label">Country</label>
                                                                    <div class="col-sm-4 mb-4">
                                                                        <select class="form-control select2"
                                                                            name="country_id" id="country_id">
                                                                            @foreach ($countries as $item)
                                                                                <option value="{{ $item->id }}">
                                                                                    {{ $item->name }}
                                                                                </option>
                                                                            @endforeach
                                                                        </select>
                                                                        @error('country_id')
                                                                            <span class="error"
                                                                                style="color: red;">{{ $message }}</span>
                                                                        @enderror
                                                                    </div>

                                                                    <label class="col-sm-2 col-form-label">State</label>
                                                                    <div class="col-sm-4 mb-4">
                                                                        <select class="form-control select2 w-100"
                                                                            name="state_id" id="state_id" disabled>
                                                                        </select>
                                                                        @error('state_id')
                                                                            <span class="error"
                                                                                style="color: red;">{{ $message }}</span>
                                                                        @enderror
                                                                    </div>

                                                                    <label class="col-sm-2 col-form-label">District</label>
                                                                    <div class="col-sm-4 mb-4">
                                                                        <select class="form-control select2 w-100"
                                                                            name="district_id" id="district_id" disabled>
                                                                        </select>
                                                                        @error('district_id')
                                                                            <span class="error"
                                                                                style="color: red;">{{ $message }}</span>
                                                                        @enderror
                                                                    </div>

                                                                    <label for="pincode"
                                                                        class="col-sm-2 col-form-label">Pincode</label>
                                                                    <div class="col-sm-4 mb-4">
                                                                        <input class="form-control" type="text"
                                                                            name="pincode" id="pincode">
                                                                        @error('pincode')
                                                                            <span class="error"
                                                                                style="color: red;">{{ $message }}</span>
                                                                        @enderror
                                                                    </div>
                                                                </div>
                                                            </div>



                                                            <ul class="list-inline pull-right">
                                                                <li><button type="button"
                                                                        class="default-btn next-step">Continue
                                                                        to next
                                                                        step</button></li>
                                                            </ul>
                                                        </div>
                                                        <div class="tab-pane" role="tabpanel" id="step2">
                                                            <h4 class="text-center">Step 2</h4>
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label>Address 1 *</label>
                                                                        <input class="form-control" type="text"
                                                                            name="name" placeholder="">
                                                                    </div>
                                                                </div>

                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label>City / Town *</label>
                                                                        <input class="form-control" type="text"
                                                                            name="name" placeholder="">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label>Country *</label>
                                                                        <select name="country" class="form-control"
                                                                            id="country">
                                                                            <option value="NG" selected="selected">
                                                                                Nigeria</option>
                                                                            <option value="NU">Niue
                                                                            </option>
                                                                            <option value="NF">Norfolk
                                                                                Island
                                                                            </option>
                                                                            <option value="KP">North
                                                                                Korea</option>
                                                                            <option value="MP">Northern
                                                                                Mariana
                                                                                Islands</option>
                                                                            <option value="NO">Norway
                                                                            </option>
                                                                        </select>
                                                                    </div>
                                                                </div>



                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label>Registration No.</label>
                                                                        <input class="form-control" type="text"
                                                                            name="name" placeholder="">
                                                                    </div>
                                                                </div>
                                                            </div>


                                                            <ul class="list-inline pull-right">
                                                                <li><button type="button"
                                                                        class="default-btn prev-step">Back</button>
                                                                </li>
                                                                <li><button type="button"
                                                                        class="default-btn next-step skip-btn">Skip</button>
                                                                </li>
                                                                <li><button type="button"
                                                                        class="default-btn next-step">Continue</button>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                        <div class="tab-pane" role="tabpanel" id="step3">
                                                            <h4 class="text-center">Step 3</h4>
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label>Account Name *</label>
                                                                        <input class="form-control" type="text"
                                                                            name="name" placeholder="">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label>Demo</label>
                                                                        <input class="form-control" type="text"
                                                                            name="name" placeholder="">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label>Inout</label>
                                                                        <input class="form-control" type="text"
                                                                            name="name" placeholder="">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label>Information</label>
                                                                        <div class="custom-file">
                                                                            <input type="file"
                                                                                class="custom-file-input" id="customFile">
                                                                            <label class="custom-file-label"
                                                                                for="customFile">Select
                                                                                file</label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label>Number *</label>
                                                                        <input class="form-control" type="text"
                                                                            name="name" placeholder="">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label>Input Number</label>
                                                                        <input class="form-control" type="text"
                                                                            name="name" placeholder="">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <ul class="list-inline pull-right">
                                                                <li><button type="button"
                                                                        class="default-btn prev-step">Back</button>
                                                                </li>
                                                                <li><button type="button"
                                                                        class="default-btn next-step skip-btn">Skip</button>
                                                                </li>
                                                                <li><button type="button"
                                                                        class="default-btn next-step">Continue</button>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                        <div class="tab-pane" role="tabpanel" id="step4">
                                                            <h4 class="text-center">Step 4</h4>
                                                            <div class="all-info-container">
                                                                <div class="list-content">
                                                                    <a href="#listone" data-toggle="collapse"
                                                                        aria-expanded="false"
                                                                        aria-controls="listone">Collapse 1
                                                                        <i class="fa fa-chevron-down"></i></a>
                                                                    <div class="collapse" id="listone">
                                                                        <div class="list-box">
                                                                            <div class="row">

                                                                                <div class="col-md-6">
                                                                                    <div class="form-group">
                                                                                        <label>First and
                                                                                            Last Name
                                                                                            *</label>
                                                                                        <input class="form-control"
                                                                                            type="text" name="name"
                                                                                            placeholder=""
                                                                                            disabled="disabled">
                                                                                    </div>
                                                                                </div>

                                                                                <div class="col-md-6">
                                                                                    <div class="form-group">
                                                                                        <label>Phone Number
                                                                                            *</label>
                                                                                        <input class="form-control"
                                                                                            type="text" name="name"
                                                                                            placeholder=""
                                                                                            disabled="disabled">
                                                                                    </div>
                                                                                </div>

                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="list-content">
                                                                    <a href="#listtwo" data-toggle="collapse"
                                                                        aria-expanded="false"
                                                                        aria-controls="listtwo">Collapse 2
                                                                        <i class="fa fa-chevron-down"></i></a>
                                                                    <div class="collapse" id="listtwo">
                                                                        <div class="list-box">
                                                                            <div class="row">

                                                                                <div class="col-md-6">
                                                                                    <div class="form-group">
                                                                                        <label>Address 1
                                                                                            *</label>
                                                                                        <input class="form-control"
                                                                                            type="text" name="name"
                                                                                            placeholder=""
                                                                                            disabled="disabled">
                                                                                    </div>
                                                                                </div>

                                                                                <div class="col-md-6">
                                                                                    <div class="form-group">
                                                                                        <label>City / Town
                                                                                            *</label>
                                                                                        <input class="form-control"
                                                                                            type="text" name="name"
                                                                                            placeholder=""
                                                                                            disabled="disabled">
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-md-6">
                                                                                    <div class="form-group">
                                                                                        <label>Country
                                                                                            *</label>
                                                                                        <select name="country2"
                                                                                            class="form-control"
                                                                                            id="country2"
                                                                                            disabled="disabled">
                                                                                            <option value="NG"
                                                                                                selected="selected">
                                                                                                Nigeria
                                                                                            </option>
                                                                                            <option value="NU">
                                                                                                Niue
                                                                                            </option>
                                                                                            <option value="NF">
                                                                                                Norfolk
                                                                                                Island
                                                                                            </option>
                                                                                            <option value="KP">
                                                                                                North Korea
                                                                                            </option>
                                                                                            <option value="MP">
                                                                                                Northern
                                                                                                Mariana
                                                                                                Islands
                                                                                            </option>
                                                                                            <option value="NO">
                                                                                                Norway
                                                                                            </option>
                                                                                        </select>
                                                                                    </div>
                                                                                </div>



                                                                                <div class="col-md-6">
                                                                                    <div class="form-group">
                                                                                        <label>Legal
                                                                                            Form</label>
                                                                                        <select name="legalform2"
                                                                                            class="form-control"
                                                                                            id="legalform2"
                                                                                            disabled="disabled">
                                                                                            <option value=""
                                                                                                selected="selected">
                                                                                                -Select an
                                                                                                Answer-
                                                                                            </option>
                                                                                            <option value="AG">
                                                                                                Limited
                                                                                                liability
                                                                                                company
                                                                                            </option>
                                                                                            <option value="GmbH">
                                                                                                Public
                                                                                                Company
                                                                                            </option>
                                                                                            <option value="GbR">
                                                                                                No
                                                                                                minimum
                                                                                                capital,
                                                                                                unlimited
                                                                                                liability of
                                                                                                partners,
                                                                                                non-busines
                                                                                            </option>
                                                                                        </select>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-md-6">
                                                                                    <div class="form-group">
                                                                                        <label>Business
                                                                                            Registration
                                                                                            No.</label>
                                                                                        <input class="form-control"
                                                                                            type="text" name="name"
                                                                                            placeholder=""
                                                                                            disabled="disabled">
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-md-6">
                                                                                    <div class="form-group">
                                                                                        <label>Registered</label>
                                                                                        <select name="vat2"
                                                                                            class="form-control"
                                                                                            id="vat2"
                                                                                            disabled="disabled">
                                                                                            <option value=""
                                                                                                selected="selected">
                                                                                                -Select an
                                                                                                Answer-
                                                                                            </option>
                                                                                            <option value="yes">
                                                                                                Yes
                                                                                            </option>
                                                                                            <option value="no">
                                                                                                No
                                                                                            </option>
                                                                                        </select>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-md-6">
                                                                                    <div class="form-group">
                                                                                        <label>Seller</label>
                                                                                        <input class="form-control"
                                                                                            type="text" name="name"
                                                                                            placeholder=""
                                                                                            disabled="disabled">
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-md-12">
                                                                                    <div class="form-group">
                                                                                        <label>Company Name
                                                                                            *</label>
                                                                                        <input class="form-control"
                                                                                            type="password" name="name"
                                                                                            placeholder=""
                                                                                            disabled="disabled">
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="list-content">
                                                                    <a href="#listthree" data-toggle="collapse"
                                                                        aria-expanded="false"
                                                                        aria-controls="listthree">Collapse
                                                                        3 <i class="fa fa-chevron-down"></i></a>
                                                                    <div class="collapse" id="listthree">
                                                                        <div class="list-box">
                                                                            <div class="row">

                                                                                <div class="col-md-6">
                                                                                    <div class="form-group">
                                                                                        <label>Name
                                                                                            *</label>
                                                                                        <input class="form-control"
                                                                                            type="text" name="name"
                                                                                            placeholder="">
                                                                                    </div>
                                                                                </div>


                                                                                <div class="col-md-6">
                                                                                    <div class="form-group">
                                                                                        <label>Number
                                                                                            *</label>
                                                                                        <input class="form-control"
                                                                                            type="text" name="name"
                                                                                            placeholder="">
                                                                                    </div>
                                                                                </div>

                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <ul class="list-inline pull-right">
                                                                <li><button type="button"
                                                                        class="default-btn prev-step">Back</button>
                                                                </li>
                                                                <li><button type="button"
                                                                        class="default-btn next-step">Finish</button>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                        <div class="clearfix"></div>
                                                    </div>

                                                </form>

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
            $('.nav-tabs > li a[title]').tooltip();

            //Wizard
            $('a[data-toggle="tab"]').on('shown.bs.tab', function(e) {

                var target = $(e.target);

                if (target.parent().hasClass('disabled')) {
                    return false;
                }
            });

            $(".next-step").click(function(e) {

                var active = $('.wizard .nav-tabs li.active');
                active.next().removeClass('disabled');
                nextTab(active);

            });
            $(".prev-step").click(function(e) {

                var active = $('.wizard .nav-tabs li.active');
                prevTab(active);

            });
        });

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
        var selectedCompanyId = "";
        var selectedStateId = "{{ $address->state_id ?? '' }}";
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
                            '>' + data.company_name + ' (' + authorisedPersonName + ')</option>');
                    });
                    $('#' + companyId).trigger('change');
                }
            });
        }

        document.getElementById('sameAsPermanentAddress').addEventListener('change', function() {
            if (this.checked) {
                // Copy values from Permanent Address fields to Correspondence Address fields
                document.getElementById('address').value = document.getElementById('office_address').value;
                document.getElementById('area').value = document.getElementById('office_area').value;
                document.getElementById('country_id').value = document.getElementById('office_country_id').value;
                document.getElementById('state_id').value = document.getElementById('office_state_id').value;
                document.getElementById('district_id').value = document.getElementById('office_district_id').value;
                document.getElementById('pincode').value = document.getElementById('office_pincode').value;
            } else {
                // Clear the Correspondence Address fields
                document.getElementById('address').value = '';
                document.getElementById('area').value = '';
                document.getElementById('country_id').value = '';
                document.getElementById('state_id').value = '';
                document.getElementById('district_id').value = '';
                document.getElementById('pincode').value = '';
            }
        });
    </script>
@endsection
