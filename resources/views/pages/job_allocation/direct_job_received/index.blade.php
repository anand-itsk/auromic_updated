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
                            <li class="breadcrumb-item active">Direct Job Received</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Direct Job Received</h4>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="card m-b-30">
                            <div class="d-flex justify-content-between p-2 bd-highlight">
                                <div>
                                    <button id="deleteButton" class="icon-button delete-color"
                                        title="Delete Selected Record"><i class="fa fa-user-times"></i></button>
                                </div>
                                <div>
                                    <button type="button" class="icon-button common-color" data-toggle="modal"
                                        data-target=".bs-example-modal-center" title="Create Customer"><i
                                            class="fa fa-upload"></i></button>

                                    <a href="{{ route('job_allocation.direct_job_giving.create') }}" class="icon-link common-color"
                                        title="Create Direct job Giving">
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
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="card m-b-30">
                                                        <div class="card-body">
                                                            <form action="{{ route('master.incentives.import') }}"
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
                                                <a href="{{ asset('assets/sample_excels/incentives.xlsx') }}"
                                                    download>Click
                                                    to download sample document</a>
                                            </p>

                                        </div>
                                    </div><!-- /.modal-content -->
                                </div><!-- /.modal-dialog -->
                            </div>
                            <div class="card-body">
                                <table id="users-table" class="table table-striped table-bordered dt-responsive nowrap"
                                    style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Employee</th>
                                            <th>Product Model</th>
                                            <th>Product Size</th>
                                            <th>Product Color</th>
                                             <th>quantity</th>
                                             <th>Weight</th>
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
{{-- edit Modal Pop-up --}}
    <!-- Modal -->
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editsModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title mt-0">Direct Job Received</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="card m-b-30">
                                <div class="card-body">
                                    <form action="{{ route('job_allocation.direct_job_received.store') }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <input type="text" name="direct_job_giving_id" id="direct_job_giving_id"
                                            style="display: none">
                                        <!-- {{-- <input type="text" name="job_giving_id" id="job_giving_idtest"> --}} -->
                                        <div class="form-group row">
                                            
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
                                                Incentive Applicable
                                            </label>
                                            <div class="col-sm-12 mb-4">
                                                <select class="form-control select2" name="incentive_applicable"
                                                    id="Incentive_status" disabled>
                                                    <option value="Yes">Yes</option>
                                                    <option value="No">No</option>
                                                </select>
                                                @error('employee_id')
                                                    <span class="error" style="color: red;">{{ $message }}</span>
                                                @enderror
                                            </div>


                                            <label for="customer_code" class="col-sm-12 col-form-label mandatory">
                                                Product Model
                                            </label>
                                            <div class="col-sm-12 mb-4">
                                                <select class="form-control select2" name="product_model_id" id="product_model_id" disabled>
                                                    <option value="">select</option>
    <!-- Options will be dynamically populated here -->
</select>
                                                @error('employee_id')
                                                    <span class="error" style="color: red;">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="ml-3 d-flex flex-wrap px-4">
                                                <label>
                                                    <input class="form-check-input" name="Direct_Job_Received_Without_Giving" type="checkbox"
                                                        value="1" id="Direct_Job_Received_Without_Giving">
                                                   Direct Job Received Without Giving</label>
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
        ajax: '{{ route('job_allocation.direct_job_received.data') }}',
        columns: [{

                data: 'id',
                name: 'id'
            },
             {
                data: 'employee.employee_name',
                name: 'employee.employee_name'
            },
            {
                data: 'product_model.model_name',
                name: 'product_model.model_name'
            },
            {
                data: 'product_size.name',
                name: 'product_size.name'
            },
            {
                data: 'product_color.name',
                name: 'product_color.name'
            },
            {
                data: 'quantity',
                name: 'quantity'
            },
            {
                data: 'weight',
                name: 'weight'
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
                    window.location.href = '/master/incentives/export?' + $.param(dt.ajax
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
                url: '/job_allocation/direct_job_giving/delete/selected',
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
              $('#Direct_Job_Received_Without_Giving').change(function() {
                if (this.checked) {
                    $('#product_model_id').prop('disabled', false);
                    $('#Incentive_status').prop('disabled', false);
                } else {
                    $('#product_model_id').prop('disabled', true);
                    $('#Incentive_status').prop('disabled', true);
                }
            });
});

function edit(id) {
    console.log("inside");
    // Redirect to the user edit page or open a modal for editing
    window.location.href = '/job_allocation/direct_job_received/edit/' + id;
}
//  function edit(id)
//  {
//             console.log("inside");
//             // $('#job_giving_id').val(id);
//             $.ajax({
//                 url: '/job_allocation/direct_job_received/edit/' + id,
//                 type: 'GET',
//                 dataType: 'json',
//                success: function(response) {
//     console.log(response);

    
//     $('#direct_job_giving_id').val(id);
//     // Clear existing options
//     $('#product_model_id').empty();

//     // Populate dropdown with product models
//     response.product_model.forEach(function(product) {
//         $('#product_model_id').append('<option value="' + product.id + '">' + product.model_name + '</option>');
//     });

//     // Show the edit modal after populating the form fields
//     $('#editModal').modal('show');
// },
//                 error: function(xhr, status, error) {
//                     console.error(xhr.responseText);
//                 }
//             });
//         }

function deleteCustomer(id) {
    console.log("inside")
    // Send an AJAX request to delete the user
    if (confirm('Are you sure you want to delete this Product model?')) {
        $.ajax({
            url: '/master/product_model/delete/' + id,
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

function showDetails(userId) {
    // Fetch user details using AJAX
    $.ajax({
        url: '/master/incentives/show/' + userId,
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
@endsection