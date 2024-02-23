@extends('layouts.app')
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
                                <li class="breadcrumb-item"><a
                                        href="{{ route('job_allocation.delivery_challan.index') }}">Job Allocation</a>
                                </li>
                                <li class="breadcrumb-item">Create</li>
                            </ol>
                        </div>
                        <h4 class="page-title">Create Delivery Challan</h4>
                    </div>
                </div>
            </div>
            <!-- end page title end breadcrumb -->

            <div class="row">
                <div class="col-12">
                    <div class="card m-b-30">
                        <div class="card-body">
                            <div class="m-b-30">
                                <form action="{{ route('job_allocation.delivery_challan.store') }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group row">
                                        <label for="customer_code" class="col-sm-2 col-form-label mandatory">
                                            Company Name
                                        </label>
                                        <div class="col-sm-4 mb-4">

                                            <select class="form-control select2" name="company_id" id="company_id">
                                                @foreach ($authorised_people as $item)
                                                    <option value="{{ $item->id }}">
                                                        {{ $item->company->company_name }}/{{ $item->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('company_id')
                                                <span class="error" style="color: red;">{{ $message }}</span>
                                            @enderror
                                        </div>


                                        <label for="customer_name" class="col-sm-2 col-form-label mandatory">DC
                                            Number</label>
                                        <div class="col-sm-4 mb-4">
                                            <input class="form-control" type="text" name="dc_number" id="dc_number">
                                            @error('dc_number')
                                                <span class="error" style="color: red;">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="customer_code" class="col-sm-2 col-form-label mandatory">Order
                                            ID</label>
                                        <div class="col-sm-4 mb-4">
                                            <select class="form-control select2" name="order_id" id="order_id">
                                                @foreach ($order_details as $item)
                                                    <option value="{{ $item->id }}">
                                                        {{ $item->order_no }}</option>
                                                @endforeach
                                            </select>
                                            {{-- <input class="form-control" type="text" name="order_id" id="order_id"> --}}
                                            @error('order_id')
                                                <span class="error" style="color: red;">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>



                                    <div class="form-group">
                                        <div class="d-flex justify-content-evenly">
                                            <button type="submit" class="btn btn-primary waves-effect waves-light">
                                                Submit
                                            </button>
                                            <a href="{{ route('master.customers.create') }}"
                                                class="btn btn-warning waves-effect waves-light">
                                                Reset
                                            </a>
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


    @include('links.js.select2.select2')
@endsection
