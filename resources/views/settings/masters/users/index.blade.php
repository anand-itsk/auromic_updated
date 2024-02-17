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
            <div class="col-xl-2">
                <div class="row">
                    <div class="col-12">
                        <div class="card p-2 leftsetup">
                            <h4 class="page-title">Setup</h4>
                            <input type="text" placeholder="search" class="form-control">
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
                                <h5>User Details</h5>
                            </div>

                            <div class="card-body pt-0">
                                <div class="row">
                                    <div class="col-md-6 rightsetup-details">
                                        <div class="d-flex justify-content-between p-2 bd-highlight">
                                            <div>
                                                <button id="deleteButton" class="icon-button delete-color"
                                                    title="Delete Selected Record"><i
                                                        class="fa fa-user-times"></i></button>
                                            </div>
                                            <div>
                                                <a href="{{ route('user-management.import.users.page') }}"
                                                    class="icon-link common-color" title="Import Users">
                                                    <i class="fa fa-upload"></i>
                                                </a>
                                                <a href="{{ route('user-management.user.create') }}"
                                                    class="icon-link common-color" title="Create New User">
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
                                                    <th>Email</th>
                                                    <th>Role</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                        </table>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-11">
                                                    <div class="d-flex">
                                                        <div class="p-2">
                                                            @if (!empty($user->profile_image))
                                                            <img src="{{ asset('/storage/' . $user->profile_image) }}"
                                                                alt="Profile Image"
                                                                style="width: 80px; height: 80px;">
                                                            @else
                                                            <img class="profile-image rounded-circle"
                                                                src="{{ asset('assets/images/no-profile.png') }}"
                                                                alt="No Profile Image">
                                                            @endif
                                                        </div>
                                                        <div class="p-2 mt-1">
                                                            <h4 class="card-title m-0" id="user_name">{{ $user->name }}
                                                            </h4>
                                                            @foreach($user->roles as $role)
                                                            <h5 class="m-0">{{ $role->name }}</h5>
                                                            @endforeach
                                                            <p class="card-text mt-3">
                                                                {{ $user->remark}}
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                                {{-- <div class="col-1">
                                                        <a href="{{ route('my-profile.edit') }}"
                                                class="btn btn-primary waves-effect waves-light">Edit</a>
                                            </div> --}}
                                        </div>
                                        <div class="card m-b-30">
                                            <h5 class="ml-3 mb-0">Information
                                            </h5>
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-6">
                                                        <div class="user-info">
                                                            <span>USER ID</span>
                                                            <h5>{{ $user->id }}</h5>
                                                        </div>
                                                    </div>

                                                    <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-6">
                                                        <div class="user-info">
                                                            <span>EMAIL</span>
                                                            <h5>{{ $user->email}}</h5>
                                                        </div>
                                                    </div>

                                                    <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-6">
                                                        <div class="user-info">
                                                            <span>COUNTRY</span>
                                                            <h5>{{ $user->country->name }}</h5>
                                                        </div>
                                                    </div>

                                                    <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-6">
                                                        <div class="user-info">

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
        ajax: '{{route('user-management.users.data')}}',
        columns: [{
                data: 'id',
                name: 'id'
            },
            {
                data: 'name',
                name: 'name'
            },
            {
                data: 'email',
                name: 'email'
            },
            {
                data: 'role',
                name: 'role'
            },
            {
                data: null,
                orderable: false,
                searchable: false,
                render: function(data, type, row) {
                    return `
                        <button onclick="editUser(${row.id})" class="icon-button primary-color"><i class="fa fa-edit"></i></button>
                        <button onclick="deleteUser(${row.id})" class="icon-button delete-color"><i class="fa fa-trash"></i></button>
                        <button onclick="blockUser(${row.id})" class="icon-button common-color"><i class="fa fa-user-times"></i></button>
                        <button onclick="showUser(${row.id})" class="icon-button common-color"><i class="fa fa-eye"></i></button>
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
                url: '/user-management/select-user-delete',
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
    window.location.href = '/user-management/user/edit/' + id;
}



function deleteUser(id) {
    // Send an AJAX request to delete the user
    if (confirm('Are you sure you want to delete this user?')) {
        $.ajax({
            url: '/user-management/user/delete/' + id,
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

function blockUser(id) {
    // Send an AJAX request to block the user
    $.ajax({
        url: '/user/block/' + id,
        type: 'POST',
        data: {
            _token: '{{ csrf_token() }}',
            is_blocked: true, // Assuming you have an 'is_blocked' attribute
        },
        success: function(result) {
            table.ajax.reload(); // Reload the DataTable
        }
    });
}

function showUser(id) {
    // Send an AJAX request to delete the user
    $.ajax({
        url: '/user/show/' + id,
        type: 'DELETE',
        data: {
            _token: '{{ csrf_token() }}',
        },
        success: function(response) {
            // Assuming response is the employee object
            console.log(response.user.name);
            // console.log(response.user[profile_image])
            if (response.user.profile_image) {
                console.log(response);
                var photoUrl = '/storage/' + response.user.profile_image;
            } else {
                var photoUrl = 'assets/images/no-profile.png';
            }

            // Update the HTML elements
            // $(".profile-image").attr("src", photoUrl);
            $("#user_name").text(response.user.name); // Assuming 'name' is part of the response
            $(".card-text").text(response
                .description); // Assuming 'description' is part of the response
            // And so on for other elements
        },
        error: function(xhr, status, error) {
            // Handle error
        }
    });
}
</script>
@endsection
{{--
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
                    <li class="breadcrumb-item active">Users</li>
                </ol>
            </div>
            <h4 class="page-title">Users</h4>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card m-b-30">
                    <div class="d-flex justify-content-between p-2 bd-highlight">
                        <div>
                            <button id="deleteButton" class="icon-button delete-color" title="Delete Selected Record"><i
                                    class="fa fa-user-times"></i></button>
                        </div>
                        <div>
                            <a href="{{ route('import.users.page') }}" class="icon-link common-color"
                                title="Import Users">
                                <i class="fa fa-upload"></i>
                            </a>
                            <a href="{{ route('user.create') }}" class="icon-link common-color" title="Create New User">
                                <i class="fa fa-user-plus"></i>
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <table id="users-table" class="table table-striped table-bordered dt-responsive nowrap"
                            style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Role</th>
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
<!-- DataTables JS -->
@include('links.js.datatable.datatable-js')


<script>
var table;
$(document).ready(function() {
    table = $('#users-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{{ route('
        user - management.users.data ') }}',
        columns: [{
                data: 'id',
                name: 'id'
            },
            {
                data: 'name',
                name: 'name'
            },
            {
                data: 'email',
                name: 'email'
            },
            {
                data: 'role',
                name: 'role'
            },
            {
                data: null,
                orderable: false,
                searchable: false,
                render: function(data, type, row) {
                    return `
                        <button onclick="editUser(${row.id})" class="icon-button primary-color"><i class="fa fa-edit"></i></button>
                        <button onclick="deleteUser(${row.id})" class="icon-button delete-color"><i class="fa fa-trash"></i></button>
                        <button onclick="blockUser(${row.id})" class="icon-button common-color"><i class="fa fa-user-times"></i></button>
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
            'copy', 'csv', 'excel', 'pdf', 'print'
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
                url: 'user-management/select-user-delete',
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
    window.location.href = '/user-management/user/edit/' + id;
}



function deleteUser(id) {
    // Send an AJAX request to delete the user
    if (confirm('Are you sure you want to delete this user?')) {
        $.ajax({
            url: 'user-management/user/delete/' + id,
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

function blockUser(id) {
    // Send an AJAX request to block the user
    $.ajax({
        url: '/user/block/' + id,
        type: 'POST',
        data: {
            _token: '{{ csrf_token() }}',
            is_blocked: true, // Assuming you have an 'is_blocked' attribute
        },
        success: function(result) {
            table.ajax.reload(); // Reload the DataTable
        }
    });
}
</script>
@endsection --}}