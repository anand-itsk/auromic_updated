@extends('layouts.app')
@section('title', 'Edit Customer')
<!-- DataTables CSS -->
@section('content')
    <!-- Add Select2 CSS -->
    @include('links.css.select2.select2')
    <div class="wrapper">
        <div class="container-fluid">
            <!-- Page-Title -->
            <div class="row">
                <div class="col-sm-12">
                    <div class="page-title-box">
                        <div class="btn-group float-right">
                            <ol class="breadcrumb hide-phone p-0 m-0">
                                <li class="breadcrumb-item"><a href="{{ route('home') }}">Auromics</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('master.customers.index') }}">Customer</a></li>
                                <li class="breadcrumb-item">Edit</li>
                            </ol>
                        </div>
                        <h4 class="page-title">Edit Customer</h4>
                    </div>
                </div>
            </div>
            <!-- end page title end breadcrumb -->

            <div class="row">
                <div class="col-12">
                    <div class="card m-b-30">
                        <div class="card-body">
                            <div class="m-b-30">
                                <form action="{{ route('master.customers.update', $customer->id) }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="d-flex justify-content-end mb-2">
                                        {{-- <h5 class="text-primary">Company Info</h5> --}}
                                        <button class="btn btn-secondary cancel_btn">
                                            <a href="{{ route('master.customers.index') }}" class="text-white">
                                                Cancel
                                            </a>
                                        </button>
                                    </div>
                                    <div class="form-group row">
                                        <label for="customer_code" class="col-sm-2 col-form-label mandatory">Customer
                                            Code</label>
                                        <div class="col-sm-4 mb-4">
                                            <input class="form-control" type="text" name="customer_code"
                                                id="customer_code" value="{{ $customer->customer_code }}">
                                            @error('customer_code')
                                                <span class="error" style="color: red;">{{ $message }}</span>
                                            @enderror
                                        </div>


                                        <label for="customer_name" class="col-sm-2 col-form-label mandatory">Customer
                                            Name</label>
                                        <div class="col-sm-4 mb-4">
                                            <input class="form-control" type="text" name="customer_name"
                                                id="customer_name" value="{{ $customer->customer_name }}">
                                            @error('customer_name')
                                                <span class="error" style="color: red;">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    {{-- Office Addresses --}}
                                    <div class="form-group row">
                                        @php
                                            $officeAddress = $customer->addresses->where('address_type_id', 2)->first();
                                        @endphp
                                        <label for="office_address" class="col-sm-2 col-form-label">Office Address</label>
                                        <div class="col-sm-4 mb-4">
                                            <textarea class="form-control" name="office_address" id="office_address" cols="10" rows="3">{{ $officeAddress->address ?? '' }}</textarea>
                                            @error('office_address')
                                                <span class="error" style="color: red;">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <label class="col-sm-2 col-form-label">Country</label>
                                        <div class="col-sm-4 mb-4">
                                            <select class="form-control select2" name="office_country_id"
                                                id="office_country_id">
                                                @foreach ($countries as $item)
                                                    <option value="{{ $item->id }}"
                                                        {{ $officeAddress && $officeAddress->country_id == $item->id ? 'selected' : '' }}>
                                                        {{ $item->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('office_country_id')
                                                <span class="error" style="color: red;">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <label class="col-sm-2 col-form-label">State</label>
                                        <div class="col-sm-4 mb-4">
                                            <select class="form-control select2 w-100" name="office_state_id"
                                                id="office_state_id" disabled>
                                            </select>
                                            @error('office_state_id')
                                                <span class="error" style="color: red;">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <label for="office_pincode" class="col-sm-2 col-form-label">Pincode</label>
                                        <div class="col-sm-4 mb-4">
                                            <input class="form-control" type="text" name="office_pincode"
                                                id="office_pincode" value="{{ $officeAddress->pincode ?? '' }}">
                                            @error('office_pincode')
                                                <span class="error" style="color: red;">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <label for="phone_no" class="col-sm-2 col-form-label">Phone No</label>
                                        <div class="col-sm-1 mb-4">
                                            <input class="form-control" type="std_code" name="std_code" id="std_code"
                                                value="{{ $customer->std_code }}">
                                            @error('std_code')
                                                <span class="error" style="color: red;">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="col-sm-3 mb-4">
                                            <input class="form-control" type="text" name="phone" id="phone"
                                                value="{{ $customer->phone }}">
                                            @error('phone')
                                                <span class="error" style="color: red;">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        {{-- </div> --}}
                                        {{--  Addresses --}}
                                        {{-- <div class="form-group row"> --}}
                                        @php
                                            $address = $customer->addresses->where('address_type_id', 3)->first();
                                        @endphp
                                        <label for="address" class="col-sm-2 col-form-label">Address</label>
                                        <div class="col-sm-4 mb-4">
                                            <textarea class="form-control" name="address" id="address" cols="10" rows="3">{{ $address->address ?? '' }}</textarea>
                                            @error('address')
                                                <span class="error" style="color: red;">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <label class="col-sm-2 col-form-label">Country</label>
                                        <div class="col-sm-4 mb-4">
                                            <select class="form-control select2" name="country_id" id="country_id">
                                                @foreach ($countries as $item)
                                                    <option value="{{ $item->id }}"
                                                        {{ $address && $address->country_id == $item->id ? 'selected' : '' }}>
                                                        {{ $item->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('country_id')
                                                <span class="error" style="color: red;">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <label class="col-sm-2 col-form-label">State</label>
                                        <div class="col-sm-4 mb-4">
                                            <select class="form-control select2" name="state_id" id="state_id">
                                           @foreach ($states as $item)
                                                    <option value="{{ $item->id }}"
                                                        {{ $address && $address->state_id == $item->id ? 'selected' : '' }}>
                                                        {{ $item->name }}</option>
                                                @endforeach
                                        </select>
                                            @error('state_id')
                                                <span class="error" style="color: red;">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <label for="pincode" class="col-sm-2 col-form-label">Pincode</label>
                                        <div class="col-sm-4 mb-4">
                                            <input class="form-control" type="text" name="pincode" id="pincode"
                                                value="{{ $address->pincode ?? '' }}">
                                            @error('pincode')
                                                <span class="error" style="color: red;">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <label for="phone_no" class="col-sm-2 col-form-label">Mobile</label>
                                        <div class="col-sm-4 mb-4">
                                            <input class="form-control" type="text" name="mobile" id="mobile"
                                                value="{{ $customer->mobile ?? '' }}">
                                            @error('mobile')
                                                <span class="error" style="color: red;">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    {{-- Other Details --}}

                                    <div class="form-group row">

                                        <label for="email" class="col-sm-2 col-form-label">Email Id</label>
                                        <div class="col-sm-4 mb-4">
                                            <input class="form-control" type="email" name="email" id="email"
                                                value="{{ $customer->email ?? '' }}">
                                            @error('email')
                                                <span class="error" style="color: red;">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <label for="website" class="col-sm-2 col-form-label">Website</label>
                                        <div class="col-sm-4 mb-4">
                                            <input class="form-control" type="text" name="website" id="website"
                                                value="{{ $customer->website ?? '' }}">
                                            @error('website')
                                                <span class="error" style="color: red;">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <label for="tin_no" class="col-sm-2 col-form-label">Pan No</label>
                                        <div class="col-sm-4 mb-4">
                                            <input class="form-control" type="text" name="pan_no" id="pan_no"
                                                value="{{ $customer->pan_no ?? '' }}">
                                            @error('pan_no')
                                                <span class="error" style="color: red;">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <label for="tin_date" class="col-sm-2 col-form-label">Date</label>
                                        <div class="col-sm-4 mb-4">
                                            <input class="form-control" type="date" name="pan_date" id="pan_date"
                                                value="{{ $customer->pan_date }}">
                                            @error('pan_date')
                                                <span class="error" style="color: red;">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <label for="gst_no" class="col-sm-2 col-form-label">GST No</label>
                                        <div class="col-sm-4 mb-4">
                                            <input class="form-control" type="text" name="gst_no" id="gst_no"
                                                value="{{ $customer->gst_no }}">
                                            @error('gst_no')
                                                <span class="error" style="color: red;">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <label for="cst_date" class="col-sm-2 col-form-label">Date</label>
                                        <div class="col-sm-4 mb-4">
                                            <input class="form-control" type="date" name="gst_date" id="gst_date"
                                                value="{{ $customer->gst_date }}">
                                            @error('gst_date')
                                                <span class="error" style="color: red;">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="d-flex justify-content-evenly">
                                            <button type="submit" class="btn btn-primary waves-effect waves-light">
                                                Submit
                                            </button>
                                            <a href="{{ route('master.customers.index') }}"
                                                class="btn btn-secondary waves-effect m-l-5">
                                                Cancel
                                            </a>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- DataTables JS -->
    @include('links.js.select2.select2')
    <script>
        var selectedOfficeStateId = "{{ $officeAddress->state_id ?? '' }}";
        var selectedStateId = "{{ $address->state_id ?? '' }}";
    </script>
@endsection
