@extends('layouts.app')
@section('title', 'Create Product Model')
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
                                <li class="breadcrumb-item"><a href="{{ route('master.product_model.index') }}">Product Model</a>
                                </li>
                                <li class="breadcrumb-item">Create</li>
                            </ol>
                        </div>
                        <h4 class="page-title">Create Product Model</h4>
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
                                        <label class="col-sm-2 col-form-label mandatory">Raw Material
                                             <a class="shortcut_master"
                                                href="{{ route('product-models.raw_materials.create') }}" target="_blank">+</a>
                                        </label>
                                        <div class="col-sm-4 mb-4">
                                            <select class="form-control select2" name="raw_material_id"
                                                id="raw_material_id" required>
                                                <option value="">Select Raw Material</option>
                                                @foreach ($raw_material as $item)
                                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('raw_material_id')
                                                <span class="error" style="color: red;">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <label class="col-sm-2 col-form-label mandatory">Product
                                            <a class="shortcut_master"
                                                href="{{ route('product-models.products.create') }}" target="_blank">+</a>
                                        </label>
                                        <div class="col-sm-4 mb-4">
                                            <select class="form-control select2" name="product_id" id="product_id"required>
                                                <option value="">Select Product</option>
                                                @foreach ($product as $item)
                                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('product_id')
                                                <span class="error" style="color: red;">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <label class="col-sm-2 col-form-label mandatory">Product Size
                                            <a class="shortcut_master"
                                                href="{{ route('product-models.product_sizes.create') }}" target="_blank">+</a>
                                        </label>
                                        <div class="col-sm-4 mb-4">
                                            <select class="form-control select2" name="product_size_id"
                                                id="product_size_id"required>
                                                <option value="">Select Product Size</option>
                                                @foreach ($product_size as $item)
                                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('product_size_id')
                                                <span class="error" style="color: red;">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <label for="model_code" class="col-sm-2 col-form-label mandatory">Model Code</label>
<div class="col-sm-4 mb-4">
    <input class="form-control" type="text" name="model_code" id="model_code"required>
    <div id="model_codeError" style="color: red;"></div>
    @error('model_code')
        <span class="error" style="color: red;">{{ $message }}</span>
    @enderror
</div>

                                        <label for="customer_code" class="col-sm-2 col-form-label mandatory">Model
                                            Name</label>
                                        <div class="col-sm-4 mb-4">
                                            <input class="form-control" type="text" name="model_name" id="model_name"required>
                                            @error('model_name')
                                                <span class="error" style="color: red;">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <label for="customer_code" class="col-sm-2 col-form-label mandatory">Req raw Material
                                            weight/item</label>
                                        <div class="col-sm-4 mb-4">
                                            <input class="form-control" type="text" name="raw_material_weight_item"
                                                id="model_code"required>
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

<script>
   document.addEventListener('DOMContentLoaded', function () {
      let modelField = document.getElementById('model_code');
      let modelError = document.getElementById('model_codeError');

      modelField.addEventListener('input', function () {
         let modelCode = this.value.trim();
         modelError.textContent = ''; // Reset error message on each input change

         // Perform an AJAX request to check if the model code exists
         $.ajax({
            method: 'POST',
            url: '{{ route("master.product_model.checkName") }}',
            data: { model_code: modelCode, _token: '{{ csrf_token() }}' },
            success: function (response) {
               if (response.exists) {
                  modelError.textContent = 'Model code already exists in the database!';
               }
            },
            error: function (error) {
               console.error(error);
               modelError.textContent = 'Error occurred while checking the model code.';
            }
         });
      });
   });
</script>


    @include('links.js.select2.select2')
@endsection
