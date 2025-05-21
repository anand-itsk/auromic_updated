@extends('layouts.app')
<!-- DataTables CSS -->
@section('title', 'Job Received')

@section('content')
    <style>
        .modal-dialog {
            max-width: 90%;
            width: 90%;
        }
    </style>
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
                                <li class="breadcrumb-item active">Job Received</li>
                            </ol>
                        </div>
                        <h4 class="page-title">Job Received</h4>
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


                                {{-- From Starts --}}
                                <label for="customer_code" class="col-sm-2 col-form-label ">
                                    From Date
                                </label>
                                <div class="col-sm-2 mb-2">
                                    <input type="date" class="form-control" name="from_date" id="from_date">
                                    @error('company_type_id')
                                        <span class="error" style="color: red;">{{ $message }}</span>
                                    @enderror
                                </div>
                                {{-- From Ends --}}


                                {{-- Last Start --}}
                                <label for="customer_code" class="col-sm-2 col-form-label ">
                                    To Date
                                </label>
                                <div class="col-sm-2 mb-2">
                                    <input type="date" class="form-control" name="last_date" id="last_date">
                                    @error('company_type_id')
                                        <span class="error" style="color: red;">{{ $message }}</span>
                                    @enderror
                                </div>
                                {{-- Last Ends --}}
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
                                    Status
                                </label>
                                <div class="col-sm-2 mb-2">
                                    <select class="form-control select2" name="status" id="statuses">
                                        <option value="">Select Status</option>
                                        <option value="Incomplete">Incomplete</option>
                                        <option value="Complete">Complete</option>
                                        <option value="Pending">Pending</option>
                                        <option value="cancelled">Cancelled</option>
                                    </select>
                                    @error('status')
                                        <span class="error" style="color: red;">{{ $message }}</span>
                                    @enderror
                                </div>

                                <label for="customer_code" class="col-sm-2 col-form-label ">
                                    Order No
                                </label>
                                <div class="col-sm-2 mb-2">
                                    <select class="form-control select2" name="order_id" id="order_id">
                                        <option value="">Select Type</option>
                                        @foreach ($order_nos as $type)
                                            <option value="{{ $type->id }}">{{ $type->customer_order_no }}</option>
                                        @endforeach

                                    </select>
                                    @error('order_id')
                                        <span class="error" style="color: red;">{{ $message }}</span>
                                    @enderror
                                </div>
                                <label for="customer_code" class="col-sm-2 col-form-label ">
                                    Product
                                </label>
                                <div class="col-sm-2 mb-2">
                                    <select class="form-control select2" name="product" id="product">
                                        <option value="">Select Type</option>
                                        @foreach ($product as $type)
                                            <option value="{{ $type->id }}">{{ $type->name }}</option>
                                        @endforeach

                                    </select>
                                    @error('order_id')
                                        <span class="error" style="color: red;">{{ $message }}</span>
                                    @enderror
                                </div>



                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="card m-b-30">
                                <div class="d-flex justify-content-between p-2 bd-highlight">
                                    <div>

                                    </div>
                                    <div>


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
                                                                <form action="{{ route('master.customers.import') }}"
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
                                                    <a href="{{ asset('assets/sample_excels/customer_import.xlsx') }}"
                                                        download>Click
                                                        to download sample document</a>
                                                </p>

                                            </div>
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
                                                <th>Company name</th>
                                                <th>Employee Code</th>
                                                <th>Employee Name</th>
                                                <th>Model Code</th>
                                                <th>Model Name</th>
                                                <th>Product Size</th>
                                                <th>Product Color</th>
                                                <th>Given Quantity</th>
                                                <th>Pending Quantity</th>
                                                <th>Given Date</th>
                                                <th>Received Date</th>
                                                <th>Order ID</th>
                                                <th>DC NO</th>
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
                            <h5 class="modal-title" id="detailsModalLabel">Job Received Details</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div id="detailsContent">
                                <!-- Content loaded via AJAX -->
                            </div>
                        </div>

                        <!-- <div class="modal-footer">

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
                                            </div> -->
                    </div>
                </div>
            </div>

        </div>
    </div>


    {{-- edit Modal Pop-up --}}
    <!-- Modal -->
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editsModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title mt-0">Edit Job Received</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="card m-b-30">
                                <div class="card-body">
                                    <form action="{{ route('job_allocation.job_received.store') }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <input type="text" name="job_giving_id" id="job_giving_id"
                                            style="display: none">
                                        {{-- <input type="text" name="job_giving_id" id="job_giving_idtest"> --}}
                                        <div class="form-group row">
                                            <label for="customer_code" class="col-sm-12 col-form-label mandatory">
                                                Incentive Applicable
                                            </label>
                                            <div class="col-sm-12 mb-4">
                                                <select class="form-control select2" name="Incentive_status"
                                                    id="Incentive_status">
                                                    <option value="Yes">Yes</option>
                                                    <option value="No">No</option>
                                                </select>
                                                @error('employee_id')
                                                    <span class="error" style="color: red;">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <label for="customer_code"
                                                class="col-sm-12 col-form-label mandatory">Receiving Date</label>
                                            <div class="col-sm-12 mb-4">
                                                <input class="form-control" type="date" name="receiving_date"
                                                    id="receiving_date" required="">
                                                @error('order_id')
                                                    <span class="error" style="color: red;">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <label for="customer_code" class="col-sm-12 col-form-label mandatory">
                                                Status
                                            </label>
                                            <div class="col-sm-12 mb-4">
                                                <select class="form-control select2" name="received_status"
                                                    id="received_status">
                                                    {{-- @foreach ($job_received_data as $item)
                                                        <option value="{{ $item->id }}">{{ $item->status }}</option>
                                                    @endforeach --}}
                                                    {{-- {{ $job_received_data->status }} --}}
                                                    <option value="Incomplete">Incomplete</option>
                                                    <option value="Complete">Complete</option>
                                                    <option value="Pending">Pending</option>
                                                </select>
                                                @error('employee_id')
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
                {{-- <div class="modal-footer">
                </div> --}}
            </div>
        </div>
    </div>
    {{-- modal --}}
    <div class="modal fade price-create-modal-center" id="updateModal1" tabindex="-1" role="dialog"
        aria-labelledby="updateModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title mt-0">History</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body pb-0">
                    <!-- Table inside the modal body -->
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Job Giving ID</th>
                                <th scope="col">Received Date</th>
                                <th scope="col">Received quantity</th>
                                <th scope="col">Wages </th>
                                <th scope="col">Conveyance</th>
                                <th scope="col">Deduction </th>
                                <th scope="col">Incentive </th>
                                <th scope="col">Final Amount </th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Data will be injected here via JavaScript -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    {{-- modal end --}}
    <!-- DataTables JS -->
    @include('links.js.datatable.datatable-js')


    <script>
        var table;
        $(document).ready(function() {
            table = $('#users-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: '{{ route('job_allocation.job_received.data') }}',
                    data: function(d) {
                        // Add additional parameters here if needed
                        d.status = $('#statuses').val();
                        d.company_type = $('#company_type').val();
                        d.companies = $('#companies').val();
                        d.orderNoId = $('#order_id').val();
                        d.product = $('#product').val();
                        d.from_date = $('#from_date').val();
                        d.last_date = $('#last_date').val();
                        d.date_filter = $('input[name="date_filter"]:checked').val();
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
                        data: 'company_name',
                        name: 'company_name',
                        render: function(data, type, row) {
                            return data ? data : '-';
                        }

                    },
                    {
                        data: 'employee_code',
                        name: 'employee_code',
                        render: function(data, type, row) {
                            return data ? data : '-';
                        }

                    },
                    {
                        data: 'employee_name',
                        name: 'employee_name',
                        render: function(data, type, row) {
                            return data ? data : '-';
                        }

                    },
                    {
                        data: 'model_code',
                        name: 'model_code',
                        render: function(data, type, row) {
                            return data ? data : '-';
                        }

                    },
                    {
                        data: 'model_name',
                        name: 'model_name',
                        render: function(data, type, row) {
                            return data ? data : '-';
                        }

                    },
                    {
                        data: 'product_size',
                        name: 'product_size',
                        render: function(data, type, row) {
                            return data ? data : '-';
                        }

                    },
                    {
                        data: 'product_color',
                        name: 'product_color',
                        render: function(data, type, row) {
                            return data ? data : '-';
                        }

                    },
                    {
                        data: 'quantity',
                        name: 'quantity',
                        render: function(data, type, row) {
                            return data ? data : '-';
                        }

                    },
                    {
                        data: 'pending_quantity',
                        name: 'pending_quantity',
                        render: function(data, type, row) {
                            return data ? data : '-';
                        }

                    },
                    {
                        data: 'given_date',
                        name: 'given_date',
                        render: function(data, type, row) {
                            return data ? data : '-';
                        }
                    },

                    {
                        data: 'received_date',
                        name: 'received_date',
                        render: function(data, type, row) {
                            return data ? data : '-';
                        }
                    },


                    {
                        data: 'customer_order_no',
                        name: 'customer_order_no',
                        render: function(data, type, row) {
                            return data ? data : '-';
                        }
                    },
                    {
                        data: 'dc_no',
                        name: 'dc_no',
                        render: function(data, type, row) {
                            return data ? data : '-';
                        }

                    },


                    {
                        data: 'status',
                        name: 'status',
                        render: function(data, type, row) {
                            return data ? data : '-';
                        }
                    },

                    {
                        data: null,
                        orderable: false,
                        searchable: false,
                        render: function(data, type, row) {
                            return `
                        <button onclick="edit(${row.id})" class="icon-button primary-color"><i class="fa fa-edit"></i></button>
<button onclick="openModal1(${row.id})" class="icon-button modal-color"><i class="fa fa-eye"></i></button>

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
                    'excel', 'print',
                    {
                        text: 'Export All',
                        action: function(e, dt, node, config) {
                            window.location.href = '/job_allocation/job_received/export?' + $.param(
                                dt.ajax
                                .params());
                        }
                    }
                ]

            });

            $('#statuses').on('change', function() {
                // Reload DataTable with updated parameters
                table.ajax.reload();
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
            $('#companies').on('change', function() {
                // Reload DataTable with updated parameters
                table.ajax.reload();
            });


            $('#order_id').on('change', function() {
                // Reload DataTable with updated parameters
                table.ajax.reload();
            });

            $('#product').on('change', function() {
                table.ajax.reload();
            });
            $('#from_date').on('change', function() {
                // Reload DataTable with updated parameters
                table.ajax.reload();
            });
            $('#last_date').on('change', function() {
                // Reload DataTable with updated parameters
                table.ajax.reload();
            });
            $('input[name="date_filter"]').on('change', function() {
                // Reload DataTable with new filter
                table.ajax.reload();
            });


            function updateSelectedFilters() {
                var selectedFilters = '';
                // Get selected values from filter elements
                var companyType = $('#company_type option:selected').text();
                var companies = $('#companies option:selected').text();
                var product = $('#product option:selected').text(); // New filter
                var orderNoId = $('#order_id option:selected').text();
                var fromDate = $('#from_date').val();
                var lastDate = $('#last_date').val();

                // Construct the string with selected filter values
                selectedFilters += 'Company Type: ' + companyType + ', ';
                selectedFilters += 'Companies: ' + companies + ', ';
                selectedFilters += 'Status: ' + status + ', ';
                selectedFilters += 'Order No: ' + orderNo + ', ';
                selectedFilters += 'Product: ' + product;
                selectedFilters += 'From Date: ' + fromDate + ', ';
                selectedFilters += 'Last Date: ' + lastDate;


                // Update the HTML content with selected filter values
                $('#selectedFilters').text(selectedFilters);

            }

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
                        url: '/job_allocation/delivery_challan/delete/selected',
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
        });

        function edit(id) {
            console.log("inside");

            // Redirect to the user edit page or open a modal for editing
            window.location.href = '/job_allocation/job_received/edit/' + id;
        }

        function deleteCustomer(id) {
            console.log("inside")
            // Send an AJAX request to delete the user
            if (confirm('Are you sure you want to delete this user?')) {
                $.ajax({
                    url: '/master/customers/delete/' + id,
                    type: 'DELETE',
                    data: {
                        _token: '{{ csrf_token() }}',
                    },
                    success: function(result) {
                        table.ajax.reload(); // Reload the DataTable
                    }
                });
            }


        }

        function openModal1(id) {
            $('#updateModal1').modal('show');

            $.ajax({
                url: '/job_allocation/job_received/jobreceived/history/' + id, // Adjusted to match the route
                type: 'GET',
                success: function(response) {
                    var tableBody = $('#updateModal1 .modal-body table tbody');
                    tableBody.empty();

                    if (response.success && response.data.length > 0) {
                        response.data.forEach(function(item) {
                            var row = `<tr>
                        <td>${item.id}</td>
                        <td>${item.job_giving_id}</td>
                        <td>${item.receving_date}</td>
                        <td>${item.complete_quantity}</td>
                        <td>${item.wages}</td>
                        <td>${item.conveyance_fee}</td>
                        <td>${item.deducation_fee}</td>
                        <td>${item.incentive_fee}</td>
                        <td>${item.total_amount}</td>
                         <td>
                            <button class="btn btn-primary btn-sm edit-btn" data-id="${item.id}">
                                Edit
                            </button>
                        </td>
                    </tr>`;
                            tableBody.append(row);
                        });
                    } else {
                        var noDataRow = `<tr>
                    <td colspan="7" class="text-center">No data found for the selected record.</td>
                </tr>`;
                        tableBody.append(noDataRow);
                    }
                },
                error: function() {
                    var tableBody = $('#updateModal1 .modal-body table tbody');
                    tableBody.empty();
                    var errorRow = `<tr>
                <td colspan="7" class="text-center">Error fetching data. Please try again later.</td>
            </tr>`;
                    tableBody.append(errorRow);
                }
            });
        }

        $(document).on('click', '.edit-btn', function() {
            var row = $(this).closest('tr');
            var id = $(this).data('id');
            var rawDate = row.find('td:eq(2)').text().trim();
            var formattedDate = convertDateFormat(rawDate);
            var originalTotal = parseFloat(row.find('td:eq(8)').text().trim()) || 0; // Store initial total amount

            // Store the original total amount in a data attribute
            row.data('original-total', originalTotal);

            // Convert table cells to input fields
            row.find('td:eq(2)').html(
                `<input type="date" class="form-control edit-input" name="receving_date" value="${formattedDate}">`
            );
            row.find('td:eq(3)').html(
                `<input type="number" class="form-control edit-input" name="complete_quantity" value="${row.find('td:eq(3)').text().trim()}">`
            );
            row.find('td:eq(5)').html(
                `<input type="text" class="form-control edit-input conveyance-fee" name="conveyance_fee" value="${row.find('td:eq(5)').text().trim()}">`
            );
            row.find('td:eq(6)').html(
                `<input type="text" class="form-control edit-input deducation-fee" name="deducation_fee" value="${row.find('td:eq(6)').text().trim()}">`
            );
            row.find('td:eq(7)').html(
                `<input type="text" class="form-control edit-input incentive-fee" name="incentive_fee" value="${row.find('td:eq(7)').text().trim()}">`
            );
            row.find('td:eq(8)').html(
                  `<input type="text" class="form-control edit-input total-amount" name="total_amount" value="${originalTotal.toFixed(2)}" readonly>`
            );

            // Change edit button to save button
            row.find('.edit-btn').replaceWith(
                `<button class="btn btn-success btn-sm save-btn" data-id="${id}">Save</button>`);
        });


        $(document).on('input', '.conveyance-fee, .deducation-fee, .incentive-fee', function() {
    var row = $(this).closest('tr');
    
    var originalTotal = parseFloat(row.data('original-total')) || 0; // Retrieve stored total amount
    var conveyanceFee = parseFloat(row.find('.conveyance-fee').val()) || 0;
    var deducationFee = parseFloat(row.find('.deducation-fee').val()) || 0;
    var incentiveFee = parseFloat(row.find('.incentive-fee').val()) || 0;

    var newTotal = originalTotal + conveyanceFee + incentiveFee - deducationFee;

    row.find('.total-amount').val(newTotal.toFixed(2)); // Updating total amount field
});

        // Save updated data when the save button is clicked
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(document).on('click', '.save-btn', function() {
            var row = $(this).closest('tr');
            var id = $(this).data('id');

            var formData = {
                id: id,
                job_giving_id: row.find('td:eq(1)').text().trim(),
                receving_date: row.find('input[name="receving_date"]').val(),
                complete_quantity: row.find('input[name="complete_quantity"]').val(),
                conveyance_fee: row.find('input[name="conveyance_fee"]').val(),
                deducation_fee: row.find('input[name="deducation_fee"]').val(),
                incentive_fee: row.find('input[name="incentive_fee"]').val(),
                total_amount: row.find('input[name="total_amount"]').val(),
            };

            $.ajax({
                url: '/job_allocation/job_received/jobreceived/update',
                type: 'POST',
                data: formData,
                success: function(response) {
                    if (response.success) {
                        alert('Updated successfully!');

                        row.find('td:eq(2)').text(formData.receving_date);
                        row.find('td:eq(3)').text(formData.complete_quantity);
                        row.find('td:eq(5)').text(formData.conveyance_fee);
                        row.find('td:eq(6)').text(formData.deducation_fee);
                        row.find('td:eq(7)').text(formData.incentive_fee);
                        row.find('td:eq(8)').text(formData.total_amount);

                        row.find('.save-btn').replaceWith(
                            `<button class="btn btn-primary btn-sm edit-btn" data-id="${id}">Edit</button>`
                        );
                    } else {
                        alert('Error updating record.');
                    }
                },
                error: function(xhr) {
                    console.log(xhr.responseText);
                    alert('Error updating record.');
                }
            });
        });



        function convertDateFormat(dateString) {
            var parts = dateString.split('/');
            if (parts.length === 3) {
                return `${parts[2]}-${parts[1]}-${parts[0]}`; // Convert to "yyyy-MM-dd"
            }
            return dateString; // Return original if format is incorrect
        }




        function showDetails(id) {
            // Fetch user details using AJAX
            $.ajax({
                url: '/job_allocation/job_received/show/' + id,
                type: 'GET',
                success: function(response) {

                    console.log(response);

                    $('#detailsContent').html(response.html);


                    // console.log(formattedCreatedAt);
                    $('#detailsModal').modal('show');

                }
            });
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
        $(document).ready(function() {
            // Initialize Select2 on the customer dropdown

            $('#order_id').select2({
                placeholder: "Select Order",
                allowClear: true
            });
            $('#product').select2({
                placeholder: "Select Product",
                allowClear: true
            });
            $('#statuses').select2({
                placeholder: "Select Status",
                allowClear: true
            });

            $('#incentive_status').select2({
                placeholder: "Select Incentive Status",
                allowClear: true
            });

        });
    </script>
@endsection
