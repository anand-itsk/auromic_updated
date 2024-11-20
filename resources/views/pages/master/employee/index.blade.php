@extends('layouts.app')
<!-- DataTables CSS -->

@section('title', 'Employees')
@section('content')
    @include('links.css.datatable.datatable-css')
    @include('links.css.table.custom-css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <div class="wrapper">
        <div class="container-fluid">
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    {{ session('success') }}
                </div>
            @endif
            <div class="row">
                <div class="col-sm-12">
                    <div class="page-title-box">
                        <div class="btn-group float-right">
                            <ol class="breadcrumb hide-phone p-0 m-0">
                                <li class="breadcrumb-item"><a href="#">Auromics</a></li>
                                <li class="breadcrumb-item"><a href="#">Master</a></li>
                                <li class="breadcrumb-item active">Employees</li>
                            </ol>
                        </div>
                        <h4 class="page-title">Employees</h4>
                    </div>
                    <div class="card mb-2">
                        <div class="card-body">
                            <div class="form-group row mb-0">

                                {{-- date Starts --}}
                                <div class="form-group col-sm-4 mb-2 d-flex align-item-center"
                                    style="position: relative;top:8px">

                                    <div class="">
                                        <label class="mx-0"><input type="radio" name="date_filter" value="today">
                                            Today</label>
                                        <label class="ml-4"><input type="radio" name="date_filter" value="this_month">
                                            This
                                            Month</label>
                                        <label class="ml-4"><input type="radio" name="date_filter" value="last_month">
                                            Last
                                            Month</label>
                                    </div>
                                </div>
                                {{-- date Ends --}}





                                {{-- From Date starts --}}
                                <label for="customer_code" class="col-sm-2 col-form-label ">
                                    From Date
                                </label>
                                <div class="col-sm-2 mb-2">
                                    <input type="date" class="form-control" name="from_date" id="from_date">
                                    @error('from_date')
                                        <span class="error" style="color: red;">{{ $message }}</span>
                                    @enderror
                                </div>

                                {{-- From Date Ends --}}



                                {{-- To Date Starts --}}

                                <label for="customer_code" class="col-sm-2 col-form-label ">
                                    To Date
                                </label>
                                <div class="col-sm-2 mb-2">
                                    <input type="date" class="form-control" name="last_date" id="last_date">
                                    @error('last_date')
                                        <span class="error" style="color: red;">{{ $message }}</span>
                                    @enderror
                                </div>
                                {{-- To Date Ends --}}



                                <label for="customer_code" class="col-sm-2 col-form-label ">
                                    Company Type
                                </label>
                                <div class="col-sm-2 mb-2">
                                    <select class="form-control select2" name="company_type" id="company_type">
                                        <option value="">Select Type</option>
                                        @foreach ($companyType as $type)
                                            <option value="{{ $type->id }}">{{ $type->name }}</option>
                                        @endforeach

                                    </select>
                                    @error('company_type')
                                        <span class="error" style="color: red;">{{ $message }}</span>
                                    @enderror
                                </div>
                                <label for="customer_code" class="col-sm-2 col-form-label ">
                                    Companies
                                </label>
                                <div class="col-sm-2 mb-2">
                                    <select class="form-control select2" name="companies" id="companies" disabled>
                                        <option value="">Select Company</option>
                                        @foreach ($company as $c)
                                            <option value="{{ $c->id }}" data-type-id="{{ $c->company_type_id }}">
                                                {{ $c->company_name }}</option>
                                        @endforeach
                                    </select>
                                    @error('Companies')
                                        <span class="error" style="color: red;">{{ $message }}</span>
                                    @enderror
                                </div>



                                <label for="customer_code" class="col-sm-2 col-form-label ">
                                    Employee Code
                                </label>
                                <div class="col-sm-2 mb-2">
                                    <select class="form-control select2" name="employee_code" id="employee_code">
                                        <option value="">Select Employee</option>
                                        @foreach ($employees as $employee)
                                            <option value="{{ $employee->id }}">{{ $employee->employee_code }}</option>
                                        @endforeach
                                    </select>
                                    @error('Companies')
                                        <span class="error" style="color: red;">{{ $message }}</span>
                                    @enderror
                                </div>

                                <label for="customer_code" class="col-sm-2 col-form-label ">
                                    Employee
                                </label>
                                <div class="col-sm-2 mb-2">
                                    <select class="form-control select2" name="employee" id="employee">
                                        <option value="">Select Employee</option>
                                        @foreach ($employees as $employee)
                                            <option value="{{ $employee->id }}">{{ $employee->employee_name }}</option>
                                        @endforeach
                                    </select>
                                    @error('Companies')
                                        <span class="error" style="color: red;">{{ $message }}</span>
                                    @enderror
                                </div>

                                <label for="customer_code" class="col-sm-2 col-form-label ">
                                    Status
                                </label>
                                <div class="col-sm-2 mb-2">
                                    <select id="employee_status" class="form-control" name="employee_status"
                                        id="employee_status">
                                        <option value="">Select</option>
                                        <option value="working">Working
                                        </option>
                                        <option value="serve_notice_period">Serve
                                            Notice Period
                                        </option>
                                        <option value="relieved">Relieved
                                        </option>
                                        <option value="terminated">Terminated
                                        </option>
                                    </select>
                                    @error('Companies')
                                        <span class="error" style="color: red;">{{ $message }}</span>
                                    @enderror
                                </div>
                                <label for="customer_code" class="col-sm-2 col-form-label ">
                                    Own Employee
                                </label>
                                <div class="col-sm-2 mb-2">
                                    <select class="form-control" name="own_company" id="own_company">
                                        <option value="">Select</option>
                                        <option value="yes">Yes</option>
                                        <option value="no">No</option>
                                    </select>

                                    @error('Companies')
                                        <span class="error" style="color: red;">{{ $message }}</span>
                                    @enderror
                                </div>

                                <label for="customer_code" class="col-sm-2 col-form-label ">
                                    Joining Date
                                </label>
                                <div class="col-sm-2 mb-2">
                                    <input type="date" class="form-control" name="joining_date" id="joining_date">
                                    @error('joining_date')
                                        <span class="error" style="color: red;">{{ $message }}</span>
                                    @enderror
                                </div>




                                {{-- <div class="form-group">
                                  
                                    <div>
                                        <label><input type="radio" name="date_filter" value="today"> Today</label>
                                        <label><input type="radio" name="date_filter" value="this_month"> This
                                            Month</label>
                                        <label><input type="radio" name="date_filter" value="last_month"> Last
                                            Month</label>
                                    </div>
                                </div> --}}
                                <!-- Existing fields and select options -->




                                <!-- <label for="customer_code" class="col-sm-2 col-form-label ">
                                                               Gender
                                                               </label>
                                                               <div class="col-sm-2 mb-2">
                                                                  <select class="form-control select2" name="gender" id="gender">
                                                                     <option value="">Select Gender</option>
                                                                     
                                                                  </select>
                                                                  @error('gender')
        <span class="error" style="color: red;">{{ $message }}</span>
    @enderror
                                                               </div> -->


                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <div class="card m-b-30">
                                @error('file')
                                    <span class="error" style="color: red;">{{ $message }}</span>
                                @enderror
                                <div class="d-flex justify-content-between p-2 bd-highlight">
                                    <div>
                                        <button id="deleteButton" style="display: none;"
                                            class="icon-button text-white bg-danger rounded fs-14"
                                            title="Delete Selected Record">
                                            Delete Selected Record</button>
                                    </div>

                                    <div>
                                        <button type="button" class="icon-button common-color bg-secondary rounded"
                                            data-toggle="modal" data-target=".bs-example-modal-center"
                                            title="Import Employee"><i class="fa fa-upload text-white"></i></button>
                                        <button type="button" class="icon-button common-color  bg-primary rounded "
                                            data-toggle="modal" data-target=".employe-create-modal-center"
                                            title="Create Employee"><i class="fa fa-user-plus text-white"></i></button>
                                    </div>
                                </div>


                                {{-- Import Modal --}}
                                <div class="modal fade bs-example-modal-center" tabindex="-1" role="dialog"
                                    aria-labelledby="mySmallModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title mt-0">Import</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="card m-b-30">
                                                            <div class="card-body">
                                                                <form action="{{ route('master.employees.import') }}"
                                                                    method="POST" enctype="multipart/form-data">
                                                                    @csrf
                                                                    <input type="file" name="file" required>
                                                                    <button type="submit"
                                                                        class="btn btn-primary">Import</button>
                                                                    <button type="button" class="btn btn-secondary"
                                                                        data-dismiss="modal">Close</button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <h4 class="mt-0 header-title mb-0">Note:</h4>
                                                <p class="text-muted font-14">Supported documents (.xls,
                                                    .xlsx or .csv)</p>
                                                <p class="text-muted font-14">To upload sample document, it
                                                    must have concern fields.
                                                    <a href="{{ asset('assets/sample_excels/employee_import.xlsx') }}"
                                                        download>Click
                                                        to download sample document</a>
                                                </p>

                                            </div>
                                        </div><!-- /.modal-content -->
                                    </div><!-- /.modal-dialog -->
                                </div>



                                <!-- resign employee modal -->
                                <div class="modal employe-resign-modal-center" tabindex="-1" role="dialog"
                                    aria-labelledby="mySmallModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title mt-0">Status Update</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body pb-0">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="card m-b-30">
                                                            <div class="card-body py-0">
                                                                <form
                                                                    action="{{ route('master.employees.store.resign') }}"
                                                                    method="POST" enctype="multipart/form-data">
                                                                    @csrf
                                                                    <div class="row">
                                                                        <input type="hidden" class="employee_id"
                                                                            name="employee_id" value=""
                                                                            id="employee_id">
                                                                        <input type="hidden"
                                                                            class="employee_name form-control"
                                                                            name="employee_name" value=""
                                                                            id="employee_name" readonly>

                                                                        <label for="employee_status"
                                                                            class="mandatory col-form-label col-sm-12 col-form-label">Employee
                                                                            Status</label>
                                                                        <div class="col-sm-12 mb-4">
                                                                            <select id="employee_status"
                                                                                class="form-control"
                                                                                name="employee_status"
                                                                                id="employee_status">
                                                                                <option value="">Select</option>
                                                                                <option value="serve_notice_period">Serve
                                                                                    Notice Period
                                                                                </option>
                                                                                <option value="relieved">Relieved
                                                                                </option>
                                                                                <option value="terminated">Terminated
                                                                                </option>
                                                                            </select>
                                                                        </div>
                                                                        <label for="dd"
                                                                            class="col-sm-12 col-form-label mandatory">Date
                                                                        </label>
                                                                        <div class="col-sm-12 mb-4">
                                                                            <input class="form-control" type="date"
                                                                                name="relieving_date">
                                                                            @error('ygg')
                                                                                <span class="error"
                                                                                    style="color: red;">{{ $message }}</span>
                                                                            @enderror
                                                                        </div>
                                                                        <label for="employee_name"
                                                                            class="col-sm-12 col-form-label mandatory">Reason
                                                                        </label>
                                                                        <div class="col-sm-12 mb-4">
                                                                            <select class="form-control"
                                                                                name="resigning_reason_id"
                                                                                id="resigning_reason_id ">
                                                                                <option value="">Select</option>
                                                                                @foreach ($resigning_reason as $item)
                                                                                    <option value="{{ $item->id }}">
                                                                                        {{ $item->name }}</option>
                                                                                @endforeach
                                                                            </select>
                                                                            @error('resigning_reason_id')
                                                                                <span class="error"
                                                                                    style="color: red;">{{ $message }}</span>
                                                                            @enderror
                                                                        </div>
                                                                    </div>
                                                                    <button type="submit"
                                                                        class="btn btn-primary">Create</button>
                                                                    <button type="button" class="btn btn-secondary"
                                                                        data-dismiss="modal">Close</button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- /.modal-content -->
                                    </div>
                                    <!-- /.modal-dialog -->
                                </div>
                                <!--  -->

                                <!-- Rejoin -->
                                <div class="modal employe-rejoin-modal-center" tabindex="-1" role="dialog"
                                    aria-labelledby="mySmallModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title mt-0">Rejoin Employee</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body pb-0">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="card m-b-30">
                                                            <div class="card-body py-0">
                                                                <form
                                                                    action="{{ route('master.employees.store.rejoining') }}"
                                                                    method="POST" enctype="multipart/form-data">
                                                                    @csrf
                                                                    <div class="row">
                                                                        <input type="hidden" class="employee_id"
                                                                            name="employee_id" value=""
                                                                            id="employee_id">
                                                                        <input type="text"
                                                                            class="employee_name form-control"
                                                                            name="employee_name" value=""
                                                                            id="employee_name" readonly>
                                                                        <label for="rejoining_date"
                                                                            class="col-sm-12 col-form-label mandatory">Rejoining
                                                                            Date</label>
                                                                        <div class="col-sm-12 mb-4">
                                                                            <input class="form-control" type="date"
                                                                                name="rejoining_date">
                                                                            @error('rejoining_date')
                                                                                <span class="error"
                                                                                    style="color: red;">{{ $message }}</span>
                                                                            @enderror
                                                                        </div>
                                                                    </div>
                                                                    <button type="submit"
                                                                        class="btn btn-primary">Create</button>
                                                                    <button type="button" class="btn btn-secondary"
                                                                        data-dismiss="modal">Close</button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- /.modal-content -->
                                    </div>
                                    <!-- /.modal-dialog -->
                                </div>
                                <!--  -->

                                <!-- Cancel Relieving -->
                                <div class="modal employe-cancel-relieving-modal-center" tabindex="-1" role="dialog"
                                    aria-labelledby="mySmallModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title mt-0">Cancel Notice Period</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body pb-0">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="card m-b-30">
                                                            <div class="card-body py-0">
                                                                <form
                                                                    action="{{ route('master.employees.store.cancel_relieving') }}"
                                                                    method="POST" enctype="multipart/form-data">
                                                                    @csrf
                                                                    <div class="row">
                                                                        <input type="hidden" class="employee_id"
                                                                            name="employee_id" value=""
                                                                            id="employee_id">
                                                                        <input type="text"
                                                                            class="employee_name form-control"
                                                                            name="employee_name" value=""
                                                                            id="employee_name" readonly>
                                                                        <label for="rejoining_date"
                                                                            class="col-sm-12 col-form-label mandatory">Do
                                                                            you want to cancel Notice Period?</label>
                                                                    </div>
                                                                    <button type="submit"
                                                                        class="btn btn-primary">Yes</button>
                                                                    <button type="button" class="btn btn-secondary"
                                                                        data-dismiss="modal">Close</button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- /.modal-content -->
                                    </div>
                                    <!-- /.modal-dialog -->
                                </div>
                                <!--  -->

                                {{-- Create Modal --}}
                                <div class="modal fade employe-create-modal-center" tabindex="-1" role="dialog"
                                    aria-labelledby="mySmallModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title mt-0">Create Employee</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body pb-0">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="card m-b-30">
                                                            <div class="card-body py-0">
                                                                <form id="employeeForm"
                                                                    action="{{ route('master.employees.store') }}"
                                                                    method="POST" enctype="multipart/form-data">
                                                                    @csrf
                                                                    <div class="row">
                                                                        <label for="employee_code"
                                                                            class="col-sm-12 col-form-label mandatory">Employee
                                                                            Code</label>
                                                                        <div class="col-sm-12 mb-4">
                                                                            <input class="form-control" type="text"
                                                                                name="employee_code" id="employee_code"
                                                                                value="" required>
                                                                            <span class="text-danger d-none"
                                                                                id="employee_code_err"></span>
                                                                            @error('employee_code')
                                                                                <span class="error"
                                                                                    style="color: red;">{{ $message }}</span>
                                                                            @enderror
                                                                        </div>

                                                                        <label for="employee_name"
                                                                            class="col-sm-12 col-form-label mandatory">Employee
                                                                            Name</label>
                                                                        <div class="col-sm-12 mb-4">
                                                                            <input class="form-control" type="text"
                                                                                name="employee_name" id="employee_name"
                                                                                required>
                                                                            @error('employee_name')
                                                                                <span class="error"
                                                                                    style="color: red;">{{ $message }}</span>
                                                                            @enderror
                                                                        </div>

                                                                        <label for="dob"
                                                                            class="col-sm-12 col-form-label mandatory">Date
                                                                            of Birth</label>
                                                                        <div class="col-sm-12 mb-4">
                                                                            <input class="form-control" type="date"
                                                                                name="dob" id="dob" required>
                                                                            @error('dob')
                                                                                <span class="error"
                                                                                    style="color: red;">{{ $message }}</span>
                                                                            @enderror
                                                                        </div>
                                                                    </div>

                                                                    <button type="submit"
                                                                        class="btn btn-primary">Create</button>
                                                                    <button type="button" class="btn btn-secondary"
                                                                        data-dismiss="modal">Close</button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            {{-- <div class="modal-footer">
                                            </div> --}}
                                        </div><!-- /.modal-content -->
                                    </div><!-- /.modal-dialog -->
                                </div>
                                <div class="card-body">
                                    <table id="users-table"
                                        class="table table-striped table-bordered table-responsive nowrap"
                                        style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>M.Company</th>
                                                <th>C.Company</th>
                                                <th>SC.Company</th>
                                                <th>Own Company</th>
                                                <th>Employee Code</th>
                                                <th>Employee Name</th>
                                                <th>Father/Hus Name</th>
                                                <th>DOJ</th>
                                                <th>DOR</th>
                                                <th>DOB</th>
                                                <th>Village</th>
                                                <th>PF</th>
                                                <th>ESI</th>
                                                <th>Mobile Number</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Modal -->
            <div class="modal fade" id="detailsModal" tabindex="-1" role="dialog" aria-labelledby="detailsModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="detailsModalLabel">Employee Details</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div id="detailsContent">
                                <!-- Content loaded via AJAX -->
                            </div>
                        </div>

                        <div class="modal-footer">

                            <div class="row w-100">
                                <div class="col-md-10">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <span class="font-weight-bold mr-2">Created By</span>
                                            <span id="created_by"></span>
                                        </div>
                                        <div class="col-md-6">
                                            <span class="font-weight-bold mr-2">Created at</span>
                                            <span id="created_at"></span>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 ">
                                            <span class="font-weight-bold mr-2">Updated By</span>
                                            <span id="updated_by"></span>
                                        </div>
                                        <div class="col-md-6 ">
                                            <span class="font-weight-bold mr-2">Updated at</span>
                                            <span id="updated_at"></span>
                                        </div>
                                    </div>

                                </div>
                                <div class="col-md-2">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- DataTables JS -->
    @include('links.js.datatable.datatable-js')

    <script>
        var table;

        $(document).ready(function() {
            var table;

            // Initialize DataTable
            $('#companies').prop('disabled', true);
            table = $('#users-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: '{{ route('master.employees.data') }}',

                    data: function(d) {
                        console.log(d);

                        // Add additional parameters here if needed
                        d.company_type = $('#company_type').val();
                        d.joining_date = $('#joining_date').val();
                        d.companies = $('#companies').val();
                        d.employee = $('#employee').val();
                        d.employee_code = $('#employee_code').val(),
                            d.from_date = $('#from_date').val();
                        d.last_date = $('#last_date').val();
                        d.employee_status = $('#employee_status').val();
                        d.date_filter = $('input[name="date_filter"]:checked').val();
                        d.own_company = $('#own_company').val();
                    }
                },
                columns: [{

                        data: 'id',
                        name: 'id',
                        render: function(data, type, row, meta) {


                            return meta.row + 1;
                        }
                    },
                    {
                        data: 'master_company',
                        name: 'master_company'
                    },
                    {
                        data: 'cilent_company',
                        name: 'cilent_company',
                        render: function(data, type, row, meta) {
                            return row.client_company;
                        }
                    },
                    {
                        data: 'sub_cilent_company',
                        name: 'sub_cilent_company',
                        render: function(data, type, row, meta) {
                            return row.sub_client_company;
                        }
                    },
                    {
                        data: 'own_company',
                        name: 'own_company'
                    },
                    {
                        data: 'employee_code',
                        name: 'employee_code'
                    },
                    {
                        data: 'employee_name',
                        name: 'employee_name'
                    },
                    {
                        data: 'faorhus_name',
                        name: 'faorhus_name'
                    },
                    {
                        data: 'joining_date',
                        name: 'joining_date'
                    },
                    {
                        data: 'resigning_date',
                        name: 'resigning_date'
                    },
                    {
                        data: 'dob',
                        name: 'dob'
                    },
                    {
                        data: 'village',
                        name: 'village'
                    },
                    {
                        data: 'pf_no',
                        name: 'pf_no'
                    },

                    {
                        data: 'esi_no',
                        name: 'esi_no'
                    },
                    {
                        data: 'mobile',
                        name: 'mobile'
                    },

                    {
                        data: 'status',
                        name: 'status',
                        render: function(data, type, full, meta) {
                            var statusClass = '';
                            if (data === 'working') {
                                statusClass = 'bg-success';
                            } else if (data === 'relieving') {
                                statusClass = 'bg-warning';
                            } else {
                                statusClass = 'bg-danger';
                            }
                            return '<span class="employee_status_tb ' + statusClass + '">' + data +
                                '</span>';
                        }
                    },
                    {
                        data: null,
                        orderable: false,
                        searchable: false,
                        render: function(data, type, row) {
                            return `
                        <button onclick="edit(${row.id})" class="icon-button primary-color"><i class="fa fa-edit"></i></button>
                        <button onclick="deleteCustomer(${row.id})" class="icon-button delete-color"><i class="fa fa-trash"></i></button>
                        <button onclick="showDetails(${row.id})" class="icon-button common-color"><i class="fa fa-eye"></i></button>
                        <button onclick="openResignModal(${row.id}, '${row.employee_name}', '${row.status}')" class="icon-button custom-color"><i class="fa fa-user"></i></button>
                        
                    `;
                        }

                    },

                ],
                order: [
                    [0, 'desc']
                ],

                select: true,
                dom: 'lBfrtip',
                buttons: [
                    'excel',
                    {
                        extend: 'print',
                        text: 'Print',

                        customize: function(win) {
                            // Initialize an empty title string


                            var title = "";

                            // Check if Company Type is selected and append to the title
                            // var companyType = $('#company_type').val();
                            // if (companyType) {
                            //     title += " Company Type: " + $('#company_type option:selected').text();
                            // }

                            // Check if Company is selected and append to the title
                            var company = $('#companies').val();
                            if (company) {
                                title += $('#companies option:selected').text();
                            }

                            // Check if From Date is selected and append to the title
                            // var fromDate = $('#from_date').val();
                            // if (fromDate) {
                            //     title += " From Date: " + fromDate;
                            // }

                            // Check if Last Date is selected and append to the title
                            // var lastDate = $('#last_date').val();
                            // if (lastDate) {
                            //     title += "Last Date: " + lastDate;
                            // }

                            // Set the constructed title to the <h1> element in the print view
                            var h1Element = $(win.document.body).find('h1');
                            h1Element.text(title);

                            // Decrease font size of company name in print view
                            h1Element.css('font-size', '18px');

                            var currentDate = new Date().toLocaleDateString('en-US', {
                                year: 'numeric',
                                month: 'numeric',
                                day: 'numeric'
                            });
                            var dateElement = $('<div>').css({
                                'position': 'absolute',
                                'top': '20px',
                                'right': '20px',
                                'font-weight': 'bold',
                                'font-size': '16px'
                            }).text(currentDate);
                            $(win.document.body).append(dateElement);


                            var reportName =
                                "Employee Report"; // Change this to the desired report name
                            var reportElement = $('<h2>').css({
                                'text-align': 'center',
                                'font-weight': 'bold',
                                'font-size': '24px',
                                'margin-top': '30px'
                            }).text(reportName);
                            $(win.document.body).prepend(reportElement);


                            $(win.document.body).find('table.dataTable').css('border-collapse',
                                'collapse');
                            $(win.document.body).find('table.dataTable th, table.dataTable td').css(
                                'text-align', 'center');

                            $(win.document.head).append('<style>@page {size: landscape; }</style>');

                            // Add other customization as needed
                            $(win.document.body).find('table').addClass('compact');
                        }
                    },
                    {
                        text: 'Export All',
                        action: function(e, dt, node, config) {
                            window.location.href = '/report/employee_report/export?' + $.param(dt
                                .ajax.params());
                        }
                    }
                ]
            });

            // Event listener for company type dropdown
            $('#company_type').on('change', function() {
                var selectedCompanyType = $(this).val();
                if (selectedCompanyType) {
                    $('#companies').prop('disabled', false);
                } else {
                    $('#companies').prop('disabled', true).val('');
                }
                // Reload DataTable with updated parameters
                table.ajax.reload();
            });

            // Event listener for joining date dropdown
            $('#joining_date').on('change', function() {
                // Reload DataTable with updated parameters
                table.ajax.reload();
            });

            // Event listener for companies dropdown
            $('#companies').on('change', function() {
                // Reload DataTable with updated parameters
                table.ajax.reload();
            });
            $('#employee').on('change', function() {
                table.ajax.reload();
            });

            $('#employee_code').on('change', function() {
                table.ajax.reload();
            });



            // Event listener for from date
            $('#from_date').on('change', function() {
                table.ajax.reload();
            });

            // Event listener for last date
            $('#last_date').on('change', function() {
                table.ajax.reload();
            });
            $('#employee_status').on('change', function() {
                table.ajax.reload();
            });

            $('input[name="date_filter"]').on('change', function() {
                // Reload DataTable with new filter
                table.ajax.reload();
            });
            $('#own_company').on('change', function() {
                // Reload DataTable with updated parameters
                table.ajax.reload();
            });


        });

        function updateSelectedFilters() {
            var selectedFilters = '';
            var companyType = $('#company_type option:selected').text();
            var companies = $('#companies option:selected').text();
            var joiningDate = $('#joining_date').val();
            var employee = $('#employee option:selected').text();
            var employee_code = $('#employee_code option:selected').text();
            var fromDate = $('#from_date').val();
            var lastDate = $('#last_date').val();
            var employeeStatus = $('#employee_status option:selected').text();
            var ownCompany = $('#own_company option:selected').text(); // Get selected own company filter

            selectedFilters += 'Company Type: ' + companyType + ', ';
            selectedFilters += 'Companies: ' + companies + ', ';
            selectedFilters += 'Joining Date: ' + joiningDate + ', ';
            selectedFilters += 'Employee: ' + employee + ', ';
            selectedFilters += 'Employee Code: ' + employee_code + ', ';
            selectedFilters += 'From Date: ' + fromDate + ', ';
            selectedFilters += 'Last Date: ' + lastDate + ', ';
            selectedFilters += 'Employee Status: ' + employeeStatus + ', ';
            selectedFilters += 'Own Company: ' + ownCompany; // Add own company filter to the selected filters

            $('#selectedFilters').text(selectedFilters);
        }






        // Listen for row selection event
        $('#users-table').on('select.dt deselect.dt', function() {
            console.log("yes id done");
            var selectedRows = table.rows({
                selected: true
            }).count();

            if (selectedRows > 0) {
                $('#deleteButton').show(); // Show delete button if rows are selected
            } else {
                $('#deleteButton').hide(); // Hide delete button if no rows are selected
            }
        });

        $('#deleteButton').click(function() {
            var ids = $.map(table.rows('.selected').data(), function(item) {
                return item.id;
            });

            if (ids.length === 0) {
                alert('No rows selected!');
                return;
            }

            if (confirm("Are you sure you want to delete these rows?")) {
                // Send AJAX request to delete the selected rows
                $.ajax({
                    url: '/master/employees/delete/selected',
                    type: 'POST',
                    data: {
                        ids: ids,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        // Handle response here
                        table.ajax.reload(); // Reload the DataTable
                    }
                });
            }
        });


        function openResignModal(id, name, status) {
            // Set any necessary data using the id parameter if needed
            $('.employee_id').val(id);
            $('.employee_name').val(name);
            // $('#employeesIdInput').val(id);
            // Show the modal based on the status
            if (status === 'working') {
                $('.employe-resign-modal-center').modal('show');
            } else if (status === 'relieving') {
                $('.employe-cancel-relieving-modal-center').modal('show');
            } else if (status === 'relieved') {
                $('.employe-rejoin-modal-center').modal('show');
            }
        }

        function edit(id) {
            console.log("inside");
            // Redirect to the user edit page or open a modal for editing
            window.location.href = '/master/employees/edit/' + id;
        }

        function deleteCustomer(id) {
            console.log("inside")
            // Send an AJAX request to delete the user
            if (confirm('Are you sure you want to delete this Employee?')) {
                $.ajax({
                    url: '/master/employees/delete/' + id,
                    type: 'get',
                    data: {
                        _token: '{{ csrf_token() }}',
                    },
                    success: function(result) {
                        table.ajax.reload(); // Reload the DataTable
                    }
                });
            }
        }

        function showDetails(userId) {

            window.location.href = '/master/employees/show/' + userId;
            // Fetch user details using AJAX
            // $.ajax({
            //     url: '/master/employees/show/' + userId,
            //     type: 'GET',
            //     success: function(response) {

            //         const createdAt = response.data.created_at;
            //         const formattedCreatedAt = formatTimestamp(createdAt);
            //         const updatedAt = response.data.updated_at;
            //         const formattedUpdatedAt = formatTimestamp(updatedAt);
            //         $('#detailsContent').html(response.html);
            //         $('#created_by').html(response.data.created_by);
            //         $('#updated_by').html(response.data.updated_by);
            //         $('#created_at').html(formattedCreatedAt);
            //         $('#updated_at').html(formattedUpdatedAt);

            //         console.log(formattedCreatedAt);
            //         $('#detailsModal').modal('show');
            //     }
            // });
        }

        function formatTimestamp(timestamp) {
            const date = new Date(timestamp);
            const day = date.getDate().toString().padStart(2, '0');
            const month = (date.getMonth() + 1).toString().padStart(2, '0'); // Months are zero-based
            const year = date.getFullYear();
            let hours = date.getHours();
            const minutes = date.getMinutes().toString().padStart(2, '0');
            const ampm = hours >= 12 ? 'PM' : 'AM';
            hours = hours % 12;
            hours = hours ? hours : 12; // the hour '0' should be '12'
            const strTime = hours.toString().padStart(2, '0') + ':' + minutes + ' ' + ampm;

            return `${day}-${month}-${year} ${strTime}`;
        }
    </script>


    {{-- <script>
        function generateEmployeeCode() {
            // Generate a random number between 1 and 999
            const randomNumber = Math.floor(Math.random() * 999) + 1;

            // Format the number with leading zeros
            const formattedEmployeeCode = 'EMP' + String(randomNumber).padStart(3, '0');

            return formattedEmployeeCode;
        }

        // Call the function to generate the employee code when the page loads
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('employee_code').value = generateEmployeeCode();
        });
    </script> --}}
    <script>
        $(document).ready(function() {
            // Initialize Select2 on both dropdowns
            $('#company_type, #companies').select2({
                placeholder: "Select an option",
                allowClear: true
            });

            // Company Type select change event
            $('#company_type').on('change', function() {
                var selectedTypeId = $(this).val(); // Get the selected company type

                // Reset the companies dropdown
                var $companiesSelect = $('#companies');
                $companiesSelect.empty().append(
                    '<option value="">Select Company</option>'); // Reset options

                // Filter and append companies based on selected company type
                var companies = @json($company); // Get all companies
                companies.forEach(function(company) {
                    if (company.company_type_id == selectedTypeId) {
                        var option = new Option(company.company_name, company.id);
                        $companiesSelect.append(option);
                    }
                });

                // Re-initialize Select2 after appending new options
                $companiesSelect.trigger('change');
            });
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Get today's date
            const today = new Date();

            // Calculate yesterday's date to set as the maximum date
            const yesterday = new Date(today);
            yesterday.setDate(today.getDate() - 1); // Subtract 1 day to get yesterday

            // Format the date to YYYY-MM-DD
            const formattedDate = yesterday.toISOString().split('T')[0];

            // Set the max attribute of the input to yesterday's date (prevents today or any future date)
            const dobInput = document.getElementById('dob');
            dobInput.setAttribute('max', formattedDate); // Ensures no future date or today can be selected

            // Create an error message element and append it after the input
            const errorMessage = document.createElement('span');
            errorMessage.classList.add('error');
            errorMessage.style.color = 'red';
            dobInput.parentNode.appendChild(errorMessage);

            // Function to calculate age from date of birth
            function calculateAge(dob) {
                const birthDate = new Date(dob);
                const age = today.getFullYear() - birthDate.getFullYear();
                const month = today.getMonth() - birthDate.getMonth();

                if (month < 0 || (month === 0 && today.getDate() < birthDate.getDate())) {
                    return age - 1; // If birthday hasn't occurred yet this year, subtract 1
                }

                return age;
            }

            // Listen for the change event on the date of birth input
            dobInput.addEventListener('change', function() {
                const dobValue = dobInput.value;

                // Only validate if the input has a value
                if (dobValue) {
                    const age = calculateAge(dobValue);

                    // If the age is less than 18, display the error message and clear the input value
                    if (age < 18) {
                        errorMessage.textContent =
                            "You must be at least 18 years old to create an account.";
                        dobInput.setCustomValidity("Age must be at least 18.");
                        dobInput.value = ''; // Clear the input value if the age is less than 18
                    } else {
                        errorMessage.textContent = ''; // Clear the error message if age is valid
                        dobInput.setCustomValidity(""); // Clear the custom validity
                    }
                } else {
                    // If input is cleared, hide the error message
                    errorMessage.textContent = '';
                    dobInput.setCustomValidity(""); // Clear custom validity when input is empty
                }
            });
        });
    </script>


    <script>
        document.querySelectorAll('input[name="date_filter"]').forEach(function(element) {
            element.addEventListener('change', function() {
                document.getElementById('filterForm').submit(); // Submit the form on selection
            });
        });
    </script>

   <script>
    $(document).ready(function() {
        $('#employeeForm').on('submit', function(e) {
            e.preventDefault(); // Prevent the default form submission

            // Disable the submit button to prevent multiple submissions
            $('button[type="submit"]').prop('disabled', true).text('Submitting...');

            $.ajax({
                url: $(this).attr('action'),
                method: 'POST',
                data: new FormData(this),
                processData: false, // Don't process the data
                contentType: false, // Let jQuery handle the content type
                success: function(res) {
                    // Handle success
                    if (res.errors) {
                        console.log('res.errors.................', res.errors);
                        if (res.errors.employee_code) {
                            $('#employee_code_err').text(res.errors.employee_code[0]);
                            $('#employee_code_err').removeClass('d-none');
                        }
                    } else if (res.success) {
                        // Display success message
                        alert('Employee created successfully!');

                        // Redirect to the edit page
                        window.location.href = res.redirect_url;
                    } else {
                        // Handle validation errors or any other errors
                        alert('Error: ' + res.message);
                    }
                },
                error: function(xhr, status, error) {
                    // Handle AJAX error
                    alert('Something went wrong. Please try again.');
                },
                complete: function() {
                    // Re-enable the submit button
                    $('button[type="submit"]').prop('disabled', false).text('Create');
                }
            });
        });
    });
</script>

  <script>
        $(document).ready(function() {
            // Initialize Select2 on the customer dropdown
            $('#employee_code').select2({
                placeholder: "Select Employee Code",
                allowClear: true
            });
            $('#employee').select2({
                placeholder: "Select Employee Name",
                allowClear: true
            });
            $('#own_company').select2({
                placeholder: "Select Own Company",
                allowClear: true
            });
             $('#employee_status').select2({
                placeholder: "Select Employee Status",
                allowClear: true
            });
        });
    </script>

@endsection
