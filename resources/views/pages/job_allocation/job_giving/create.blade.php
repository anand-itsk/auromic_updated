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
                                        href="">Job Allocation</a>
                                </li>
                                   <li class="breadcrumb-item"><a
                                        href="">Job Giving</a>
                                </li>
                                <li class="breadcrumb-item">Create</li>
                            </ol>
                        </div>
                        <h4 class="page-title">Create Job Giving</h4>
                    </div>
                </div>
            </div>
            <!-- end page title end breadcrumb -->

            <div class="row">
                <div class="col-12">
                    <div class="card m-b-30">
                        <div class="card-body">
                            <div class="m-b-30">
                                <form action="{{ route('job_allocation.job_giving.store') }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group row">
                                        <label for="customer_code" class="col-sm-2 col-form-label mandatory">
                                            Employee Name
                                        </label>
                                        <div class="col-sm-4 mb-4">

                                            <select class="form-control select2" name="employee_id" id="employee_id">
                                               <option value="">Select Employee</option>
                                            @foreach ($employee as $item)
                                                    <option value="{{ $item->id }}">
                                                        {{ $item->employee_code }}/{{ $item->employee_name }}</option>
                                                @endforeach
                                            </select>
                                            @error('employee_id')
                                                <span class="error" style="color: red;">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <label for="customer_code" class="col-sm-2 col-form-label mandatory">Order
                                            ID</label>
                                        <div class="col-sm-4 mb-4">
                                            <select class="form-control select2" name="order_id" id="order_id">
                                                <option value="">Select Order</option>
                                                @foreach ($order_details as $item)
                                                    <option value="{{ $item->id }}">
                                                        {{ $item->order_no }}</option>
                                                @endforeach
                                            </select>
                                            @error('order_id')
                                                <span class="error" style="color: red;">{{ $message }}</span>
                                            @enderror
                                        </div>

                                    </div>

                                    <div class="form-group row">
                                        <label for="customer_name" class="col-sm-2 col-form-label">DC
                                            Number</label>

                                        <div class="col-sm-4 mb-4">
                                            <select class="form-control select2" name="dc_number" id="dc_number" disabled>
                                               <option value="">Select DC</option>
                                            @foreach ($delivery_challan as $item)
                                                    <option value="{{ $item->id }}">
                                                        {{ $item->dc_no }}</option>
                                                @endforeach
                                            </select>
                                            @error('dc_number')
                                                <span class="error" style="color: red;">{{ $message }}</span>
                                            @enderror

                                            <div class="ml-3 d-flex flex-wrap px-1 py-3">
                                                <label>
                                                    <input class="form-check-input" name="with_dc" type="checkbox"
                                                        value="1" id="with_dc">
                                                    With DC</label>
                                            </div>
                                        </div>




                                        <label for="customer_code" class="col-sm-2 col-form-label mandatory">Status</label>
                                        <div class="col-sm-4 mb-4">
                                            <select class="form-control select2" name="status" id="status">
                                                <option value="">Select Status</option>
                                                <option value="Incomplete">Incomplete</option>
                                                <option value="Complete">Complete</option>
                                                <option value="Pending">Pending</option>
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
                                            <a href="{{ route('job_allocation.job_giving.create') }}"
                                                class="btn btn-warning waves-effect waves-light">
                                                Reset
                                            </a>
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
@endsection
