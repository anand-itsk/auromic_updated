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
        <div class="alert alert-success alert-dismissible fade show" role="alert" style="display:none;">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
    <strong></strong> Permission deleted successfully.
</div>
        <div class="row">
            <div class="col-xl-2">
                <div class="row">
                    <div class="col-12">
                        <div class="card p-2 leftsetup">
                            <h4 class="page-title">Setup</h4>
                            
                            @include('settings.setup_nav')
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-10">
                <div class="row">
                    <div class="col-12">
                        <div class="card m-b-30 rightsetup">
                            <div class="card-header pb-0 pt-0 bg-white">
                                <h5>Perimission</h5>
                            </div>

                            <div class="card-body pt-0">
                                <div class="row">
                                    <div class="col-md-12 rightsetup-details">
                                        <div class="d-flex justify-content-between p-2 bd-highlight">
                                            <div>
                                                <button id="deleteButton" class="icon-button delete-color"
                                                    title="Delete Selected Record"><i
                                                        class="fa fa-user-times"></i></button>
                                            </div>
                                            <div>
                                               
                                                <a href="{{route('user-management.permission_control.create')}}"
                                                    class="icon-link common-color" title="Create New Permission">
                                                    <i class="fa fa-user-plus"></i>
                                                </a>
                                            </div>
                                        </div>
                                        <table id="users-table"
                                            class="table table-striped table-bordered dt-responsive nowrap"
                                            style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                            <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Name</th>
                                                   
                                                   
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
        ajax: '{{route('user-management.permission_control.data')}}',
        columns: [{
                data: 'id',
                name: 'id'
            },
            {
                data: 'name',
                name: 'name'
            },
            
           
            {
                data: null,
                orderable: false,
                searchable: false,
                render: function(data, type, row) {
                    return `
                        <button onclick="editUser(${row.id})" class="icon-button primary-color"><i class="fa fa-edit"></i></button>
                        <button onclick="deleteCustomer(${row.id})" class="icon-button delete-color"><i class="fa fa-trash"></i></button>
                                              
                    `;
                }

            },
        ],
        order: [
            [0, 'asc']
        ],
        select: true,
        dom: 'lBfrtip',
        buttons: [
            'excel', 'print'
        ],
        pageLength: 8
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
                url: 'country/select-country-delete',
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

function editUser(id) {
    console.log("inside");
    // Redirect to the user edit page or open a modal for editing
    window.location.href = 'permission_control-edit/' + id;
}



 function deleteCustomer(id) {
    console.log("inside")
    // Send an AJAX request to delete the user
    if (confirm('Are you sure you want to delete this Permission?')) {
        $.ajax({
            url: '/user-management/permission_control-delete/' + id,
            type: 'DELETE',
            data: {
                _token: '{{ csrf_token() }}',
            },
            success: function(result) {
                // Show success message
                $('.alert-success').show();

                // Hide success message after 5 seconds
                setTimeout(function(){
                    $('.alert-success').alert('close');
                }, 5000);

                // Reload the DataTable after success message is shown
                table.ajax.reload(); // Reload the DataTable
            }
        });
    }
}
</script>
@endsection