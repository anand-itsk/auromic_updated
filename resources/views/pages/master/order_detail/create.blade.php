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
                            <li class="breadcrumb-item"><a href="{{ route('master.order_detail.index') }}">Order Detail</a>
                            </li>
                            <li class="breadcrumb-item">Create</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Create Order Detail</h4>
                </div>
            </div>
        </div>
        <!-- end page title end breadcrumb -->

        <div class="row">
            <div class="col-12">
                <div class="card m-b-30">
                    <div class="card-body">
                        <div class="m-b-30">
                            <form action="{{ route('master.order_detail.store') }}" method="POST">
                                @csrf
                                <div class="form-group row">
                                   <label for="customer_code" class="col-sm-2 col-form-label mandatory">Oder No</label>
                                    <div class="col-sm-4 mb-4">
                                        <input class="form-control" type="text" name="order_no" id="model_code">
                                        @error('model_code')
                                        <span class="error" style="color: red;">{{ $message }}</span>
                                        @enderror
                                    </div>

                                     <label class="col-sm-2 col-form-label mandatory">Order Date</label>
                                    <div class="col-sm-4 mb-4">
                                        <input type="date" name="order_date" id="">
                                        @error('product_id')
                                        <span class="error" style="color: red;">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <label class="col-sm-2 col-form-label">Customer</label>
                                    <div class="col-sm-4 mb-4">
                                        <select class="form-control select2" name="customer_id"
                                            id="customer_id">
                                            <option value="">Select Customer</option>
                                            @foreach ($customer as $item)
                                            <option value="{{ $item->id }}">{{ $item->customer_name }}</option>
                                            @endforeach
                                        </select>
                                        @error('customer_id')
                                        <span class="error" style="color: red;">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <label class="col-sm-2 col-form-label">Product</label>
                                    <div class="col-sm-4 mb-4">
                                        <select class="form-control select2" name="product_id"
                                            id="product_id">
                                            <option value="">Select Product</option>
                                            @foreach ($product as $item)
                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('product_id')
                                        <span class="error" style="color: red;">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <label class="col-sm-2 col-form-label">Model</label>
                                    <div class="col-sm-4 mb-4">
                                        <select class="form-control select2" name="model_id"
                                            id="product_id">
                                            <option value="">Select Product</option>
                                           
                                        </select>
                                        @error('product_id')
                                        <span class="error" style="color: red;">{{ $message }}</span>
                                        @enderror
                                    </div>



                                <div class="form-group">
                                    <div class="d-flex justify-content-evenly">
                                        <button type="submit" class="btn btn-primary waves-effect waves-light">
                                            Submit
                                        </button>
                                        <a href="{{ route('master.product_model.create') }}"
                                            class="btn btn-warning waves-effect waves-light">
                                            Reset
                                        </a>
                                        <a href="{{ route('master.product_model.index') }}"
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