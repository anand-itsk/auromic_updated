@extends('layouts.app')
@section('title', ' Create Roles&Permission')
<!-- DataTables CSS -->
{{-- @include('links.css.datatable.datatable-css') --}}
@section('content')
<link href="assets/plugins/dropzone/dist/dropzone.css" rel="stylesheet" type="text/css">

<div class="wrapper">
    <div class="container-fluid">
        <!-- Page-Title -->
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
                        <div class="card m-b-30">
                            <div class="card-header pb-0 pt-0 bg-white">
                                <h5>Create Role & Permission</h5>
                            </div>
                            <div class="card-body">
                                <div class="m-b-30">
                                    <form class="row g-3" method="POST" action="{{route('user-management.permission.store')}}">
                                        @csrf
                                        <div class="col-md-12">
                                            <label for="inputFirstName" class="col-sm-2 col-form-label mandatory">Role Name</label>
                                            <input type="text" name="role" class="form-control" value="">
                                            @error('role')
                                            <span class="error" style="color: red;">{{$message}}</span>
                                            @enderror
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
                                                                            <input class="form-check-input" name="permission[]" type="checkbox" value="{{ $value->id }}" id="invalidCheck">
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
                                                                        <input class="form-check-input" name="permission[]" type="checkbox" value="{{ $value->id }}" {{ in_array($value->id, $rolePermissions) ? 'checked' : '' }} id="invalidCheck">
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
                                            <button type="submit" class="btn btn-primary waves-effect waves-light">
                                                Submit
                                            </button>
                                            <a href="{{ route('user-management.permissions') }}" class="btn btn-secondary waves-effect m-l-5">
                                                Cancel
                                            </a>
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