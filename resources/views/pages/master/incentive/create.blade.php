@extends('layouts.app')
@section('title', 'Create Incentives')
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
                                <li class="breadcrumb-item"><a href="{{ route('master.incentives.index') }}">Incentive</a>
                                </li>
                                <li class="breadcrumb-item">Create</li>
                            </ol>
                        </div>
                        <h4 class="page-title">Create Incentive</h4>
                    </div>
                </div>
            </div>
            <!-- end page title end breadcrumb -->

            <div class="row">
                <div class="col-12">
                    <div class="card m-b-30">
                        <div class="card-body">
                            <div class="m-b-30">
                                <form action="{{ route('master.incentives.store') }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group row">
<label class="col-sm-2 col-form-label">Finishing Product Model</label>
<div class="col-sm-4 mb-4">
    <select class="form-control select2" name="finishing_product_models_id" id="finishing_product_models_id">
        <option value="">Select Finishing Model</option>
        @foreach ($finishingProduct as $finishingProducts)
            <option value="{{ $finishingProducts->id }}">{{ $finishingProducts->model_code}}/{{ $finishingProducts->model_name}}</option>
        @endforeach
    </select>
    @error('finishing_product_models_id')
        <span class="error" style="color: red;">{{ $message }}</span>
    @enderror
</div>

<label class="col-sm-2 col-form-label">Model Name</label>
<div class="col-sm-4 mb-4">
    <input class="form-control" type="text" name="model_name" id="model_name" readonly>
    @error('model_name')
        <span class="error" style="color: red;">{{ $message }}</span>
    @enderror
</div>

<label for="product_name" class="col-sm-2 col-form-label">Product Name</label>
<div class="col-sm-4 mb-4">
    <input class="form-control" type="text" name="product_name" id="product_name" readonly>
    @error('product_name')
        <span class="error" style="color: red;">{{ $message }}</span>
    @enderror
</div>

<label for="product_size" class="col-sm-2 col-form-label">Product Size</label>
<div class="col-sm-4 mb-4">
    <input class="form-control" type="text" name="product_size" id="product_size" readonly>
    @error('product_size')
        <span class="error" style="color: red;">{{ $message }}</span>
    @enderror
</div>

<label for="wages_one_product" class="col-sm-2 col-form-label">Wages of One Product</label>
<div class="col-sm-4 mb-4">
    <input class="form-control" type="text" name="wages_one_product" id="wages_one_product" readonly>
    @error('wages_one_product')
        <span class="error" style="color: red;">{{ $message }}</span>
    @enderror
</div>

                                        <label for="wages_product" class="col-sm-2 col-form-label">Duration Period</label>
                                        <div class="col-sm-4 mb-4">
                                            <input class="form-control" type="text" name="duration_period"
                                                id="duration_period">
                                            @error('duration_period')
                                                <span class="error" style="color: red;">{{ $message }}</span>
                                            @enderror
                                        </div>

                                         <label for="wages_product" class="col-sm-2 col-form-label">Amount</label>
                                        <div class="col-sm-4 mb-4">
                                            <input class="form-control" type="text" name="amount"
                                                id="amount">
                                            @error('amount')
                                                <span class="error" style="color: red;">{{ $message }}</span>
                                            @enderror
                                        </div>




                                    </div>



                                    <div class="form-group">
                                        <div class="d-flex justify-content-evenly">
                                            <button type="submit" class="btn btn-primary waves-effect waves-light">
                                                Submit
                                            </button>
                                            <a href="{{ route('master.incentives.create') }}"
                                                class="btn btn-warning waves-effect waves-light">
                                                Reset
                                            </a>
                                            <a href="{{ route('master.incentives.index') }}"
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
    <script>
    $(document).ready(function() {
        $('#finishing_product_models_id').change(function() {
            var modelId = $(this).val();
            if(modelId) {
                $.ajax({
                    url: '/master/incentives/get-finishing-product-details/' + modelId,
                    type: 'GET',
                    dataType: 'json',
                    success:function(data) {
                        $('#model_name').val(data.model_name);
                        $('#product_name').val(data.product_name);
                        $('#product_size').val(data.product_size);
                        $('#wages_one_product').val(data.wages_one_product);
                    }
                });
            }
        });
    });
</script>


    @include('links.js.select2.select2')
@endsection
