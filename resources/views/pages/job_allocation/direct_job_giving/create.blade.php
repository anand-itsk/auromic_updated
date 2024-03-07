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
                            <li class="breadcrumb-item">Create</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Create Direct Job Giving</h4>
                </div>
            </div>
        </div>
        <!-- end page title end breadcrumb -->

        <div class="row">
            <div class="col-12">
                <div class="card m-b-30">
                    <div class="card-body">
                        <div class="m-b-30">
                            <form action="{{ route('job_allocation.direct_job_giving.store') }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="form-group row">
   
<label for="customer_code" class="col-sm-2 col-form-label mandatory">
                           Employee
                           </label>
                           <div class="col-sm-4 mb-4">
                              <select class="form-control select2" name="employee_id" id="employee_id">
                                 <option value="">Select Employee</option>
                                 @foreach ($employee as $item)
                                 <option value="{{ $item->id }}" 
                                    data-company-name="{{ $item->company->company_name}}/{{ $item->company->authorisedPerson->name}}" 
                                    data-company-type="{{ $item->company->companyType->name}}">
                                    {{ $item->employee_code }}/{{ $item->employee_name }}
                                 </option>
                                 @endforeach
                              </select>
                              @error('employee_id')
                              <span class="error" style="color: red;">{{ $message }}</span>
                              @enderror
                           </div>
                           <label for="company_type" class="col-sm-2 col-form-label mandatory">
                           Company Type
                           </label>
                           <div class="col-sm-4 mb-4">
                              <input type="text" class="form-control" name="company_type" id="company_type" readonly>
                              @error('company_type')
                              <span class="error" style="color: red;">{{ $message }}</span>
                              @enderror
                           </div>
                           <label for="company_name" class="col-sm-2 col-form-label mandatory">
                           Company Name
                           </label>
                           <div class="col-sm-4 mb-4">
                              <input type="text" class="form-control" name="company_name" id="company_name" readonly>
                              @error('company_name')
                              <span class="error" style="color: red;">{{ $message }}</span>
                              @enderror
                           </div>
                        <label for="customer_code" class="col-sm-2 col-form-label mandatory">Model</label>
                           <div class="col-sm-4 mb-4">
                              <select class="form-control select2" name="product_model_id" id="product_model_id">
                                 <option value="">Select Model</option>
                                 @foreach($product_model as $productModel)
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
                              @error('product_id')
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
<label for="order_date" class="col-sm-2 col-form-label">Weight</label>
<div class="col-sm-4 mb-4">
    <input class="form-control" type="text" name="weight" id="weight">
    @error('weight')
        <span class="error" style="color: red;">{{ $message }}</span>
    @enderror
</div>
   
                                <div class="form-group">
                                    <div class="d-flex justify-content-evenly">
                                        <button type="submit" class="btn btn-primary waves-effect waves-light">
                                            Submit
                                        </button>
                                        <a href="{{ route('master.incentives.create') }}"
                                            class="btn btn-warning waves-effect waves-light">
                                            Reset
                                        </a>
                                        <a href="{{ route('master.incentives.index') }}"
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
   $(document).ready(function(){
       $('#product').change(function(){
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
   });
</script>
<script>
   $(document).ready(function() {
       $('#product_model_id').change(function() {
           var modelId = $(this).val();
           if (modelId) {
               $.ajax({
                   url: '/job_allocation/direct_job_giving/get-model-details/' + modelId,
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