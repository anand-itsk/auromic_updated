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
                                <li class="breadcrumb-item"><a
                                        href="{{ route('job_allocation.direct_job_giving.index') }}">Direct Job Giving</a>
                                </li>
                                <li class="breadcrumb-item">Edit</li>
                            </ol>
                        </div>
                        <h4 class="page-title">Edit Direct Job received</h4>
                    </div>
                </div>
            </div>
            <!-- end page title end breadcrumb -->
            <div class="row">
                <div class="col-12">
                    <div class="card m-b-30">
                        <div class="card-body">
                            <div class="m-b-30">
                                <form action="{{ route('job_allocation.direct_job_received.store') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="direct_job_giving_id" value="{{ $id }}">
                                    <input type="hidden" name="product_color_id" value="{{ $direct_job_giving->product_color_id }}">
<input type="hidden" name="finishing_product_models_id" value="{{ $direct_job_giving->finishing_product_models_id }}">
<input type="hidden" name="employee_id" value="{{ $direct_job_giving->employee_id }}">
                                    <div class="form-group row">
                                        <label for="employee_id" class="col-sm-2 col-form-label">
                                            Employee Name
                                        </label>
                                        <div class="col-sm-4 mb-4">
                                            <select class="form-control select2" name="employees" id="employees" disabled>
                                                @foreach ($employee as $item)
                                                    <option value="{{ $item->id }}"
                                                        data-company-names="{{ $item->company->company_name }}"
                                                        data-company-types="{{ $item->company->companyType->name }}"
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
                                            <input type="text" class="form-control" name="company_types"
                                                id="company_types" readonly>
                                            @error('company_type')
                                                <span class="error" style="color: red;">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <label for="company_name" class="col-sm-2 col-form-label ">
                                            Company Name
                                        </label>
                                        <div class="col-sm-4 mb-4">
                                            <input type="text" class="form-control" name="company_names"
                                                id="company_names" readonly>
                                            @error('company_name')
                                                <span class="error" style="color: red;">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <label class="col-sm-2 col-form-label">Model</label>
                                        <div class="col-sm-4 mb-4">
                                            <select class="form-control" name="finishing_product_models_id"
                                                id="finishing_product_models_id" disabled>
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
                                                value="{{ $direct_job_giving->finishingProduct->productSize->code ?? '' }}">

                                            @error('product_size')
                                                <span class="error" style="color: red;">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <label for="wages_per_quantity" class="col-sm-2 col-form-label">Wages for one
                                            product</label>
                                        <div class="col-sm-4 mb-4">

                                            <input class="form-control" type="text" name="wages_per_quantity"
                                                id="wages_per_quantity" readonly
                                                value="{{ $direct_job_giving->finishingProduct->wages_one_product ?? '' }}">

                                            @error('wages_per_quantity')
                                                <span class="error" style="color: red;">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <label for="meters_one_product" class="col-sm-2 col-form-label">Meter for one
                                            product</label>
                                        <div class="col-sm-4 mb-4">

                                            <input class="form-control" type="text" name="meters_one_product"
                                                id="meters_one_product" readonly
                                                value="{{ $direct_job_giving->finishingProduct->meters_one_product ?? '' }}">

                                            @error('meters_one_product')
                                                <span class="error" style="color: red;">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <label for="customer_code" class="col-sm-2 col-form-label">Product Color</label>
                                        <div class="col-sm-4 mb-4">
                                            <select class="form-control select2" name="product_color_id"
                                                id="product_color_id" disabled>
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
                                        <label for="order_date" class="col-sm-2 col-form-label">Total Given Meters</label>
                                        <div class="col-sm-4 mb-4">
                                            <input class="form-control" type="text" name="meter" id="meter"
                                                readonly value="{{ $direct_job_giving->meter }}">
                                            @error('meter')
                                                <span class="error" style="color: red;">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <label for="order_date" class="col-sm-2 col-form-label">Cutting Pices</label>
                                        <div class="col-sm-4 mb-4">
                                            <input class="form-control" type="text" name="meter" id="meter"
                                                readonly value="{{ $direct_job_giving->meter }}">
                                            @error('meter')
                                                <span class="error" style="color: red;">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <label for="is_cutting" class="col-sm-2 col-form-label">Is Cutting</label>
                                        <div class="col-sm-4 mb-4">
                                            <input class="form-control" type="text" name="is_cutting" id="is_cutting"
                                                readonly
                                                value="{{ $direct_job_giving->clothes_by_cutting == 1 ? 'Yes' : 'No' }}">
                                            @error('is_cutting')
                                                <span class="error" style="color: red;">{{ $message }}</span>
                                            @enderror
                                        </div>

                                    </div>
                                    <hr>
                                    <div class="form-group row">
                                        <label for="order_date" class="col-sm-2 col-form-label ">Receiving
                                            Date</label>
                                        <div class="col-sm-4 mb-4">
                                            <input class="form-control" type="date" name="receiving_date"
                                                id="receiving_date" required="">
                                            @error('order_id')
                                                <span class="error" style="color: red;">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <label for="order_date" class="col-sm-2 col-form-label ">Receiving
                                            Quantity</label>
                                        <div class="col-sm-4 mb-4">
                                            <input class="form-control" type="text" name="received_quantity"
                                                id="received_quantity" required="">
                                            @error('order_id')
                                                <span class="error" style="color: red;">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <label for="cutting_charges" class="col-sm-2 col-form-label ">Cutting
                                            Charges</label>
                                        <div class="col-sm-4 mb-4">
                                            <input class="form-control" type="text" name="cutting_charges"
                                                id="cutting_charges" required="">
                                            @error('cutting_charges')
                                                <span class="error" style="color: red;">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <label for="usage_meters" class="col-sm-2 col-form-label ">Usage Meters</label>
                                        <div class="col-sm-4 mb-4">
                                            <input class="form-control" type="text" name="usage_meters"
                                                id="usage_meters" required="">
                                            @error('usage_meters')
                                                <span class="error" style="color: red;">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <label for="wastage_meters" class="col-sm-2 col-form-label ">Wastage
                                            Meters</label>
                                        <div class="col-sm-4 mb-4">
                                            <input class="form-control" type="text" name="wastage_meters"
                                                id="wastage_meters" required="">
                                            @error('wastage_meters')
                                                <span class="error" style="color: red;">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <label for="balance_meters" class="col-sm-2 col-form-label ">Balance
                                            Meters</label>
                                        <div class="col-sm-4 mb-4">
                                            <input class="form-control" type="text" name="balance_meters"
                                                id="balance_meters" readonly>
                                            @error('balance_meters')
                                                <span class="error" style="color: red;">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <label for="customer_code" class="col-sm-2 col-form-label mandatory">
                                            Incentive Applicable
                                        </label>
                                        <div class="col-sm-4 mb-4">
                                            <select class="form-control select2" name="Incentive_status"
                                                id="Incentive_status">
                                                <option value="No">No</option>
                                                <option value="Yes">Yes</option>

                                            </select>
                                            @error('Incentive_status')
                                                <span class="error" style="color: red;">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <label for="before_days" class="col-sm-1 col-form-label">
                                            Before (Days)
                                        </label>
                                        <div class="col-sm-2 mb-4">
                                            <input type="text" class="form-control" name="before_days"
                                                id="before_days"disabled>
                                            @error('before_days')
                                                <span class="error" style="color: red;">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <label for="after_days" class="col-sm-1 col-form-label">
                                            After (Days)
                                        </label>
                                        <div class="col-sm-2 mb-4">
                                            <input type="text" class="form-control" name="after_days"
                                                id="after_days">
                                            @error('after_days')
                                                <span class="error" style="color: red;">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <label for="conveyance" class="col-sm-2 col-form-label">
                                            Conveyance
                                        </label>
                                        <div class="col-sm-4 mb-4">
                                            <input type="text" class="form-control" name="conveyance"
                                                id="conveyance">
                                            @error('conveyance')
                                                <span class="error" style="color: red;">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <label for="deduction" class="col-sm-2 col-form-label">
                                            Deduction
                                        </label>
                                        <div class="col-sm-4 mb-4">
                                            <input type="text" class="form-control" name="deduction" id="deduction">
                                            @error('deduction')
                                                <span class="error" style="color: red;">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <label for="incentive" class="col-sm-2 col-form-label">
                                            Incentive
                                        </label>
                                        <div class="col-sm-4 mb-4">
                                            <input type="text" class="form-control" name="incentive" id="incentive"
                                                disabled>
                                            @error('incentive')
                                                <span class="error" style="color: red;">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <label for="total_amount" class="col-sm-2 col-form-label">
                                            Total
                                        </label>
                                        <div class="col-sm-4 mb-4">
                                            <input type="text" class="form-control" name="total_amount"
                                                id="total_amount" value="0" readonly>
                                            @error('total_amount')
                                                <span class="error" style="color: red;">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <label for="net_amount" class="col-sm-2 col-form-label">
                                            Net Amount
                                        </label>
                                        <div class="col-sm-4 mb-4">
                                            <input type="text" class="form-control" name="net_amount" id="net_amount"
                                                readonly>
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
                                            <a href="{{ route('job_allocation.job_received.index') }}"
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
                <!-- end page title end breadcrumb -->
            </div>

            <script>
                $('#Direct_Job_Received_Without_Giving').change(function() {
                    if (this.checked) {

                        $('#Incentive_status').prop('disabled', false);
                    } else {

                        $('#Incentive_status').prop('disabled', true);
                    }
                });
            </script>
            <script>
                $(document).ready(function() {
                    var companyNames = $('#employees').find(':selected').data('company-names');
                    var companyTypes = $('#employees').find(':selected').data('company-types');
                    $('#company_names').val(companyNames);
                    $('#company_types').val(companyTypes);
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
                    $('#finishing_product_models').change(function() {
                        var modelId = $(this).val();
                        if (modelId) {
                            $.ajax({
                                url: '/job_allocation/direct_job_received/get-finishing-product-details/' +
                                    modelId,
                                type: 'GET',
                                dataType: 'json',
                                success: function(data) {

                                    $('#products').val(data.product_name);
                                    $('#product_sizes').val(data.product_size);
                                    $('#meters_one_product').val(data.meters_one_product);

                                }
                            });
                        }
                    });
                });
            </script>
            <script>
                $(document).ready(function() {
                    // Initially hide the Amount label and input field
                    $('#amount_label').hide();
                    $('#amount').hide();
                });
            </script>
            <script>
                $(document).ready(function() {
                    $('#useage_meter').on('input', function() {
                        var UseageMeter = $(this).val();
                        var totalMeter = {{ $direct_job_giving->meter }};
                        var balanceMeter = totalMeter - UseageMeter;

                        // Update available_quantity value
                        $('#balance_meter').val(balanceMeter);

                        // Clear available_quantity if complete_quantity is empty
                        if (UseageMeter === '') {
                            $('#balance_meter').val('');
                        }
                    });

                    $('#balance_meter').on('input', function() {
                        var balanceMeter = $(this).val();
                        var totalMeter = {{ $direct_job_giving->meter }};
                        var UseageMeter = totalMeter - balanceMeter;

                        // Update complete_quantity value
                        $('#useage_meter').val(UseageMeter);

                        // Clear complete_quantity if available_quantity is empty
                        if (balanceMeter === '') {
                            $('#UseageMeter').val('');
                        }
                    });
                });
            </script>

            <script>
                $(document).ready(function() {
                    $('#assign_meter').on('input', function() {
                        var balanceMeter = parseInt($('#balance_meter').val(), 10);
                        var assignMeter = parseInt($(this).val(), 10);
                        var errorSpan = $('#assign_meter_error');

                        if (assignMeter > balanceMeter) {
                            errorSpan.text('Assign Meter cannot exceed Balance meter');
                        } else {
                            errorSpan.text('');
                        }
                    });


                    function updateTotal() {
                        var aValue = parseFloat($("#received_quantity").val()) || 0;
                        var bValue = parseFloat($("#incentive").val()) || 0;
                        var cValue = parseFloat($("#deduction").val()) || 0;
                        var dValue = parseFloat($("#conveyance").val()) || 0;
                        var wages = $('#wages_per_quantity').val();

                        var cuttingCharges = parseFloat($("#cutting_charges").val()) || 0;
                        var totalQuantity = $('#total_quantity').val();

                        var total = (aValue * wages) + dValue + bValue + cuttingCharges - cValue;
                        var net = (aValue * wages);
                        var pendingQuantity = totalQuantity - aValue;
                        $("#pending_quantity").val(pendingQuantity); // You can adjust the precision as needed
                        $("#total_amount").val(total.toFixed(2)); // You can adjust the precision as needed
                        $("#net_amount").val(net.toFixed(2)); // You can adjust the precision as needed
                    }


                    $("#received_quantity, #cutting_charges, #incentive, #deduction, #conveyance, #pending_quantity").on(
                        "input",
                        updateTotal);

                    // Initial update
                    updateTotal();


                    function updateMeter() {
                        console.log("inside");
                        var aValue = parseFloat($("#usage_meters").val()) || 0;
                        var bValue = parseFloat($("#wastage_meters").val()) || 0;
                        var totalMeter = parseFloat($("#meter").val()) || 0;;

                        var total = totalMeter - (aValue + bValue);
                        $("#balance_meters").val(total);
                    }


                    $("#usage_meters, #wastage_meters").on("input",
                        updateMeter);

                    // Initial update
                    updateMeter();


                    $('#Incentive_status').change(function() {
                        // console.log("Option changed");
                        var beforeDaysInput = $('#before_days');
                        var incentiveInput = $('#incentive');

                        if ($(this).val() === 'No') {
                            beforeDaysInput.prop('disabled', true);
                            incentiveInput.prop('disabled', true);
                        } else {
                            beforeDaysInput.prop('disabled', false);
                            incentiveInput.prop('disabled', false);
                        }
                    });
                });
            </script>

            @include('links.js.select2.select2')
        @endsection
