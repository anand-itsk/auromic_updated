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
                     <li class="breadcrumb-item">Job Allocation</li>
                     <li class="breadcrumb-item"><a
                        href="{{ route('job_allocation.delivery_challan.index') }}">Delivery Challan</a>
                     </li>
                     <li class="breadcrumb-item">Create</li>
                  </ol>
               </div>
               <h4 class="page-title">Create Delivery Challan</h4>
            </div>
         </div>
      </div>
      <!-- end page title end breadcrumb -->
      <div class="row">
         <div class="col-12">
            <div class="card m-b-30">
               <div class="card-body">
                  <div class="m-b-30">
                     <form action="{{ route('job_allocation.delivery_challan.store') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="form-group row">
                           <label for="customer_code" class="col-sm-2 col-form-label mandatory">
                           Company Type
                           </label>
                           <div class="col-sm-4 mb-4">
                              <select class="form-control select2" name="company_type_id" id="company_type_id">
                                 <option value="">Select Company Type</option>
                                 @foreach ($company_types as $item)
                                 <option value="{{ $item->id }}">{{ $item->name }}</option>
                                 @endforeach
                              </select>
                              @error('company_type_id')
                              <span class="error" style="color: red;">{{ $message }}</span>
                              @enderror
                           </div>
                           <label for="customer_code" class="col-sm-2 col-form-label mandatory">
                           Company Name
                           </label>
                           <div class="col-sm-4 mb-4">
                              <select class="form-control select2 w-100" name="company_id" id="company_id" disabled>
                                 <option value="">Select Company</option>
                                 @foreach ($company as $companyItem)
                                 <option value="{{ $companyItem->id }}">{{ $companyItem->company_name }}</option>
                                 @endforeach
                              </select>
                              @error('company_id')
                              <span class="error" style="color: red;">{{ $message }}</span>
                              @enderror
                           </div>
                           <label for="customer_name" class="col-sm-2 col-form-label mandatory">DC Date</label>
                           <div class="col-sm-4 mb-4">
                              <input class="form-control" type="date" name="dc_date" id="dc_date">
                              @error('dc_date')
                              <span class="error" style="color: red;">{{ $message }}</span>
                              @enderror
                           </div>
                            <label for="customer_name" class="col-sm-2 col-form-label mandatory">DC
                           Number</label>
                           <div class="col-sm-4 mb-4">
                              <input class="form-control" type="text" name="dc_number" id="dc_number">
                              @error('dc_number')
                              <span class="error" style="color: red;">{{ $message }}</span>
                              @enderror
                           </div>
<label for="customer_code" class="col-sm-2 col-form-label mandatory">Customer</label>
<div class="col-sm-4 mb-4">
    <select class="form-control select2" name="customer_id" id="customer_id">
        <option value="">Select Customer</option>
        @foreach ($customer as $item)
            <option value="{{ $item->id }}">{{ $item->customer_name}}/{{ $item->customer_code}}</option>
        @endforeach
    </select>
    @error('customer_id')
        <span class="error" style="color: red;">{{ $message }}</span>
    @enderror
</div>

<label for="customer_code" class="col-sm-2 col-form-label mandatory">Order ID</label>
<div class="col-sm-4 mb-4">
    <select class="form-control select2" name="order_id" id="order_id" disabled>
        <option value="">Select Order</option>
            @foreach ($order_details as $item)
            <option value="{{ $item->id }}">{{ $item->order_no}}</option>
        @endforeach
    </select>
    @error('order_id')
        <span class="error" style="color: red;">{{ $message }}</span>
    @enderror
</div>

   <label for="order_date" class="col-sm-2 col-form-label">Order Date</label>
<div class="col-sm-4 mb-4">
    <input class="form-control" type="text" name="order_date" id="order_date" readonly>
    @error('order_date')
        <span class="error" style="color: red;">{{ $message }}</span>
    @enderror
</div>

<label for="customer_code" class="col-sm-2 col-form-label mandatory">Model</label>
<div class="col-sm-4 mb-4">
    <select class="form-control select2" name="product_model" id="product_model">
       <option value="">Select Model</option>
                              @foreach($productModels as $productModel)
                              <option value="{{ $productModel->id }}" >{{ $productModel->model_name }}-{{ $productModel->model_code }}</option>
                              @endforeach
    </select>
    @error('product_model')
        <span class="error" style="color: red;">{{ $message }}</span>
    @enderror
