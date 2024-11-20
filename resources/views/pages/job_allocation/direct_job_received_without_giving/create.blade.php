@extends('layouts.app')
@section('title', 'Create Direct Job Giving')
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
                                        href="{{ route('job_allocation.direct_job_wc_giving.index') }}">Direct Job Received
                                        Without Giving</a>
                                </li>
                                <li class="breadcrumb-item">Create</li>
                            </ol>
                        </div>
                        <h4 class="page-title">Create Direct Job Received Without Giving</h4>
                    </div>
                </div>
            </div>
            <!-- end page title end breadcrumb -->

            <div class="row">
                <div class="col-12">
                    <div class="card m-b-30">
                        <div class="card-body">
                            <div class="m-b-30">
                                <form action="{{ route('job_allocation.direct_job_wc_giving.store') }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group row">

                                        <label for="customer_code" class="col-sm-2 col-form-label mandatory">
                                            Employee
                                        </label>
                                        <div class="col-sm-4 mb-4">
                                            <select class="form-control select2" name="employee_id" id="employee_id"
                                                required>
                                                <option value="">Select Employee</option>
                                                @foreach ($employee as $item)
                                                    <option value="{{ $item->id }}"
                                                        data-company-name="{{ $item->company->company_name ?? '' }}/{{ $item->company->authorisedPerson->name ?? '' }}"
                                                        data-company-type="{{ $item->company->companyType->name ?? '' }}">
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
                                        <label for="customer_code" class="col-sm-2 col-form-label mandatory">Model</label>
                                        <div class="col-sm-4 mb-4">
                                            <select class="form-control select2" name="finishing_product_models_id"
                                                id="finishing_product_models_id" required>
                                                <option value="">Select Finishing Model</option>
                                                @foreach ($finishingProduct as $finishingProducts)
                                                    <option value="{{ $finishingProducts->id }}">
                                                        {{ $finishingProducts->model_name }} /
                                                        {{ $finishingProducts->model_code }}</option>
                                                @endforeach
                                            </select>
                                            @error('finishing_product_models_id')
                                                <span class="error" style="color: red;">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <label for="order_date" class="col-sm-2 col-form-label ">Product Name</label>
                                        <div class="col-sm-4 mb-4">
                                            <input class="form-control" type="text" name="product_name" id="product_name"
                                                readonly>
                                            @error('product_name')
                                                <span class="error" style="color: red;">{{ $message }}</span>
                                            @enderror
                                        </div>


                                        <label for="product_size" class="col-sm-2 col-form-label">Product
                                            Size</label>
                                        <div class="col-sm-4 mb-4">
                                            <input class="form-control" type="text" name="product_size" id="product_size"
                                                readonly>
                                            @error('product_size')
                                                <span class="error" style="color: red;">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <input class="form-control" type="hidden" name="product_size_id"
                                            id="product_size_id">
                                        <label for="meter_for_one_product" class="col-sm-2 col-form-label">Meter for one
                                            product</label>
                                        <div class="col-sm-4 mb-4">
                                            <input class="form-control" type="text" name="meter_for_one_product"
                                                id="meter_for_one_product" readonly>
                                            @error('meter_for_one_product')
                                                <span class="error" style="color: red;">{{ $message }}</span>
                                            @enderror
                                        </div>




                                        <label for="total_quantity" class="col-sm-2 col-form-label">Receiving
                                            Quantity</label>
                                        <div class="col-sm-4 mb-4">
                                            <input class="form-control" type="text" name="received_quantity"
                                                id="total_quantity">
                                            @error('total_quantity')
                                                <span class="error" style="color: red;">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <label for="total_quantity" class="col-sm-2 col-form-label">Receiving
                                            Date</label>
                                        <div class="col-sm-4 mb-4">
                                            <input class="form-control" type="date" name="receving_date"
                                                id="receving_date">
                                            @error('receving_date')
                                                <span class="error" style="color: red;">{{ $message }}</span>
                                            @enderror
                                        </div>

                                    </div>
                                    <div class="form-group">
                                        <div class="d-flex justify-content-evenly">
                                            <button type="submit" class="btn btn-primary waves-effect waves-light">
                                                Submit
                                            </button>
                                            <a href="{{ route('job_allocation.direct_job_giving.create') }}"
                                                class="btn btn-warning waves-effect waves-light">
                                                Reset
                                            </a>
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
        $(document).ready(function() {
            $('#product').change(function() {
                $('#product_model').prop('disabled', $(this).val() == '');
            });
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


            $('#meter').on('input', function() {
                var meterForOneProduct = parseFloat($('#meter_for_one_product').val(), 10);
                var totalMeter = parseFloat($(this).val(), 10);
                var errorSpan = $('#assign_meter_error');
                var net = (totalMeter / meterForOneProduct);

                $('#total_quantity').val(net);

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
                            $('#product_size').val(data.product_size);
                            $('#product_size_id').val(data.product_size_id);
                            $('#meter_for_one_product').val(data.meters_one_product);

                        }
                    });
                }
            });
        });

        document.addEventListener('DOMContentLoaded', function() {
            // Find the select box and the div that contains the "Total Meter" input by their IDs
            var clothesByCuttingSelect = document.getElementById('clothes_by_cutting');
            var meterInputContainer = document.getElementById('total_cutting_pices').parentNode;
            var meterLabel = document.querySelector('label[for="total_cutting_pices"]');
            // Function to show or hide the "Total Meter" input
            function toggleMeterInput() {
                // Check if the selected value is "1" (Yes)
                if (clothesByCuttingSelect.value === '1') {
                    meterLabel.style.display = '';
                    meterInputContainer.style.display = ''; // Show
                } else {
                    meterLabel.style.display = 'none';
                    meterInputContainer.style.display = 'none'; // Hide
                }
            }

            // Initially call the function to set the correct display state based on the current selection
            toggleMeterInput();

            // Add an event listener to the select box to toggle the "Total Meter" input when the selection changes
            clothesByCuttingSelect.addEventListener('change', toggleMeterInput);
        });
    </script>
    @include('links.js.select2.select2')
@endsection
