@extends('layouts.app')
@section('title', 'Edit Incentives')
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
                                <li class="breadcrumb-item">Edit</li>
                            </ol>
                        </div>
                        <h4 class="page-title">Edit Incentive</h4>
                    </div>
                </div>
            </div>
            <!-- end page title end breadcrumb -->

            <div class="row">
                <div class="col-12">
                    <div class="card m-b-30">
                        <div class="card-body">
                            <div class="m-b-30">
                                <form action="{{ route('master.incentives.update', $incentive->id) }}" method="POST">
                                    @csrf
                                    <div class="form-group row">
<label class="col-sm-2 col-form-label">Finishing Product Model</label>
<div class="col-sm-4 mb-4">
    <select class="form-control" name="finishing_product_models_id" id="finishing_product_models_id">
        <option value="">Select Finishing Model</option>
        @foreach ($finishingProduct as $finishingProduct)
            <option value="{{ $finishingProduct->id }}" @if ($finishingProduct->id == $incentive->finishing_product_models_id) selected @endif>{{ $finishingProduct->model_code }}</option>
        @endforeach
    </select>
    @error('finishing_product_models_id')
        <span class="error" style="color: red;">{{ $message }}</span>
    @enderror
</div>


<label class="col-sm-2 col-form-label">Model Name</label>
<div class="col-sm-4 mb-4">
    <input class="form-control" type="text" name="model_name" id="model_name" readonly value="{{$finishingProduct->model_name}}">
    @error('model_name')
        <span class="error" style="color: red;">{{ $message }}</span>
    @enderror
</div>

<label for="product_name" class="col-sm-2 col-form-label">Product Name</label>
<div class="col-sm-4 mb-4">
    <input class="form-control" type="text" name="product_name" id="product_name" readonly value="{{$finishingProduct->product->name}}">
    @error('product_name')
        <span class="error" style="color: red;">{{ $message }}</span>
    @enderror
</div>

<label for="product_size" class="col-sm-2 col-form-label">Product Size</label>
<div class="col-sm-4 mb-4">
    <input class="form-control" type="text" name="product_size" id="product_size" readonly value="{{$finishingProduct->productSize->name}}">
    @error('product_size')
        <span class="error" style="color: red;">{{ $message }}</span>
    @enderror
</div>

<label for="wages_one_product" class="col-sm-2 col-form-label">Wages of One Product</label>
<div class="col-sm-4 mb-4">
    <input class="form-control" type="text" name="wages_one_product" id="wages_one_product" readonly value="{{$finishingProduct->wages_one_product}}">
    @error('wages_one_product')
        <span class="error" style="color: red;">{{ $message }}</span>
    @enderror
</div>

                                        <label for="wages_product" class="col-sm-2 col-form-label">Duration Period</label>
                                        <div class="col-sm-4 mb-4">
                                            <input class="form-control" type="text" name="duration_period"
                                                id="duration_period" value="{{ $incentive->duration_period }}">
                                            @error('duration_period')
                                                <span class="error" style="color: red;">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        
                                         <label for="wages_product" class="col-sm-2 col-form-label">Amount</label>
                                        <div class="col-sm-4 mb-4">
                                            <input class="form-control" type="text" name="amount"
                                                id="amount" value="{{ $incentive->amount}}">
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
        document.addEventListener("DOMContentLoaded", function() {
            var productId = document.getElementById('product').value;
            var productModels = document.getElementById('product_model').getElementsByTagName('option');

            for (var i = 0; i < productModels.length; i++) {
                if (productModels[i].getAttribute('data-product-id') === productId || productId === '') {
                    productModels[i].style.display = '';
                } else {
                    productModels[i].style.display = 'none';
                }
            }

            // Set the selected product model based on the saved value
            var selectedProductModelId = '{{ $incentive->product_model_id }}';
            var productModelOptions = document.getElementById('product_model').getElementsByTagName('option');
            for (var j = 0; j < productModelOptions.length; j++) {
                if (productModelOptions[j].value === selectedProductModelId) {
                    productModelOptions[j].selected = true;
                    break;
                }
            }
        });

        document.getElementById('product').addEventListener('change', function() {
            var productId = this.value;
            var productModels = document.getElementById('product_model').getElementsByTagName('option');

            for (var i = 0; i < productModels.length; i++) {
                if (productModels[i].getAttribute('data-product-id') === productId || productId === '') {
                    productModels[i].style.display = '';
                } else {
                    productModels[i].style.display = 'none';
                }
            }
        });
    </script>




    @include('links.js.select2.select2')
@endsection
