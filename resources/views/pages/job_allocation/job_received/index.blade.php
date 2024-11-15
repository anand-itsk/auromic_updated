@extends('layouts.app')
<!-- DataTables CSS -->
@section('title', 'Job Received')

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
                                <li class="breadcrumb-item active">Job Received</li>
                            </ol>
                        </div>
                        <h4 class="page-title">Job Received</h4>
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
                                    <table id="users-table" class="table table-striped table-bordered table-responsive nowrap"
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
    <!-- DataTables JS -->
    @include('links.js.datatable.datatable-js')


    <script>
        var table;
        $(document).ready(function() {
            table = $('#users-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route('job_allocation.job_received.data') }}',
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
                            window.location.href = '/job_allocation/job_received/export?' + $.param(dt.ajax
                                .params());
                        }
                    }
                ]

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

        function showDetails(id) {
            // Fetch user details using AJAX
            $.ajax({
                url: '/job_allocation/job_received/show/'+ id,
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
@endsection
