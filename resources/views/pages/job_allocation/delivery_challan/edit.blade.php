@extends('layouts.app')
@section('title', 'Edit Order Allocation')
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
                                <li class="breadcrumb-item">Job Allocation</li>
                                <li class="breadcrumb-item"><a
                                        href="{{ route('job_allocation.delivery_challan.index') }}">Order Allocation</a>
                                </li>
                                <li class="breadcrumb-item">Edit</li>
                            </ol>
                        </div>
                        <h4 class="page-title">Edit Order Allocation</h4>
                    </div>
                </div>
            </div>
            <!-- end page title end breadcrumb -->

            <div class="row">


                <div class="col-10">
                    <div class="card m-b-30">
                        <div class="card-body">
                            <div class="m-b-30">
                                <form action="{{ route('job_allocation.delivery_challan.update', $delivery_challans->id) }}"
                                    method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group row">
                   <label for="customer_code" class="col-sm-2 col-form-label">
    Company Type
</label>
<div class="col-sm-4 mb-4">
    <select class="form-control select2" name="company_type_id" id="company_type_id">
        <option value="">Select Company Type</option>
        @foreach ($company_types as $item)
            <option value="{{ $item->id }}" {{ $delivery_challans->company->company_type_id == $item->id ? 'selected' : '' }}>{{ $item->name }}</option>
        @endforeach
    </select>
    @error('company_type_id')
        <span class="error" style="color: red;">{{ $message }}</span>
    @enderror
</div>
<label for="customer_code" class="col-sm-2 col-form-label">
    Company Name
</label>
<div class="col-sm-4 mb-4">
    <select class="form-control select2 w-100" name="company_id" id="company_id">
        <option value="">Select Company</option>
        @foreach ($company as $companyItem)
            <option value="{{ $companyItem->id }}" {{ $delivery_challans->company_id == $companyItem->id ? 'selected' : '' }}>{{ $companyItem->company_name }}</option>
        @endforeach
    </select>
    @error('company_id')
        <span class="error" style="color: red;">{{ $message }}</span>
    @enderror
</div>
<label for="customer_name" class="col-sm-2 col-form-label">Sub Company name</label>
<div class="col-sm-4 mb-4">
    <input class="form-control" type="text" name="sub_company_name" id="sub_company_name" value="{{ $subCompanyName }}">
    @error('dc_date')
    <span class="error" style="color: red;">{{ $message }}</span>
    @enderror
</div>

    <label for="customer_name" class="col-sm-2 col-form-label ">DC Date</label>
                           <div class="col-sm-4 mb-4">
                              <input class="form-control" type="date" name="dc_date" id="dc_date" value="{{$delivery_challans->dc_date}}">
                              @error('dc_date')
                              <span class="error" style="color: red;">{{ $message }}</span>
                              @enderror
                           </div>
                            <label for="customer_name" class="col-sm-2 col-form-label">DC
                           Number</label>
                           <div class="col-sm-4 mb-4">
                              <input class="form-control" type="text" name="dc_number" id="dc_number"value="{{$delivery_challans->dc_no}}"readonly>
                              @error('dc_number')
                              <span class="error" style="color: red;">{{ $message }}</span>
                              @enderror
                           </div>


<label for="customer_code" class="col-sm-2 col-form-label mandatory">Order ID</label>
<div class="col-sm-4 mb-4">
    <select class="form-control select2" name="order_id" id="order_id">
        <option value="">Select Order</option>
            @foreach ($order_nos as $item)
             <option value="{{ $item->id }}" {{ $item->id == $delivery_challans->order_id ? 'selected' : '' }}>{{ $item->customer_order_no }}</option>
        @endforeach
    </select>
    @error('order_id')
        <span class="error" style="color: red;">{{ $message }}</span>
    @enderror
</div>
<label for="customer_code" class="col-sm-2 col-form-label mandatory">Model</label>
<div class="col-sm-4 mb-4">
    <select class="form-control select2" name="product_model" id="product_model">
       <option value="">Select Model</option>
       
                             
    </select>
    @error('product_model')
        <span class="error" style="color: red;">{{ $message }}</span>
    @enderror
</div>


   <label for="order_date" class="col-sm-2 col-form-label">Order Date</label>
<div class="col-sm-4 mb-4">
    <input class="form-control" type="text" name="order_date" id="order_date"  readonly>
    @error('order_date')
        <span class="error" style="color: red;">{{ $message }}</span>
    @enderror
</div>

<label for="order_date" class="col-sm-2 col-form-label ">Product Name</label>
<div class="col-sm-4 mb-4">
    <input class="form-control" type="text" name="product" id="product" readonly >
    @error('product')
        <span class="error" style="color: red;">{{ $message }}</span>
    @enderror
</div>
<label for="order_date" class="col-sm-2 col-form-label ">Raw Material Name</label>
<div class="col-sm-4 mb-4">
    <input class="form-control" type="text" name="raw_material_name" id="raw_material_name" readonly>
    @error('raw_material_name')
        <span class="error" style="color: red;">{{ $message }}</span>
    @enderror
