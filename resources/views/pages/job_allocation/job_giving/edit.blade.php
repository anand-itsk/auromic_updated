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
                        href="{{ route('job_allocation.delivery_challan.index') }}">Job Allocation</a>
                     </li>
                     <li class="breadcrumb-item">Create</li>
                  </ol>
               </div>
               <h4 class="page-title">Edit Job Giving</h4>
            </div>
         </div>
      </div>
      <!-- end page title end breadcrumb -->
      <div class="row">
         <div class="col-10">
            <div class="card m-b-30">
               <div class="card-body">
                  <div class="m-b-30">
                     <form action="{{ route('job_allocation.job_giving.update', $JobGiving->id) }}"
                        method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group row">
                            <label for="employee_id" class="col-sm-2 col-form-label ">
                           Employee Name
                           </label>
                           <div class="col-sm-4 mb-4">
                              <select class="form-control select2" name="employee_id" id="employee_id">
    @foreach ($employee as $item)
        <option value="{{ $item->id }}" 
            data-company-name="{{ $item->company->company_name }}" 
            data-company-type="{{ $item->company->companyType->name }}"
            {{ $item->id == $JobGiving->employee_id ? 'selected' : '' }}>
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
                              <input type="text" class="form-control" name="company_type" id="company_type" readonly >
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
                          <label for="customer_code" class="col-sm-2 col-form-label mandatory">Dc
                                            Number</label>
                                        <div class="col-sm-4 mb-4">
                                            <select class="form-control select2" name="dc_number" id="dc_number">
        <option value="">Select DC</option>
        @foreach ($delivery_challan as $item)
            <option value="{{ $item->id }}" {{ $item->id == $JobGiving->dc_id ? 'selected' : '' }}>
                {{ $item->dc_no }} / {{ $item->orderDetails->orderNo->customer_order_no }} /
                {{ $item->orderDetails->productModel->model_name }} /
                {{ $item->orderDetails->productModel->model_code }}
            </option>
        @endforeach
    </select>
                                            @error('order_id')
                                                <span class="error" style="color: red;">{{ $message }}</span>
                                            @enderror
                                        </div>

                           <label for="customer_code" class="col-sm-2 col-form-label ">Order
                           Date</label>
                           <div class="col-sm-4 mb-4">
                              <input type="text" class="form-control" name="order_date" id="order_date" readonly value="{{ optional($JobGiving->order_details)->order_date }}">
                              @error('order_date')
                              <span class="error" style="color: red;">{{ $message }}</span>
                              @enderror
                           </div>
                           <label for="customer_code" class="col-sm-2 col-form-label ">Customer Name</label>
                           <div class="col-sm-4 mb-4">
                              <input type="text" class="form-control" name="customer_name" id="customer_name" readonly value="{{ optional(optional($JobGiving->order_details)->customer)->customer_name }}">
                              @error('customer_name')
                              <span class="error" style="color: red;">{{ $message }}</span>
                              @enderror
                           </div>
                           <label for="customer_code" class="col-sm-2 col-form-label ">Model</label>
                           <div class="col-sm-4 mb-4">
                            <input class="form-control" type="text" name="model_name" id="model_name" readonly value="{{ optional($JobGiving->product_model)->model_name }}" >
                              @error('product_model')
                              <span class="error" style="color: red;">{{ $message }}</span>
                              @enderror
                           </div>
                           <label for="order_date" class="col-sm-2 col-form-label ">Product Name</label>
                           <div class="col-sm-4 mb-4">
                              <input class="form-control" type="text" name="product_name" id="product_name" readonly value="{{ optional(optional($JobGiving->product_model)->product)->name }}">
                              @error('product_id')
                              <span class="error" style="color: red;">{{ $message }}</span>
                              @enderror
                           </div>
                           <label for="order_date" class="col-sm-2 col-form-label ">Raw Material Name</label>
                           <div class="col-sm-4 mb-4">
                              <input class="form-control" type="text" name="raw_material_name" id="raw_material_name" readonly value="{{ optional(optional($JobGiving->product_model)->rawMaterial)->name }}">
                              @error('raw_material')
                              <span class="error" style="color: red;">{{ $message }}</span>
                              @enderror
                           </div>
                           <label for="order_date" class="col-sm-2 col-form-label">Raw Material Type</label>
                           <div class="col-sm-4 mb-4">
                              <input class="form-control" type="text" name="raw_material_type" id="raw_material_type" readonly value="{{ optional(optional($JobGiving->product_model)->rawMaterial->rawMaterialType)->name }}">
                              @error('raw_material_type')
                              <span class="error" style="color: red;">{{ $message }}</span>
                              @enderror
                           </div>
                           <!-- <label for="order_date" class="col-sm-2 col-form-label">date</label>
                           <div class="col-sm-4 mb-4">
                              <input class="form-control" type="date" name="date" id="date" >
                              @error('date')
                              <span class="error" style="color: red;">{{ $message }}</span>
                              @enderror
                           </div> -->
                           <label for="order_date" class="col-sm-2 col-form-label">Quantity</label>
                           <div class="col-sm-4 mb-4">
                              <input class="form-control" type="text" name="quantity" id="quantity" value="{{$JobGiving->quantity}}">
                              @error('quantity')
                              <span class="error" style="color: red;">{{ $message }}</span>
                              @enderror
                           </div>
                     <label for="order_date" class="col-sm-2 col-form-label">Available Quantity</label>
                                        <div class="col-sm-4 mb-4">
                                            <input class="form-control" type="text" name="available_quantity"
                                                id="available_quantity" readonly value="{{ optional($JobGiving->deliveryChellan)->available_quantity}}">
                                            @error('order_date')
                                                <span class="error" style="color: red;">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <label for="order_date" class="col-sm-2 col-form-label">Weight</label>
                                        <div class="col-sm-4 mb-4">
                                            <input class="form-control" type="text" name="weight" id="weight" value="{{$JobGiving->weight}}">
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
                                                id="excess_weight" readonly value="{{$JobGiving->excess}}">
                                            @error('order_date')
                                                <span class="error" style="color: red;">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <label for="order_date" class="col-sm-1 col-form-label">Shortage</label>
                                        <div class="col-sm-2 mb-4">
                                            <input class="form-control" type="text" name="shortage_weight"
                                                id="shortage_weight" readonly value="{{$JobGiving->shortage}}">
                                            @error('order_date')
                                                <span class="error" style="color: red;">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <label for="deadline_days" class="col-sm-2 col-form-label">Deadline (Days)</label>
                                        <div class="col-sm-4 mb-4">
                                            <input class="form-control" type="text" name="deadline_days"
                                                id="deadline_days" value="{{$JobGiving->days}}">
                                            <span id="weight_error" class="error" style="color: red;"></span>
                                            @error('deadline_days')
                                                <span class="error" style="color: red;">{{ $message }}</span>
                                            @enderror
                                        </div>
                        
                           <label for="customer_code" class="col-sm-2 col-form-label ">Status</label>
                           <div class="col-sm-4 mb-4">
                              <select class="form-control select2" name="status" id="status">
                              <option value="Incomplete"
                              @if ($JobGiving->status == 'Incomplete') selected @endif>Incomplete</option>
                              <option value="Complete" @if ($JobGiving->status == 'Complete') selected @endif>
                              Complete</option>
                              <option value="Pending" @if ($JobGiving->status == 'Pending') selected @endif>
                              Pending</option>
                                  <option value="cancelled" @if ($JobGiving->status == 'Cancelled') selected @endif>
                              Cancelled</option>
                              </select>
                              @error('status')
                              <span class="error" style="color: red;">{{ $message }}</span>
                              @enderror
                           </div>
                        </div>
                        <div class="form-group">
                           <div class="d-flex justify-content-evenly">
                              <button type="submit" class="btn btn-primary waves-effect waves-light">
                              Submit
                              </button>
                             
                              <a href="{{ route('job_allocation.job_giving.index') }}"
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
                                                id="total_quantity" readonly value="{{ optional($JobGiving->deliveryChellan)->quantity }}">
                                            @error('total_quantity')
                                                <span class="error" style="color: red;">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <label for="order_date" class="col-form-label">Total Weight</label>
                                        <div class="mb-4">
                                            <input class="form-control" type="text" name="total_weight"
                                                id="total_weight" readonly value="{{ optional($JobGiving->deliveryChellan)->weight }}">
                                            @error('total_weight')
                                                <span class="error" style="color: red;">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <label for="order_date" class="col-form-label">Order Delivery Date</label>
                                        <div class="mb-4">
                                            <input class="form-control" type="text" name="deliveryDate"
                                                id="deliveryDate" readonly value="{{ optional($JobGiving->order_details)->delivery_date }}">
                                            @error('deliveryDate')
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
@include('links.js.select2.select2')



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
            $('#order_id').on('change', function() {
                var orderId = $(this).val();
                if (orderId) {
                    $.ajax({
                        url: '/job_allocation/job_giving/get-order-details/' + orderId,
                        type: 'GET',
                        dataType: 'json',
                        success: function(data) {
                            if (data) {
                                $('#order_date').val(data.order_date);

                                $('#customer_name').val(data.customer_name);
                            } else {
                                $('#order_date').val('');

                                $('#customer_name').val('');
                            }
                        }
                    });
                } else {
                    $('#order_date').val('');
                    $('#customer_name').val('');
                }
            });

            $('#dc_number').on('change', function() {
                var orderId = $(this).val();
                console.log(orderId);
                if (orderId) {
                    $.ajax({
                        url: '/job_allocation/job_giving/get-dc-details/' + orderId,
                        type: 'GET',
                        dataType: 'json',
                        success: function(data) {
                            console.log(data.dcDetail.order_details);

                            if (data) {
                                $('#order_no').val(data.dcDetail.order_details.order_no
                                    .last_order_number);
                                $('#model_name').val(data.dcDetail.order_details.product_model
                                    .model_name);
                                $('#order_date').val(data.dcDetail.order_details.order_date);

                                $('#customer_name').val(data.dcDetail.order_details.customer
                                    .customer_name);
                                $('#product_name').val(data.dcDetail.order_details.product_model
                                    .product.name);

                                $('#total_quantity').val(data.dcDetail.quantity);

                                $('#total_weight').val(data.dcDetail.weight);
                                $('#available_quantity').val(data.dcDetail.available_quantity);

                                $('#raw_material_name').val(data.dcDetail.order_details
                                    .product_model.raw_material.name);

                                $('#raw_material_type').val(data.dcDetail.order_details
                                    .product_model.raw_material.raw_material_type.name);

                                $('#weightPerItem').val(data.dcDetail.order_details
                                    .weight_per_item);

                                $('#deliveryDate').val(data.dcDetail.order_details
                                    .delivery_date);
                            } else {
                                $('#order_date').val('');

                                $('#customer_name').val('');
                            }
                        }
                    });
                } else {
                    $('#order_date').val('');
                    $('#customer_name').val('');
                }
            });

   
        });
    </script>
@endsection