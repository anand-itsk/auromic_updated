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
   
<label class="col-sm-2 col-form-label">Employee</label>
<div class="col-sm-4 mb-4">
    <select class="form-control" name="employee_id" id="employe_id">
        <option value="">Select Employee</option>
        @foreach($employee as $employees)
            <option value="{{ $employees->id }}" {{ $direct_job_giving->employee_id == $employees->id ? 'selected' : '' }}>{{ $employees->employee_code }}/{{ $employees->employee_name}}</option>
        @endforeach
    </select>
    @error('employee_id')
    <span class="error" style="color: red;">{{ $message }}</span>
    @enderror
</div>

<label class="col-sm-2 col-form-label">Model</label>
<div class="col-sm-4 mb-4">
    <select class="form-control" name="product_model_id" id="product_model">
        <option value="">Select Product Model</option>
        @foreach($product_model as $productModels)
            <option value="{{ $productModels->id }}" {{ $direct_job_giving->product_model_id == $productModels->id ? 'selected' : '' }}>{{ $productModels->model_name }}-{{ $productModels->model_code }}</option>
        @endforeach
    </select>
    @error('product_model')
    <span class="error" style="color: red;">{{ $message }}</span>
    @enderror
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





@include('links.js.select2.select2')
@endsection