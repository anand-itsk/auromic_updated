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
                                <li class="breadcrumb-item"><a href="{{ route('master.customers.index') }}">Customer</a>
                                </li>
                                <li class="breadcrumb-item">Create</li>
                            </ol>
                        </div>
                        <h4 class="page-title">Create Customer</h4>
                    </div>
                </div>
            </div>
            <!-- end page title end breadcrumb -->

            <div class="row">
                <div class="col-12">
                    <div class="card m-b-30">
                        <div class="card-body">
                            <div class="m-b-30">
                                <form action="{{ route('master.product_model.store') }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Raw Material</label>
                                        <div class="col-sm-4 mb-4">
                                            <select class="form-control select2" name="raw_material_id"
                                                id="raw_material_id">
                                                <option value="">Select Raw Material</option>
                                                @foreach ($raw_material as $item)
                                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('raw_material_id')
                                                <span class="error" style="color: red;">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <label class="col-sm-2 col-form-label mandatory">Product</label>
                                        <div class="col-sm-4 mb-4">
                                            <select class="form-control select2" name="product_id" id="product_id ">
                                                <option value="">Select Product</option>
                                                @foreach ($product as $item)
                                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('product_id')
                                                <span class="error" style="color: red;">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <label class="col-sm-2 col-form-label">Product Size</label>
                                        <div class="col-sm-4 mb-4">
                                            <select class="form-control select2" name="product_size_id"
                                                id="product_size_id">
                                                <option value="">Select Product Size</option>
                                                @foreach ($product_size as $item)
                                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('product_size_id')
                                                <span class="error" style="color: red;">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <label for="customer_code" class="col-sm-2 col-form-label mandatory">Model
                                            Code</label>
                                        <div class="col-sm-4 mb-4">
                                            <input class="form-control" type="text" name="model_code" id="model_code">
                                            @error('model_code')
                                                <span class="error" style="color: red;">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <label for="customer_code" class="col-sm-2 col-form-label mandatory">Model
                                            Name</label>
                                        <div class="col-sm-4 mb-4">
                                            <input class="form-control" type="text" name="model_name" id="model_name">
                                            @error('model_name')
                                                <span class="error" style="color: red;">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <label for="customer_code" class="col-sm-2 col-form-label">Req raw Material
                                            weight/item</label>
                                        <div class="col-sm-4 mb-4">
                                            <input class="form-control" type="text" name="raw_material_weight_item"
                                                id="model_code">
                                            @error('raw_material_weight_item')
                                                <span class="error" style="color: red;">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <label for="wages_product" class="col-sm-2 col-form-label">Wages for 1
                                            product</label>
                                        <div class="col-sm-4 mb-4">
                                            <input class="form-control" type="text" name="wages_product"
                                                id="wages_product" value="{{ old('wages_product', 0) }}">
                                            @error('wages_product')
                                                <span class="error" style="color: red;">{{ $message }}</span>
                                            @enderror
                                        </div>
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
