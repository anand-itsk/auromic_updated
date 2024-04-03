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
                            <li class="breadcrumb-item"><a href="{{ route('job_allocation.direct_job_giving.index') }}">Direct Job Giving</a>
                            </li>
                            <li class="breadcrumb-item">Edit</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Edit Direct Job Giving</h4>
                </div>
            </div>
        </div>
        <!-- end page title end breadcrumb -->

        <div class="row">
            <div class="col-12">
                <div class="card m-b-30">
                    <div class="card-body">
                        <div class="m-b-30">
     <form action="{{ route('job_allocation.direct_job_giving.update',$direct_job_giving->id) }}" method="POST">
    @csrf
   <div class="form-group row">
<label for="employee_id" class="col-sm-2 col-form-label">
                           Employee Name
                           </label>
                           <div class="col-sm-4 mb-4">
                              <select class="form-control select2" name="employee_id" id="employee_id">
    @foreach ($employee as $item)
        <option value="{{ $item->id }}" 
            data-company-name="{{ $item->company->company_name }}" 
            data-company-type="{{ $item->company->companyType->name }}"
            {{ $item->id == $direct_job_giving->employee_id ? 'selected' : '' }}>
            {{ $item->employee_code }}/{{ $item->employee_name }}
        </option>
    @endforeach
</select>
                              @error('employee_id')
                              <span class="error" style="color: red;">{{ $message }}</span>
                              @enderror
                           </div>





                           <label for="company_type" class="col-sm-2 col-form-label ">
                           Company Type
                           </label>
                           <div class="col-sm-4 mb-4">
                              <input type="text" class="form-control" name="company_type" id="company_type" readonly>
                              @error('company_type')
                              <span class="error" style="color: red;">{{ $message }}</span>
                              @enderror
                           </div>
                           <label for="company_name" class="col-sm-2 col-form-label ">
                           Company Name
                           </label>
                           <div class="col-sm-4 mb-4">
                              <input type="text" class="form-control" name="company_name" id="company_name" readonly>
                              @error('company_name')
                              <span class="error" style="color: red;">{{ $message }}</span>
                              @enderror
                           </div>
                       <label class="col-sm-2 col-form-label">Model</label>
<div class="col-sm-4 mb-4">
   <select class="form-control" name="finishing_product_models_id" id="finishing_product_models_id">
     
        @foreach ($finishingProduct as $finishingProducts)

             <option value="{{ $finishingProducts->id }}" @if ($finishingProducts->id == $direct_job_giving->finishing_product_models_id) selected @endif>{{ $finishingProducts->model_code }}</option>
        @endforeach
    </select>
    @error('finishing_product_models_id')
        <span class="error" style="color: red;">{{ $message }}</span>
    @enderror
</div>
                           <label for="order_date" class="col-sm-2 col-form-label ">Product Name</label>
                           <div class="col-sm-4 mb-4">
                              <input class="form-control" type="text" name="product" id="product" readonly value="{{$finishingProducts->product->name}}">
                              @error('product_id')
                              <span class="error" style="color: red;">{{ $message }}</span>
                              @enderror
                           </div>
                          <label for="customer_code" class="col-sm-2 col-form-label">Product Size</label>
<div class="col-sm-4 mb-4">
    <select class="form-control select2" name="product_size_id" id="product_size_id">
        <option value="">Select Product Size</option>
        @foreach ($product_size as $item)
            <option value="{{ $item->id }}" {{ $item->id == $direct_job_giving->product_size_id ? 'selected' : '' }}>{{ $item->name }}</option>
        @endforeach
    </select>
    @error('product_size_id')
        <span class="error" style="color: red;">{{ $message }}</span>
    @enderror
</div>
<label for="customer_code" class="col-sm-2 col-form-label">Product Color</label>
<div class="col-sm-4 mb-4">
    <select class="form-control select2" name="product_color_id" id="product_color_id">
        <option value="">Select Product color</option>
        @foreach ($product_color as $item)
            <option value="{{ $item->id }}" {{ $item->id == $direct_job_giving->product_color_id ? 'selected' : '' }}>{{ $item->name }}</option>
        @endforeach
    </select>
    @error('product_color_id')
        <span class="error" style="color: red;">{{ $message }}</span>
    @enderror
</div>
<label for="order_date" class="col-sm-2 col-form-label">Quantity</label>
<div class="col-sm-4 mb-4">
    <input class="form-control" type="text" name="quantity" id="quantity" value="{{$direct_job_giving->quantity}}">
    @error('quantity')
        <span class="error" style="color: red;">{{ $message }}</span>
    @enderror
</div>
<label for="order_date" class="col-sm-2 col-form-label">Weight</label>
<div class="col-sm-4 mb-4">
    <input class="form-control" type="text" name="weight" id="weight" value="{{$direct_job_giving->weight}}">
    @error('weight')
        <span class="error" style="color: red;">{{ $message }}</span>
    @enderror
</div>
   
</div>
    <div class="form-group">
        <div class="d-flex justify-content-evenly">
            <button type="submit" class="btn btn-primary waves-effect waves-light">
                Submit
            </button>
            <a href="{{ route('job_allocation.direct_job_giving.index') }}" class="btn btn-secondary waves-effect m-l-5">
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
            var companyName = $('#employee_id').find(':selected').data('company-name');
            var companyType = $('#employee_id').find(':selected').data('company-type');
            $('#company_name').val(companyName);
            $('#company_type').val(companyType);
        });
    </script>

@include('links.js.select2.select2')
@endsection