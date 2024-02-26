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
                            <li class="breadcrumb-item"><a href="{{ route('master.finishing_product.index') }}">Finishing Product</a>
                            </li>
                            <li class="breadcrumb-item">Create</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Create Finishing Product</h4>
                </div>
            </div>
        </div>
        <!-- end page title end breadcrumb -->

        <div class="row">
            <div class="col-12">
                <div class="card m-b-30">
                    <div class="card-body">
                        <div class="m-b-30">
                            <form action="{{ route('master.finishing_product.store') }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="form-group row">
   
<label class="col-sm-2 col-form-label">Product</label>
<div class="col-sm-4 mb-4">
    <select class="form-control" name="product_id" id="product">
        <option value="">Select Product</option>
        @foreach($products as $product)
            <option value="{{ $product->id }}">{{ $product->name }}</option>
        @endforeach
    </select>
    @error('product_id')
    <span class="error" style="color: red;">{{ $message }}</span>
    @enderror
</div>
<label class="col-sm-2 col-form-label">Product Size</label>
<div class="col-sm-4 mb-4">
    <select class="form-control" name="product_size_id" id="product_size_id">
        <option value="">Select Product size</option>
        @foreach($product_size as $item)
            <option value="{{ $item->id }}">{{ $item->name }}</option>
        @endforeach
    </select>
    @error('product_size_id')
    <span class="error" style="color: red;">{{ $message }}</span>
    @enderror
</div>
                        

<label for="wages_product" class="col-sm-2 col-form-label mandatory">Model Code</label>
  <div class="col-sm-4 mb-4">
    <input class="form-control" type="text" name="model_code" id="model_code">
    @error('model_code')
    <span class="error" style="color: red;">{{ $message }}</span>
    @enderror
</div>

<label for="wages_product" class="col-sm-2 col-form-label">Model Name</label>
  <div class="col-sm-4 mb-4">
    <input class="form-control" type="text" name="model_name" id="model_name">
    @error('model_name')
    <span class="error" style="color: red;">{{ $message }}</span>
    @enderror
</div>
<label for="wages_product" class="col-sm-2 col-form-label">Date</label>
  <div class="col-sm-4 mb-4">
    <input class="form-control" type="date" name="date" id="date">
    @error('date')
    <span class="error" style="color: red;">{{ $message }}</span>
    @enderror
</div>

<label for="wages_product" class="col-sm-2 col-form-label">Wages of one Product</label>
  <div class="col-sm-4 mb-4">
    <input class="form-control" type="text" name="wages_one_product" id="wages_one_product">
    @error('wages_one_product')
    <span class="error" style="color: red;">{{ $message }}</span>
    @enderror
</div>



                                <div class="form-group">
                                    <div class="d-flex justify-content-evenly">
                                        <button type="submit" class="btn btn-primary waves-effect waves-light">
                                            Submit
                                        </button>
                                        <a href="{{ route('master.finishing_product.create') }}"
                                            class="btn btn-warning waves-effect waves-light">
                                            Reset
                                        </a>
                                        <a href="{{ route('master.finishing_product.index') }}"
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
<script>
   $(document).ready(function(){
       $('#product').change(function(){
           $('#product_model').prop('disabled', $(this).val() == '');
       });
   });
</script>

@include('links.js.select2.select2')
@endsection