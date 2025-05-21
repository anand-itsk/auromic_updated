@extends('layouts.app')
@section('title', 'Edit Direct Job Giving')
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
                                    action="{{ route('job_allocation.direct_job_giving.update', $direct_job_giving->id) }}"
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
                                                        @if ($finishingProducts->id == $direct_job_giving->finishing_product_models_id) selected @endif>
                                                        {{ $finishingProducts->model_code }}</option>
                                                @endforeach
                                            </select>
                                            @error('finishing_product_models_id')
                                                <span class="error" style="color: red;">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <input class="form-control" type="hidden" name="cutting_charge" id="cutting_charge"
                                            value="{{ $direct_job_giving->finishingProduct->cutting_charge }}">
                                        <label for="order_date" class="col-sm-2 col-form-label ">Product Name</label>
                                        <div class="col-sm-4 mb-4">
                                            <input class="form-control" type="text" name="product" id="product_name"
                                                readonly value="{{ $direct_job_giving->finishingProduct->product->name }}">
                                            @error('product_id')
                                                <span class="error" style="color: red;">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <label for="product_size" class="col-sm-2 col-form-label">Product Size</label>
                                        <div class="col-sm-4 mb-4">

                                            <input class="form-control" type="text" name="product_size"
                                                id="product_sizes" readonly
                                                value="{{ $direct_job_giving->finishingProduct->productSize->code ?? '' }}">

                                            @error('product_size')
                                                <span class="error" style="color: red;">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <input class="form-control" type="hidden" name="product_size_id"
                                            id="product_size_ids">
                                        <label for="meter_for_one_product" class="col-sm-2 col-form-label">Meter for one
                                            product</label>
                                        <div class="col-sm-4 mb-4">
                                            <input class="form-control" type="text" name="meter_for_one_product"
                                                id="meter_for_one_product" readonly
                                                value="{{ $direct_job_giving->finishingProduct->meters_one_product }}">
                                            @error('meter_for_one_product')
                                                <span class="error" style="color: red;">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <label for="product_size" class="col-sm-2 col-form-label">Total Received
                                            Quantity</label>
                                        <div class="col-sm-4 mb-4">

                                            <input class="form-control" type="text" name="total_quantity"
                                                id="total_quantity" readonly
                                                value="{{ $direct_job_giving->total_quantity ?? '' }}">

                                            @error('product_size')
                                                <span class="error" style="color: red;">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <label for="customer_code" class="col-sm-2 col-form-label">Product Color</label>
                                        <div class="col-sm-4 mb-4">
                                            <select class="form-control select2" name="product_color_id"
                                                id="product_color_id">
                                                <option value="">Select Product color</option>
                                                @foreach ($product_color as $item)
                                                    <option value="{{ $item->id }}"
                                                        {{ $item->id == $direct_job_giving->product_color_id ? 'selected' : '' }}>
                                                        {{ $item->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('product_color_id')
                                                <span class="error" style="color: red;">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <label for="customer_code" class="col-sm-2 col-form-label mandatory">Is Clothes by
                                            Cutting?</label>
                                        <div class="col-sm-4 mb-4">
                                            <select class="form-control" name="clothes_by_cutting"
                                                id="clothes_by_cutting">
                                                <option value="0"
                                                    {{ $direct_job_giving->finishing_product_models_id == 0 ? 'selected' : '' }}>
                                                    No</option>
                                                <option value="1"
                                                    {{ $direct_job_giving->finishing_product_models_id == 1 ? 'selected' : '' }}>
                                                    Yes</option>
                                            </select>
                                            @error('finishing_product_models_id')
                                                <span class="error" style="color: red;">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <label for="total_cutting_pices" class="col-sm-2 col-form-label">Total Cutting
                                            Charge</label>
                                        <div class="col-sm-4 mb-4">
                                            <input class="form-control" type="text" name="total_cutting_pices"
                                                id="total_cutting_pices"value="{{ $direct_job_giving->total_cutting_pieces }}">
                                            @error('total_cutting_pices')
                                                <span class="error" style="color: red;">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <label for="order_date" class="col-sm-2 col-form-label">Meter</label>
                                        <div class="col-sm-4 mb-4">
                                            <input class="form-control" type="text" name="meter" id="meter"
                                                value="{{ $direct_job_giving->meter }}">
                                            @error('meter')
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

    <script>
        $(document).ready(function() {
            $('#employee_id').change(function() {
                var companyName = $(this).find(':selected').data('company-name');
                var companyType = $(this).find(':selected').data('company-type');
                $('#company_name').val(companyName);
                $('#company_type').val(companyType);
            });

        });
    </script>
    <script>
        $(document).ready(function() {
            $('#finishing_product_models_id').change(function() {
                var modelId = $(this).val();
                if (modelId) {
                    $.ajax({
                        url: '/job_allocation/direct_job_giving/get-finishing-product-details/' +
                            modelId,
                        type: 'GET',
                        dataType: 'json',
                        success: function(data) {

                            $('#product_name').val(data.product_name);
                            $('#product_sizes').val(data.product_size);
                            $('#product_size_ids').val(data.product_size_id);
                            $('#meter_for_one_product').val(data.meters_one_product);
                            $('#cutting_charge').val(data.cutting_charge);

                        }
                    });
                }
            });
        });
    </script>

    <script>
        $('#meter').on('input', function() {
            var meterForOneProduct = parseFloat($('#meter_for_one_product').val(), 10);
            var totalMeter = parseFloat($(this).val(), 10);
            var errorSpan = $('#assign_meter_error');
            var net = (totalMeter / meterForOneProduct);

            $('#total_quantity').val(net);
            calculateTotalCuttingCharges();
        });
        $('#total_quantity, #cutting_charge').on('input', function() {
            calculateTotalCuttingCharges();
        });

        function calculateTotalCuttingCharges() {
            var receivingQuantity = parseFloat($('#total_quantity').val(), 10) || 0;
            var cuttingCharge = parseFloat($('#cutting_charge').val(), 10) || 0;
            var totalCuttingCharges = receivingQuantity * cuttingCharge;

            $('#total_cutting_pices').val(totalCuttingCharges.toFixed(2)); // Set value with 2 decimal points
        };
    </script>


    @include('links.js.select2.select2')
@endsection
