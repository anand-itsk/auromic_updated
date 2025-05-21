@extends('layouts.app')
@section('title', 'Edit Direct Job Received Without Giving')
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
                                        href="{{ route('job_allocation.direct_job_giving.index') }}">Direct Job Giving</a>
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
                                <form
                                    action="{{ route('job_allocation.direct_job_wc_giving.update', $direct_job_without_giving->id) }}"
                                    method="POST">
                                    @csrf
                                    <div class="form-group row">
                                        <label for="employee_id" class="col-sm-2 col-form-label">
                                            Employee Name
                                        </label>
                                        <div class="col-sm-4 mb-4">
                                            <select class="form-control select2" name="employee_id" id="employee_id">
                                                @foreach ($employee as $item)
                                                    <option value="{{ $item->id }}"
                                                        data-company-name="{{ $item->company->company_name ?? '' }}"
                                                        data-company-type="{{ $item->company->companyType->name ?? '' }}"
                                                        {{ $item->id == $direct_job_without_giving->employee_id ? 'selected' : '' }}>
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
                                            <input type="text" class="form-control" name="company_type" id="company_type"
                                                readonly>
                                            @error('company_type')
                                                <span class="error" style="color: red;">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <label for="company_name" class="col-sm-2 col-form-label ">
                                            Company Name
                                        </label>
                                        <div class="col-sm-4 mb-4">
                                            <input type="text" class="form-control" name="company_name" id="company_name"
                                                readonly>
                                            @error('company_name')
                                                <span class="error" style="color: red;">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <label class="col-sm-2 col-form-label">Model</label>
                                        <div class="col-sm-4 mb-4">
                                            <select class="form-control" name="finishing_product_models_id"
                                                id="finishing_product_models_id">

                                                @foreach ($finishingProduct as $finishingProducts)
                                                    <option value="{{ $finishingProducts->id }}"
                                                        @if ($finishingProducts->id == $direct_job_without_giving->finishing_product_models_id) selected @endif>
                                                        {{ $finishingProducts->model_code }}</option>
                                                @endforeach
                                            </select>
                                            @error('finishing_product_models_id')
                                                <span class="error" style="color: red;">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <label for="order_date" class="col-sm-2 col-form-label ">Product Name</label>
                                        <div class="col-sm-4 mb-4">
                                            <input class="form-control" type="text" name="product" id="product"
                                                readonly value="{{ $finishingProducts->product->name }}">
                                            @error('product_id')
                                                <span class="error" style="color: red;">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <label for="product_size" class="col-sm-2 col-form-label">Product Size</label>
                                        <div class="col-sm-4 mb-4">

                                            <input class="form-control" type="text" name="product_size" id="product_size"
                                                readonly
                                                value="{{ $direct_job_without_giving->finishingProduct->productSize->code ?? '' }}">

                                            @error('product_size')
                                                <span class="error" style="color: red;">{{ $message }}</span>
                                            @enderror
                                        </div>
                                         <label for="customer_code" class="col-sm-2 col-form-label">Product Color</label>
                                        <div class="col-sm-4 mb-4">
                                            <select class="form-control select2" name="product_color_id"
                                                id="product_color">
                                                <option value="">Select Product Color</option>
                                                @foreach ($product_color as $product_colors)
                                                   <option value="{{ $product_colors->id }}" 
                    {{ $product_colors->id == $direct_job_without_giving->product_color_id ? 'selected' : '' }}>
                    {{ $product_colors->name }}
                </option>
                                                @endforeach
                                            </select>
                                            @error('finishing_product_models_id')
                                                <span class="error" style="color: red;">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <label for="product_size" class="col-sm-2 col-form-label">Total Received
                                            Quantity</label>
                                        <div class="col-sm-4 mb-4">

                                            <input class="form-control" type="text" name="received_quantity"
                                                id="received_quantity"value="{{ $direct_job_without_giving->received_quantity ?? '' }}">

                                            @error('product_size')
                                                <span class="error" style="color: red;">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <label for="product_size" class="col-sm-2 col-form-label">Received Date</label>
                                        <div class="col-sm-4 mb-4">

                                            <input class="form-control" type="date" name="receving_date"
                                                id="receving_date"value="{{ $direct_job_without_giving->receving_date ?? '' }}">

                                            @error('product_size')
                                                <span class="error" style="color: red;">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <label for="order_date" class="col-sm-2 col-form-label">Meter</label>
                                        <div class="col-sm-4 mb-4">
                                            <input class="form-control" type="text" name="meter" id="meter"
                                                readonly
                                                value="{{ $direct_job_without_giving->finishingProduct->meters_one_product ?? '' }}">
                                            @error('meter')
                                                <span class="error" style="color: red;">{{ $message }}</span>
                                            @enderror
                                        </div>
