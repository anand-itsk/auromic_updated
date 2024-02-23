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
                                        <label for="customer_code" class="col-sm-2 col-form-label mandatory">
                                            Employee Name
                                        </label>
                                        <div class="col-sm-4 mb-4">

                                            <select class="form-control select2" name="employee_id" id="employee_id">
                                                @foreach ($employee as $item)
                                                    <option value="{{ $item->id }}"
                                                        @if ($item->id == $JobGiving->employee_id) selected @endif>
                                                        {{ $item->employee_code }}/{{ $item->employee_name }}
                                                    </option>
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
                                                @foreach ($order_details as $item)
                                                    <option value="{{ $item->id }}"
                                                        @if ($item->id == $JobGiving->order_id) selected @endif>
                                                        {{ $item->order_no }}
                                                    </option>
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
                                            <select class="form-control select2" name="dc_number" id="dc_number"
                                                @if ($JobGiving->dc_number)  @endif disabled>
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

                                            <div class="ml-3 d-flex flex-wrap px-1 py-3">
                                                <label>
                                                    <input class="form-check-input" name="with_dc" type="checkbox"
                                                        value="1" id="with_dc"
                                                        @if ($JobGiving->dc_number) checked @endif>
                                                    With DC
                                                </label>
                                            </div>
                                        </div>




                                        <label for="customer_code" class="col-sm-2 col-form-label mandatory">Status</label>
                                        <div class="col-sm-4 mb-4">
                                            <select class="form-control select2" name="status" id="status">
                                                <option value="Incomplete"
                                                    @if ($JobGiving->status == 'Incomplete') selected @endif>Incomplete</option>
                                                <option value="Complete" @if ($JobGiving->status == 'Complete') selected @endif>
                                                    Complete</option>
                                                <option value="Pending" @if ($JobGiving->status == 'Pending') selected @endif>
                                                    Pending</option>
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
                                            <a href="{{ route('master.customers.create') }}"
                                                class="btn btn-warning waves-effect waves-light">
                                                Reset
                                            </a>
                                            <a href="{{ route('master.customers.index') }}"
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
