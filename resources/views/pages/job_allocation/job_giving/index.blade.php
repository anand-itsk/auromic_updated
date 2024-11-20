@extends('layouts.app')
<!-- DataTables CSS -->
@section('title', 'Job Giving')

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
            @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    {{ session('error') }}
                </div>
            @endif
            <div class="row">
                <div class="col-sm-12">
                    <div class="page-title-box">
                        <div class="btn-group float-right">
                            <ol class="breadcrumb hide-phone p-0 m-0">
                                <li class="breadcrumb-item"><a href="#">Auromics</a></li>
                                <li class="breadcrumb-item"><a href="#">Job Allocation</a></li>
                                <li class="breadcrumb-item active">Job Giving</li>
                            </ol>
                        </div>
                        <h4 class="page-title">Job Giving</h4>
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




                                <!-- <label for="customer_code" class="col-sm-2 col-form-label ">
                                                                                                           Date
                                                                                                           </label>
                                                                                                           <div class="col-sm-2 mb-2">
                                                                                                            <input type="date" class="form-control" name="date" id="">
                                                                                                              @error('company_type_id')
        <span class="error" style="color: red;">{{ $message }}</span>
    @enderror
                                                                                                           </div> -->

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


                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="card m-b-30">
                                <div class="d-flex justify-content-between p-2 bd-highlight">
                                    @error('file')
                                        <span class="error" style="color: red;">{{ $message }}</span>
                                    @enderror
                                    <div>
                                        <button id="deleteButton" class="icon-button delete-color"
                                            title="Delete Selected Record"><i class="fa fa-user-times"></i></button>
                                    </div>
                                    <div>
                                        <!-- <button type="button" class="icon-button common-color" data-toggle="modal"
                                                                data-target=".bs-example-modal-center" title="Job Giving"><i
                                                                    class="fa fa-upload"></i></button> -->

                                        <a href="{{ route('job_allocation.job_giving.create') }}"
                                            class="icon-link common-color" title="Create Job Giving">
                                            <i class="fa fa-user-plus"></i>
                                        </a>
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
                                                                <form action="" method="POST"
                                                                    enctype="multipart/form-data">
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
                                                    <a href="{{ asset('assets/sample_excels/job_giving_import.xlsx') }}"
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
                                                <th>Quantity</th>
                                                <th>Given Date</th>
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
                            <h5 class="modal-title" id="detailsModalLabel">Customer Details</h5>
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
            table = $('#users-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: '{{ route('job_allocation.job_giving.data') }}',
                    data: function(d) {
                        // Add additional parameters here if needed
                        d.company_type = $('#company_type').val();
                        d.companies = $('#companies').val();
                        d.status = $('#statuses').val();
                        d.from_date = $('#from_date').val();
                        d.last_date = $('#last_date').val();
                        d.orderNoId = $('#order_id').val();
                        d.product = $('#product').val();
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
                        data: 'given_date',
                        name: 'given_date',
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
                        <button onclick="deleteCustomer(${row.id})" class="icon-button delete-color"><i class="fa fa-trash"></i></button>

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
                            window.location.href = '/job_allocation/job_giving/export?' + $.param(dt
                                .ajax
                                .params());
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
            $('#companies').on('change', function() {
                // Reload DataTable with updated parameters
                table.ajax.reload();
            });

            $('#statuses').on('change', function() {
                // Reload DataTable with updated parameters
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

            $('#order_id').on('change', function() {
                // Reload DataTable with updated parameters
                table.ajax.reload();
            });

            $('#product').on('change', function() {
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
                var status = $('#statuses option:selected').text();
                var fromDate = $('#from_date').val();
                var lastDate = $('#last_date').val();
                var product = $('#product option:selected').text(); // New filter
                var orderNoId = $('#order_id option:selected').text();

                // Construct the string with selected filter values
                selectedFilters += 'Company Type: ' + companyType + ', ';
                selectedFilters += 'Companies: ' + companies + ', ';
                selectedFilters += 'Status: ' + status + ', ';
                selectedFilters += 'From Date: ' + fromDate + ', ';
                selectedFilters += 'Last Date: ' + lastDate;
                selectedFilters += 'Order No: ' + orderNo + ', ';
                selectedFilters += 'Product: ' + product;

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
                        url: '/job_allocation/job_giving/delete/selected',
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
            window.location.href = '/job_allocation/job_giving/edit/' + id;
        }

        function deleteCustomer(id) {
            console.log("inside")
            // Send an AJAX request to delete the user
            if (confirm('Are you sure you want to delete this Job Giving?')) {
                $.ajax({
                    url: '/job_allocation/job_giving/delete/' + id,
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
            // Fetch user details using AJAX
            $.ajax({
                url: '/master/customers/show/' + userId,
                type: 'GET',
                success: function(response) {

                    const createdAt = response.data.created_at;
                    const formattedCreatedAt = formatTimestamp(createdAt);
                    const updatedAt = response.data.updated_at;
                    const formattedUpdatedAt = formatTimestamp(updatedAt);
                    $('#detailsContent').html(response.html);
                    $('#created_by').html(response.data.created_by);
                    $('#updated_by').html(response.data.updated_by);
                    $('#created_at').html(formattedCreatedAt);
                    $('#updated_at').html(formattedUpdatedAt);

                    console.log(formattedCreatedAt);
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
        });
    </script>

    <script>
        document.querySelectorAll('input[name="date_filter"]').forEach(function(element) {
            element.addEventListener('change', function() {
                document.getElementById('filterForm').submit(); // Submit the form on selection
            });
        });
    </script>




@endsection