</div>
<label for="order_date" class="col-sm-2 col-form-label">Raw Material Type</label>
<div class="col-sm-4 mb-4">
    <input class="form-control" type="text" name="raw_material_type" id="raw_material_type" readonly>
    @error('raw_material_type')
        <span class="error" style="color: red;">{{ $message }}</span>
    @enderror
</div>

<label for="customer_code" class="col-sm-2 col-form-label">Product Size</label>
<div class="col-sm-4 mb-4">
    <input class="form-control" type="text" name="product_size_id" id="product_size_id" readonly>
    @error('product_size_id')
        <span class="error" style="color: red;">{{ $message }}</span>
    @enderror
</div>
<label for="customer_code" class="col-sm-2 col-form-label">Product Color</label>
<div class="col-sm-4 mb-4">
  <input class="form-control" type="text" name="product_color_id" id="product_color_id" readonly>
    @error('product_color_id')
        <span class="error" style="color: red;">{{ $message }}</span>
    @enderror
</div>
<label for="order_date" class="col-sm-2 col-form-label">Quantity</label>
<div class="col-sm-4 mb-4">
    <input class="form-control" type="text" name="quantity" id="quantity"value="{{$delivery_challans->quantity}}">
    @error('quantity')
        <span class="error" style="color: red;">{{ $message }}</span>
    @enderror
</div>
<label for="order_date" class="col-sm-2 col-form-label">Available Quantity</label>
                                        <div class="col-sm-4 mb-4">
                                            <input class="form-control" type="text" name="available_quantity"
                                                id="available_quantity" readonly>
                                            @error('order_date')
                                                <span class="error" style="color: red;">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <label for="order_date" class="col-sm-2 col-form-label">Weight</label>
                                        <div class="col-sm-4 mb-4">
                                            <input class="form-control" type="text" name="weight" id="weight" value="{{$delivery_challans->weight}}">
                                            <input class="form-control" type="hidden" name="weightPerItem"
                                                id="weightPerItem">
                                            <input class="form-control" type="hidden" name="avaWeight" id="avaWeight">
                                            <span id="weight_error" class="error" style="color: red;"></span>
                                            @error('weight')
                                                <span class="error" style="color: red;">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <label for="order_date" class="col-sm-1 col-form-label">Excess</label>
                                        <div class="col-sm-2 mb-4">
                                            <input class="form-control" type="text" name="excess_weight"
                                                id="excess_weight" value="{{$delivery_challans->excess}}" readonly>
                                            @error('order_date')
                                                <span class="error" style="color: red;">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <label for="order_date" class="col-sm-1 col-form-label">Shortage</label>
                                        <div class="col-sm-2 mb-4">
                                            <input class="form-control" type="text" name="shortage_weight"
                                                id="shortage_weight"value="{{$delivery_challans->shortage}}" readonly>
                                            @error('order_date')
                                                <span class="error" style="color: red;">{{ $message }}</span>
                                            @enderror
                                        </div>
</div>

                                    <div class="form-group">
                                        <div class="d-flex justify-content-evenly">
                                            <button type="submit" class="btn btn-primary waves-effect waves-light">
                                                Submit
                                            </button>
                                            
                                            <a href="{{ route('job_allocation.delivery_challan.index') }}"
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


                <div class="col-2">
                    <div class="card m-b-30">
                        <div class="card-body">
                            <div class="m-b-30">
                                <form action="{{ route('job_allocation.delivery_challan.store') }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group row">

                                        <label for="order_date" class="col-form-label">Total Quantity</label>
                                        <div class="mb-4">
                                            <input class="form-control" type="text" name="total_quantity"
                                                id="total_quantity" readonly>
                                            @error('total_quantity')
                                                <span class="error" style="color: red;">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <label for="order_date" class="col-form-label">Total Weight</label>
                                        <div class="mb-4">
                                            <input class="form-control" type="text" name="total_weight"
                                                id="total_weight" readonly>
                                            @error('total_weight')
                                                <span class="error" style="color: red;">{{ $message }}</span>
                                            @enderror
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
        $('#company_type_id').on('change', function() {
            var companyTypeId = $(this).val();
            var deliveryChallanId = {{ $delivery_challans->id }};
            $.ajax({
                url: '/get-company-by-type/' + companyTypeId + '/' + deliveryChallanId,
                type: 'GET',
                success: function(company) {
                    $('#company_id').empty().append('<option value="">Select Company</option>');
                    $('#company_id').append('<option value="' + company.id + '" selected>' + company.company_name + '</option>');
                    
                }
            });
        });
   
        // Trigger the change event initially if a company type is already selected
        var selectedCompanyTypeId = $('#company_type_id').val();
        if (selectedCompanyTypeId) {
            $('#company_type_id').trigger('change');
        }
    });
</script>

