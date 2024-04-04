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
         <div class="col-12">
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
                           <label for="customer_code" class="col-sm-2 col-form-label ">Order
                           ID</label>
                           <div class="col-sm-4 mb-4 ">
                              <select class="form-control select2" name="order_id" id="order_id" disabled>
                              @foreach ($order_details as $item)
            <option value="{{ $item->id }}" @if ($item->id == $JobGiving->order_id) selected @endif>
                {{ $item->orderNo->customer_order_no }}
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
                              <input type="text" class="form-control" name="order_date" id="order_date" readonly value="{{$item->order_date }}">
                              @error('order_date')
                              <span class="error" style="color: red;">{{ $message }}</span>
                              @enderror
                           </div>
                           <label for="customer_code" class="col-sm-2 col-form-label ">Customer Name</label>
                           <div class="col-sm-4 mb-4">
                              <input type="text" class="form-control" name="customer_name" id="customer_name" readonly value="{{$item->customer->customer_name}}">
                              @error('customer_name')
                              <span class="error" style="color: red;">{{ $message }}</span>
                              @enderror
                           </div>
                           <label for="customer_code" class="col-sm-2 col-form-label ">Model</label>
                           <div class="col-sm-4 mb-4">
                              <select class="form-control select2" name="product_model_id" id="product_model_id">
    <option value="">Select Model</option>
    @foreach($productModels as $productModel)
        <option value="{{ $productModel->id }}" @if($JobGiving->product_model_id == $productModel->id) selected @endif>
            {{ $productModel->model_name }}-{{ $productModel->model_code }}
        </option>
    @endforeach
</select>
                              @error('product_model')
                              <span class="error" style="color: red;">{{ $message }}</span>
                              @enderror
                           </div>
                           <label for="order_date" class="col-sm-2 col-form-label ">Product Name</label>
                           <div class="col-sm-4 mb-4">
                              <input class="form-control" type="text" name="product" id="product" readonly value="{{$productModel->product->name }}">
                              @error('product_id')
                              <span class="error" style="color: red;">{{ $message }}</span>
                              @enderror
                           </div>
                           <label for="order_date" class="col-sm-2 col-form-label ">Raw Material Name</label>
                           <div class="col-sm-4 mb-4">
                              <input class="form-control" type="text" name="raw_material_name" id="raw_material_name" readonly value="{{$productModel->rawMaterial->name }}">
                              @error('raw_material')
                              <span class="error" style="color: red;">{{ $message }}</span>
                              @enderror
                           </div>
                           <label for="order_date" class="col-sm-2 col-form-label">Raw Material Type</label>
                           <div class="col-sm-4 mb-4">
                              <input class="form-control" type="text" name="raw_material_type" id="raw_material_type" readonly value="{{$productModel->rawMaterial->rawMaterialType->name }}">
                              @error('raw_material_type')
                              <span class="error" style="color: red;">{{ $message }}</span>
                              @enderror
                           </div>
                           <label for="order_date" class="col-sm-2 col-form-label">date</label>
                           <div class="col-sm-4 mb-4">
                              <input class="form-control" type="date" name="date" id="date" value="{{$JobGiving->date}}">
                              @error('date')
                              <span class="error" style="color: red;">{{ $message }}</span>
                              @enderror
                           </div>
                           <label for="order_date" class="col-sm-2 col-form-label">Quantity</label>
                           <div class="col-sm-4 mb-4">
                              <input class="form-control" type="text" name="quantity" id="quantity" value="{{$JobGiving->quantity}}">
                              @error('quantity')
                              <span class="error" style="color: red;">{{ $message }}</span>
                              @enderror
                           </div>
                        </div>
                        <div class="form-group row">
                           <label for="customer_name" class="col-sm-2 col-form-label">DC
                           Number</label>
                           <div class="col-sm-4 mb-4">
                              <select class="form-control select2" name="dc_number" id="dc_number"
                              @if ($JobGiving->dc_number)  @endif >
                              @foreach ($delivery_challan as $item)
                              <option value="{{ $item->id }}"
                              @if ($item->id == $JobGiving->dc_number) selected @endif>
                              {{ $item->dc_no }}
                              </option>
                              @endforeach
                              </select>
                              @error('dc_number')
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
   });
</script>
<!-- 
<script>
   $(document).ready(function() {
       $('#employee_id').change(function() {
           var companyName = $(this).find(':selected').data('company-name');
           var companyType = $(this).find(':selected').data('company-type');
           $('#company_name').val(companyName);
           $('#company_type').val(companyType);
       });
   });
</script> -->

<script>
        $(document).ready(function() {
            var companyName = $('#employee_id').find(':selected').data('company-name');
            var companyType = $('#employee_id').find(':selected').data('company-type');
            $('#company_name').val(companyName);
            $('#company_type').val(companyType);
        });
    </script>
@endsection