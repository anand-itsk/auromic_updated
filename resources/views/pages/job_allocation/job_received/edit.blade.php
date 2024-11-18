@extends('layouts.app')
@section('title', 'Edit Job Received')
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
                                        href="{{ route('job_allocation.delivery_challan.index') }}">Job Allocation</a>
                                </li>
                                <li class="breadcrumb-item">Edit</li>
                            </ol>
                        </div>
                        <h4 class="page-title">Edit Job Received</h4>
                    </div>
                </div>
            </div>
            <!-- end page title end breadcrumb -->
            <div class="row">
                <div class="col-12">
                    <div class="card m-b-30">
                        <div class="card-body">
                            <div class="m-b-30">
                                <form action="{{ route('job_allocation.job_received.store') }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="job_giving_id" value="{{ $id }}">
                                    <div class="form-group row">
                                        <label for="customer_code" class="col-sm-2 col-form-label">
                                            Employee Name
                                        </label>
                                        <div class="col-sm-4 mb-4">
                                            <input type="text" class="form-control" name="company_type" id="company_type"
                                                readonly value="{{ $Job_Giving->employee->employee_name }}">
                                            @error('employee_id')
                                                <span class="error" style="color: red;">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <label for="customer_code" class="col-sm-2 col-form-label">
                                            Employee Code
                                        </label>
                                        <div class="col-sm-4 mb-4">
                                            <input type="text" class="form-control" name="company_type" id="company_type"
                                                readonly value="{{ $Job_Giving->employee->employee_code }}">
                                            @error('employee_id')
                                                <span class="error" style="color: red;">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <label for="customer_code" class="col-sm-2 col-form-label">
                                            Customer Name
                                        </label>
                                        <div class="col-sm-4 mb-4">
                                            <input type="text" class="form-control" name="company_type" id="company_type"
                                                readonly value="{{ $Job_Giving->order_details->customer->customer_name }}">
                                            @error('employee_id')
                                                <span class="error" style="color: red;">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <label for="customer_code" class="col-sm-2 col-form-label">
                                            Model Name
                                        </label>
                                        <div class="col-sm-4 mb-4">
                                            <input type="text" class="form-control" name="company_type" id="company_type"
                                                readonly value="{{ $Job_Giving->product_model->model_name }}">
                                            @error('employee_id')
                                                <span class="error" style="color: red;">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <label for="customer_code" class="col-sm-2 col-form-label">
                                            Model Code
                                        </label>
                                        <div class="col-sm-4 mb-4">
                                            <input type="text" class="form-control" name="company_type" id="company_type"
                                                readonly value="{{ $Job_Giving->product_model->model_code }}">
                                            @error('employee_id')
                                                <span class="error" style="color: red;">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <label for="customer_code" class="col-sm-2 col-form-label">
                                            Product
                                        </label>
                                        <div class="col-sm-4 mb-4">
                                            <input type="text" class="form-control" name="company_type" id="company_type"
                                                readonly value="{{ $Job_Giving->product_model->product->name }}">
                                            @error('employee_id')
                                                <span class="error" style="color: red;">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <label for="customer_code" class="col-sm-2 col-form-label">
                                            R.M Type
                                        </label>
                                        <div class="col-sm-4 mb-4">
                                            <input type="text" class="form-control" name="company_type" id="company_type"
                                                readonly
                                                value="{{ $Job_Giving->product_model->rawMaterial->rawMaterialType->name }}">
                                            @error('employee_id')
                                                <span class="error" style="color: red;">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <label for="customer_code" class="col-sm-2 col-form-label">
                                            R.M Name
                                        </label>
                                        <div class="col-sm-4 mb-4">
                                            <input type="text" class="form-control" name="company_type"
                                                id="company_type" readonly
                                                value="{{ $Job_Giving->product_model->rawMaterial->name }}">
                                            @error('employee_id')
                                                <span class="error" style="color: red;">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <label for="customer_code" class="col-sm-2 col-form-label">
                                            Wages of 1 Product
                                        </label>
                                        <div class="col-sm-4 mb-4">
                                            <input type="text" class="form-control" name="wages" id="wages"
                                                readonly value="{{ $Job_Giving->product_model->wages_product }}">
                                            @error('wages')
                                                <span class="error" style="color: red;">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <label for="total_quantity" class="col-sm-2 col-form-label">
                                            Total Quantity
                                        </label>
                                        <div class="col-sm-4 mb-4">
                                            <input type="text" class="form-control" name="total_quantity"
                                                id="total_quantity" readonly value="{{ $Job_Giving->quantity }}">
                                            @error('employee_id')
                                                <span class="error" style="color: red;">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <label for="total_weight" class="col-sm-2 col-form-label">
                                            Total Weight
                                        </label>
                                        <div class="col-sm-4 mb-4">
                                            <input type="text" class="form-control" name="total_weight"
                                                id="total_weight" readonly value="{{ $Job_Giving->weight }}">
                                            @error('employee_id')
                                                <span class="error" style="color: red;">{{ $message }}</span>
                                            @enderror
                                        </div>


                                        <label for="customer_code" class="col-sm-2 col-form-label">
                                            Product Size
                                        </label>
                                        <div class="col-sm-4 mb-4">
                                            <input type="text" class="form-control" name="company_type"
                                                id="company_type" readonly
                                                value="{{ $Job_Giving->product_model->productSize->name }}">
                                            @error('employee_id')
                                                <span class="error" style="color: red;">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <label for="customer_code" class="col-sm-2 col-form-label">
                                            Product Color
                                        </label>
                                        <div class="col-sm-4 mb-4">
                                            <input type="text" class="form-control" name="company_type"
                                                id="company_type" readonly
                                                value="{{ $Job_Giving->order_details->productColor->name ?? '' }}">
                                            @error('employee_id')
                                                <span class="error" style="color: red;">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <label for="customer_code" class="col-sm-2 col-form-label">
                                            Received Date
                                        </label>
                                        <div class="col-sm-4 mb-4">
                                            <input type="text" class="form-control" name="company_type"
                                                id="company_type" readonly
                                                value="{{ $jobReceivedData->receving_date ?? '' }}">
                                            @error('employee_id')
                                                <span class="error" style="color: red;">{{ $message }}</span>
                                            @enderror
                                        </div>


                                        <label for="customer_code" class="col-sm-2 col-form-label mandatory">
                                            Receiving Date
                                        </label>
                                        <div class="col-sm-4 mb-4">
                                            <input class="form-control" type="date" name="receiving_date"
                                                id="receiving_date" required>
                                            @error('receiving_date')
                                                <span class="error" style="color: red;">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <label for="customer_code" class="col-sm-2 col-form-label">
                                            Current Weight
                                        </label>
                                        <div class="col-sm-4 mb-4">
                                            <input type="text" class="form-control" name="current_weight"
                                                id="current_weight">
                                            @error('employee_id')
                                                <span class="error" style="color: red;">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <label for="customer_code" class="col-sm-2 col-form-label">
                                            Balance Weight
                                        </label>
                                        <div class="col-sm-4 mb-4">
                                            <input type="text" class="form-control" name="balance_weight"
                                                id="balance_weight" readonly>
                                            @error('balance_weight')
                                                <span class="error" style="color: red;">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <label for="customer_code" class="col-sm-2 col-form-label">
                                            Balance Quantity
                                        </label>
                                        <div class="col-sm-4 mb-4">
                                            <input type="text" class="form-control" name="balance_quantity"
                                                id="balance_quantity" readonly
                                                value="{{ $Job_Giving->pending_quantity ?? '' }}">
                                            @error('balance_quantity')
                                                <span class="error" style="color: red;">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <label for="customer_code" class="col-sm-2 col-form-label">
                                            Received Quantity
                                        </label>
                                        <div class="col-sm-4 mb-4">
                                            <input type="text" class="form-control" name="received_quantity"
                                                id="received_quantity">
                                            @error('employee_id')
                                                <span class="error" style="color: red;">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <label for="customer_code" class="col-sm-2 col-form-label">
                                            Pending Quantity
                                        </label>
                                        <div class="col-sm-4 mb-4">
                                            <input type="text" class="form-control" name="pending_quantity"
                                                id="pending_quantity" readonly>
                                            @error('pending_quantity')
                                                <span class="error" style="color: red;">{{ $message }}</span>
                                            @enderror
                                        </div>


                                        <label for="customer_code" class="col-sm-2 col-form-label">
                                            Status
                                        </label>

                                        <div class="col-sm-4 mb-4">
                                            <select class="form-control select2" name="received_status"
                                                id="received_status">

                                                <option value="Incomplete"
                                                    @if ($Job_Giving->status == 'Incomplete') selected @endif>Incomplete</option>
                                                <option value="Complete" @if ($Job_Giving->status == 'Complete') selected @endif>
                                                    Complete</option>
                                                <option value="Pending" @if ($Job_Giving->status == 'Pending') selected @endif>
                                                    Pending</option>
                                                <option value="cancelled"
                                                    @if ($Job_Giving->status == 'Cancelled') selected @endif>
                                                    Cancelled</option>
                                            </select>
                                            @error('employee_id')
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
            </div>
        </div>
    </div>
    @include('links.js.select2.select2')
    <script>
        $(document).ready(function() {

            $('#with_dc').change(function() {
                if (this.checked) {
                    $('#dc_number').prop('disabled', false);
                } else {
                    $('#dc_number').prop('disabled', true);
                }
            });


            // $('#received_quantity').on('input', function() {

            //     var receivedQuantity = $(this).val();
            //     var totalQuantity = $('#total_quantity').val();

            //     var pendingQuantity = totalQuantity - receivedQuantity;

            //     $('#pending_quantity').val(pendingQuantity);

            //     var wages = $('#wages').val();

            //     var totalAmount = receivedQuantity * wages;

            //     $('#total_amount').val(totalAmount);



            // });


            $('#current_weight').on('input', function() {

                var receivedWeight = $(this).val();
                var totalWeight = $('#total_weight').val();

                var pendingWeight = totalWeight - receivedWeight;

                $('#balance_weight').val(pendingWeight);
            });

            // $('#conveyance').on('input', function(e) {
            //     if (e.originalEvent.inputType === 'deleteContentBackward') {
            //         // Backspace was pressed
            //         var conveyance = parseInt($(this).val());
            //         var totalAmount = parseInt($('#total_amount').val());

            //         var currentTotal = totalAmount - conveyance;

            //         $('#total_amount').val(currentTotal);
            //     } else {
            //         // Inputting new value
            //         var conveyance = parseInt($(this).val());
            //         var totalAmount = parseInt($('#total_amount').val());

            //         var currentTotal = totalAmount + conveyance;

            //         $('#total_amount').val(currentTotal);
            //     }
            // });



            function updateTotal() {
                var aValue = parseFloat($("#received_quantity").val()) || 0;
                var bValue = parseFloat($("#incentive").val()) || 0;
                var cValue = parseFloat($("#deduction").val()) || 0;
                var dValue = parseFloat($("#conveyance").val()) || 0;
                var wages = $('#wages').val();
                var totalQuantity = $('#total_quantity').val();
                var balanceQuantity = $('#balance_quantity').val();

                var total = (aValue * wages) + dValue + bValue - cValue;
                var net = (aValue * wages);

                if (balanceQuantity !== "") { // Check if balanceQuantity is not empty
                    pendingQuantity = balanceQuantity - aValue;
                } else {
                    pendingQuantity = totalQuantity - aValue;
                }







                $("#pending_quantity").val(pendingQuantity); // You can adjust the precision as needed
                $("#total_amount").val(total.toFixed(2)); // You can adjust the precision as needed
                $("#net_amount").val(net.toFixed(2)); // You can adjust the precision as needed
            }


            $("#received_quantity, #incentive, #deduction, #conveyance, #pending_quantity").on("input",
                updateTotal);

            // Initial update
            updateTotal();

        });
    </script>
    <script>
        $(document).ready(function() {
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

@endsection
