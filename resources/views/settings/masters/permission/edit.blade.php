@extends('layouts.app')
<!-- DataTables CSS -->
{{-- @include('links.css.datatable.datatable-css') --}}
@section('content')
    <link href="assets/plugins/dropzone/dist/dropzone.css" rel="stylesheet" type="text/css">

    <div class="wrapper">
        <div class="container-fluid">
            <!-- Page-Title -->
            <div class="row">
                <div class="col-sm-12">
                    <div class="page-title-box">
                        <div class="btn-group float-right">
                            <ol class="breadcrumb hide-phone p-0 m-0">
                                <li class="breadcrumb-item"><a href="#">Aurmics</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('users') }}">Users</a></li>
                                <li class="breadcrumb-item"><a href="#">Import</a></li>
                            </ol>
                        </div>
                        <h4 class="page-title">Create User</h4>
                    </div>
                </div>
            </div>
            <!-- end page title end breadcrumb -->

            <div class="row">
                <div class="col-12">
                    <div class="card m-b-30">
                        <div class="card-body">
                            <div class="m-b-30">
                                <form class="row g-3" method="POST" action="{{ route('permission.update', $role->id) }}">
                                    @csrf
                                    <div class="col-md-12">
                                        <label for="inputFirstName" class="form-label">Role Name</label>
                                        <input type="text" name="name" class="form-control"
                                            value="{{ $role->name }}">
                                    </div>
                                    <div class="col-md-12">
                                        {{-- <hr /> --}}
                                        <div class="card">
                                            <div class="card-body">
                                                <table class="table table-bordered mb-0">
                                                    <thead>
                                                        <tr>
                                                            <th scope="col">Module</th>
                                                            <th scope="col">Permission</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($permissionGroups as $permissionGroup)
                                                            <tr>
                                                                <td>{{ $permissionGroup->name }}</td>
                                                                <td>
                                                                    @if ($permissionGroup->permissions->count())
                                                                        @php
                                                                            $permission = Spatie\Permission\Models\Permission::where('permission_group_id', $permissionGroup->id)->get();
                                                                        @endphp
                                                                        @foreach ($permission as $key => $value)
                                                                            <div class="ml-3 d-flex flex-wrap">
                                                                                <label>
                                                                                    <input class="form-check-input"
                                                                                        name="permission[]" type="checkbox"
                                                                                        value="{{ $value->id }}"
                                                                                        {{ in_array($value->id, $rolePermissions) ? 'checked' : '' }}
                                                                                        id="invalidCheck">
                                                                                    {{ $value->name }}</label>
                                                                            </div>
                                                                        @endforeach
                                                                    @endif
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                    {{-- <tbody>
                                                        @if ($permissionGroups->count())
                                                            @foreach ($permissionGroups as $permissionGroup)
                                                                <tr>
                                                                    <td width="20%">{{ $permissionGroup->name }}</td>
                                                                    <td>
                                                                        <div class="row">
                                                                            @if ($permissionGroup->permissions->count())
                                                                                @php
                                                                                    $permission = Spatie\Permission\Models\Permission::where('permission_group_id', $permissionGroup->id)->get();
                                                                                @endphp
                                                                                @foreach ($permission as $key => $value)
                                                                                    <div class="d-flex flex-wrap">
                                                                                        <label>
                                                                                            <input class="form-check-input"
                                                                                                name="permission[]"
                                                                                                type="checkbox"
                                                                                                value="{{ $value->id }}"
                                                                                                {{ in_array($value->id, $rolePermissions) ? 'checked' : '' }}
                                                                                                id="invalidCheck">
                                                                                            {{ $value->name }}</label>
                                                                                    </div>
                                                                                @endforeach
                                                                            @endif
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                        @endif
                                                    </tbody> --}}

                                                </table>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <button type="submit" class="btn btn-light px-5">
                                            Update
                                        </button>
                                        <button type="reset" class="btn btn-light px-5">
                                            Cancel
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- DataTables JS -->
    @include('links.js.datatable.datatable-js')
    <script src="assets/plugins/dropzone/dist/dropzone.js"></script>
@endsection