<label for="customer_code" class="col-sm-2 col-form-label mandatory">
                                            Incentive Applicable
                                        </label>
                                        <div class="col-sm-4 mb-4">
                                            <select class="form-control select2" name="Incentive_status"
                                                id="Incentive_status">
                                               <option value="No" {{ $direct_job_without_giving->Incentive_status == 'No' ? 'selected' : '' }}>No</option>
            <option value="Yes" {{ $direct_job_without_giving->Incentive_status == 'Yes' ? 'selected' : '' }}>Yes</option>

                                            </select>
                                            @error('Incentive_status')
                                                <span class="error" style="color: red;">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <label for="before_days" class="col-sm-1 col-form-label">
                                            Before (Days)
                                        </label>
                                        <div class="col-sm-2 mb-4">
                                           <input type="text" class="form-control" name="before_days" id="before_days" 
            value="{{ old('before_days', $direct_job_without_giving->before_days) }}" {{ $direct_job_without_giving->Incentive_status == 'No' ? 'disabled' : '' }}>
                                            @error('before_days')
                                                <span class="error" style="color: red;">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <label for="after_days" class="col-sm-1 col-form-label">
                                            After (Days)
                                        </label>
                                        <div class="col-sm-2 mb-4">
                                           <input type="text" class="form-control" name="after_days" id="after_days" 
            value="{{ old('after_days', $direct_job_without_giving->after_days) }}">
                                            @error('after_days')
                                                <span class="error" style="color: red;">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <label for="conveyance" class="col-sm-2 col-form-label">
                                            Conveyance
                                        </label>
                                        <div class="col-sm-4 mb-4">
                                             <input type="text" class="form-control" name="conveyance" id="conveyance" 
            value="{{ old('conveyance', $direct_job_without_giving->conveyance_fee) }}">
                                            @error('conveyance')
                                                <span class="error" style="color: red;">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <label for="deduction" class="col-sm-2 col-form-label">
                                            Deduction
                                        </label>
                                        <div class="col-sm-4 mb-4">
                                           <input type="text" class="form-control" name="deduction" id="deduction" 
            value="{{ old('deduction', $direct_job_without_giving->deducation_fee) }}">
                                            @error('deduction')
                                                <span class="error" style="color: red;">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <label for="incentive" class="col-sm-2 col-form-label">
                                            Incentive
                                        </label>
                                        <div class="col-sm-4 mb-4">
                                           <input type="text" class="form-control" name="incentive" id="incentive" 
            value="{{ old('incentive', $direct_job_without_giving->incentive_fee) }}" {{ $direct_job_without_giving->Incentive_status == 'No' ? 'disabled' : '' }}>
                                            @error('incentive')
                                                <span class="error" style="color: red;">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <label for="total_amount" class="col-sm-2 col-form-label">Total</label>
                                        <div class="col-sm-4 mb-4">
                                           <input type="text" class="form-control" name="total_amount" id="total_amount" 
            value="{{ old('total_amount', $direct_job_without_giving->total_amount) }}" readonly>
                                            @error('total_amount')
                                                <span class="error" style="color: red;">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <label for="net_amount" class="col-sm-2 col-form-label">Net Amount</label>
                                        <div class="col-sm-4 mb-4">
                                             <input type="text" class="form-control" name="net_amount" id="net_amount" 
            value="{{ old('net_amount', $direct_job_without_giving->net_amount) }}" readonly>
                                            @error('net_amount')
                                                <span class="error" style="color: red;">{{ $message }}</span>
                                            @enderror
                                        </div>

                                    </div>
                                    <div class="form-group">
                                        <div class="d-flex justify-content-evenly">
                                            <button type="submit" class="btn btn-primary waves-effect waves-light">
                                                Submit
                                            </button>
                                            <a href="{{ route('job_allocation.direct_job_giving.index') }}"
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
            var companyName = $('#employee_id').find(':selected').data('company-name');
            var companyType = $('#employee_id').find(':selected').data('company-type');
            $('#company_name').val(companyName);
            $('#company_type').val(companyType);
        });
    </script>

    @include('links.js.select2.select2')
@endsection