<script>
    $(document).ready(function() {
        $('#company_type_id').on('change', function() {
            var companyTypeId = $(this).val();
            if (companyTypeId !== '') {
                $('#company_id').prop('disabled', false);
            } else {
                $('#company_id').prop('disabled', true);
            }
        });
    });
</script>


<script>
    $(document).ready(function () {
        // Initially disable the product_model dropdown
        // $('#product_model').prop('disabled', true);

        $('#order_id').change(function () {
            var orderId = $(this).val();
            if (orderId) {
                $.ajax({
                    type: "GET",
                    url: "{{ route('job_allocation.delivery_challan.getModelsByOrderId') }}",
                    data: {order_id: orderId},
                    success: function (response) {
                        var options = '<option value="">Select Model</option>';
                        $.each(response, function (key, value) {
                            options += '<option value="' + value.id + '">' + value.model_name + '-' + value.model_code + '</option>';
                        });
                        $('#product_model').html(options);
                        // Enable the product_model dropdown
                        $('#product_model').prop('disabled', false);

                        // Automatically select the first product model
                        $('#product_model').val(response[0].id).change();
                    }
                });
            } else {
                $('#product_model').html('<option value="">Select Model</option>');
                // Disable the product_model dropdown if no order_id is selected
                $('#product_model').prop('disabled', true);
            }
        });
        $('#order_id').trigger('change');
    });
</script>

<script>
    $(document).ready(function() {
        $('#product_model').change(function() {
            var productModelId = $(this).val();
            if (productModelId) {
                $.ajax({
                    url: '/job_allocation/delivery_challan/get-product-details', // Update the URL to your route
                    type: 'GET',
                    data: { product_model: productModelId },
                    dataType: 'json',
                    success: function(response) {
                        $('#product').val(response.product);
                        $('#raw_material_name').val(response.raw_material_name);
                        $('#raw_material_type').val(response.raw_material_type);
                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                    }
                });
            } else {
                $('#product').val('');
                $('#raw_material_name').val('');
                $('#raw_material_type').val('');
            }
        });
    });
</script>
<script>
    $(document).ready(function() {
    $('#product_model').change(function() {
        var productModelId = $(this).val();
        if (productModelId) {
            $.ajax({
                url: '/job_allocation/delivery_challan/get-order-details', // Update the URL to your route
                type: 'GET',
                data: { product_model: productModelId },
                dataType: 'json',
                success: function(response) {
                    $('#order_date').val(response.order_date);
                    $('#total_quantity').val(response.total_quantity);
                    $('#available_quantity').val(response.available_quantity);
                },
                error: function(xhr, status, error) {
                    console.error(error);
                }
            });
        } else {
            $('#order_date').val('');
            $('#total_quantity').val('');
            $('#available_quantity').val('');
        }
    });
});


</script>


<script>
        $(document).ready(function() {
            $('#product_model').change(function() {
                var productModelId = $(this).val();
                 var orderId = $('#order_id').val();
                if (productModelId) {
                    $.ajax({
                        url: '/job_allocation/delivery_challan/get-order-details', // Update the URL to your route
                        type: 'GET',
                        data: {
                            product_model: productModelId,
                             order_id: orderId
                        },
                        dataType: 'json',
                        success: function(response) {
                            $('#order_date').val(response.order_date);
                            $('#total_quantity').val(response.total_quantity);
                            $('#available_quantity').val(response.available_quantity);
                            $('#total_weight').val(response.total_r_w_weight);
                            $('#weightPerItem').val(response.weight_per_item);
                            $('#avaWeight').val(response.available_weight);
                            $('#product_color_id').val(response.product_color_id);
                             $('#product_size_id').val(response.product_size_id);

                             

                        },
                        error: function(xhr, status, error) {
                            console.error(error);
                        }
                    });
                } else {
                    $('#order_date').val('');
                    $('#total_quantity').val('');
                    $('#available_quantity').val('');
                     $('#product_color_id').val('');
                }
            });
        });

        $('#weight').on('input', function() {
            var weight = parseFloat($(this).val());
                  if (isNaN(weight)) {
        $('#excess_weight').val('0.0');
        $('#shortage_weight').val('0.0');
        return; 
    }
            var weightPerQuantity = parseFloat($('#weightPerItem').val());
            var totalQuantity = parseFloat($('#total_quantity').val());
            var totalWeight = parseFloat($('#total_weight').val());
            var givenQuantity = parseFloat($('#quantity').val());
            var avaWeight = parseFloat($('#avaWeight').val());

            var givenWeight = givenQuantity * weightPerQuantity;

            // Calculate excess and shortage
            var excess = weight - givenWeight;
            var shortage = 0;

            if (excess < 0) {
                shortage = Math.abs(excess);
                excess = 0;
            }
            $('#excess_weight').val(excess.toFixed(1));
            $('#shortage_weight').val(shortage.toFixed(1));

            // Output the results
            console.log('Excess:', excess.toFixed(1));
            console.log('Shortage:', shortage.toFixed(1));
            // Perform any actions you want here
        });
    </script>


    @include('links.js.select2.select2')
@endsection
