@extends('layouts.app')
<!-- DataTables CSS -->


@section('content')
    @include('links.css.datatable.datatable-css')
    @include('links.css.table.custom-css')
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

                                        {{-- <a href="{{ route('master.employees.create') }}" class="icon-link common-color"
                                            title="Create New User">
                                            <i class="fa fa-user-plus"></i>
                                        </a> --}}

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
                                                <h5 class="modal-title mt-0">Resign Employee</h5>
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
                                                                <form action="{{ route('master.employees.store.resign') }}"
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
                                                                        <label for="employee_code"
                                                                            class="col-sm-12 col-form-label mandatory">Date
                                                                        </label>
                                                                        <div class="col-sm-12 mb-4">
                                                                            <input class="form-control" type="date"
                                                                                name="relieving_date">
                                                                            @error('employee_code')
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
                                                                            class="col-sm-12 col-form-label mandatory">Do you want to cancel Notice Period?</label>
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
                                                                <form action="{{ route('master.employees.store') }}"
                                                                    method="POST" enctype="multipart/form-data">
                                                                    @csrf
                                                                    <div class="row">
                                                                        <label for="employee_code"
                                                                            class="col-sm-12 col-form-label mandatory">Employee
                                                                            Code</label>
                                                                        <div class="col-sm-12 mb-4">

                                                                            <input class="form-control" type="text"
                                                                                name="employee_code"
                                                                                value="{{ $formattedEmployeeNumber }}"
                                                                                readonly>
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
                                                                            of
                                                                            Birth</label>
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
                                        class="table table-striped table-bordered dt-responsive nowrap"
                                        style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Employee Code</th>
                                                <th>Employee Name</th>
                                                 <th>Company Name</th>
                                                 <th>Company Type</th>
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
            table = $('#users-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route('master.employees.data') }}',
                columns: [{
                        data: 'id',
                        name: 'id'
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
                        data: 'company_name',
                        name: 'company_name'
                    },

                    {
                        data: 'company_type_name',
                        name: 'company_type_name'
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
                    return '<span class="employee_status_tb ' + statusClass + '">' + data + '</span>';
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
                    'excel', 'print',
                    {
                        text: 'Export All',
                        action: function(e, dt, node, config) {
                            window.location.href = '/master/employees/export?' + $.param(dt.ajax
                                .params());
                        }
                    }
                ]

            });



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


    <script>
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
    </script>
@endsection