</div>

<label for="order_date" class="col-sm-2 col-form-label ">Product Name</label>
<div class="col-sm-4 mb-4">
    <input class="form-control" type="text" name="product" id="product" readonly>
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
    <select class="form-control select2" name="product_size_id" id="product_size_id">
        <option value="">Select Product Size</option>
        @foreach ($product_size as $item)
            <option value="{{ $item->id }}">{{ $item->name}}</option>
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
            <option value="{{ $item->id }}">{{ $item->name}}</option>
        @endforeach
    </select>
    @error('product_color_id')
        <span class="error" style="color: red;">{{ $message }}</span>
    @enderror
</div>
<label for="order_date" class="col-sm-2 col-form-label">Quantity</label>
<div class="col-sm-4 mb-4">
    <input class="form-control" type="text" name="quantity" id="quantity">
    @error('quantity')
        <span class="error" style="color: red;">{{ $message }}</span>
    @enderror
</div>
</div>
                        <div class="form-group">
                           <div class="d-flex justify-content-evenly">
                              <button type="submit" class="btn btn-primary waves-effect waves-light">
                              Submit
                              </button>
                              <a href="{{ route('job_allocation.delivery_challan.create') }}"
                                 class="btn btn-warning waves-effect waves-light">
                              Reset
                              </a>
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
      </div>
   </div>
</div>
<script>
    $(document).ready(function() {
        $('#company_type_id').on('change', function() {
            var companyTypeId = $(this).val();
            $.ajax({
                url: '/get-companies/' + companyTypeId,
                type: 'GET',
                success: function(companies) {
                    $('#company_id').empty().append('<option value="">Select Company</option>');
                    $.each(companies, function(index, company) {
                        var authorisedPersonName = company.authorised_person ? company.authorised_person.name : 'N/A';
                        $('#company_id').append('<option value="' + company.id + '">' + company.company_name + ' - ' + authorisedPersonName + '</option>');
                    });
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
            var customerId = $(this).val();
            if (customerId !== '') {
                $('#company_id').prop('disabled', false);
            } else {
                $('#company_id').prop('disabled', true);
            }
        });
    });
</script>
<script>
    $(document).ready(function() {
        $('#customer_id').on('change', function() {
            var customerId = $(this).val();
            $.ajax({
                url: '/job_allocation/delivery_challan/get-orders/' + customerId,
                type: 'GET',
                success: function(orders) {
                    $('#order_id').empty().append('<option value="">Select Order</option>');
                    $.each(orders, function(index, order) {
                        $('#order_id').append('<option value="' + order.id + '" data-order-date="' + order.order_date + '">' + order.order_no + '</option>');
                    });
                    $('#order_id').prop('disabled', false); // Enable the order dropdown
                },
                error: function(xhr, status, error) {
                    console.error(error);
                    // Handle error
                }
            });
        });

        $('#order_id').on('change', function() {
            var orderDate = $(this).find(':selected').data('order-date');
            $('#order_date').val(orderDate);
        });

        // Trigger the change event initially if an order is already selected
        var selectedOrderId = $('#order_id').val();
        if (selectedOrderId) {
            $('#order_id').trigger('change');
        }
    });
</script>



<script>
    $(document).ready(function() {
        $('#customer_id').on('change', function() {
            var customerId = $(this).val();
            if (customerId !== '') {
                $('#order_id').prop('disabled', false);
            } else {
                $('#order_id').prop('disabled', true);
            }
        });
    });
</script>
<script>
    $(document).ready(function() {
        $('#product_model').change(function() {
            var modelId = $(this).val();
            if (modelId) {
                $.ajax({
                    url: '/job_allocation/delivery_challan/get-model-details/' + modelId,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        $('#product').val(data.product_name);
                        $('#raw_material_name').val(data.raw_material_name);
                        $('#raw_material_type').val(data.raw_material_type);
                    }
                });
            }
        });
    });
</script>
@include('links.js.select2.select2')
@endsection