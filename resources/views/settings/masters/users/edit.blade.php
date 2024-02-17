@extends('layouts.app')
<!-- DataTables CSS -->
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
                                <h5>Edit User</h5>
                            </div>
                            <div class="card-body">
                                <div class="m-b-30">
                                    <form action="{{ route('user-management.user.update', $user->id) }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-group row">
                                            <label for="name" class="col-sm-2 col-form-label">Name</label>
                                            <div class="col-sm-10">
                                                <input class="form-control" type="text" name="name" value="{{$user->name}}" id="name">
                                                @error('name')
                                                <span class="error" style="color: red;">{{ $message }}</span>
                                                @enderror
                                            </div>

                                        </div>
                                        <div class="form-group row">
                                            <label for="email" class="col-sm-2 col-form-label">Email</label>
                                            <div class="col-sm-10">
                                                <input class="form-control" type="email" name="email" value="{{ $user->email }}" id="email">
                                                @error('email')
                                                <span class="error" style="color: red;">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="password" class="col-sm-2 col-form-label">New Password</label>
                                            <div class="col-sm-4">
                                                <input type="password" id="password" class="form-control" name="password" placeholder="Password" />
                                                @error('password')
                                                <span class="error" style="color: red;">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <label for="password_confirmation" class="col-sm-2 col-form-label">Confirm
                                                Password</label>
                                            <div class="col-sm-4">
                                                <input type="password" name="password_confirmation" class="form-control" placeholder="Re-Type Password" />
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Select</label>
                                            <div class="col-sm-10">
                                                <select class="form-control" name="role">
                                                    <!-- <option value="{{$userRole->name ?? ''}}">{{ $userRole->name ?? 'Select' }}</option> -->
                                                    @foreach ($roles as $item)
                                                    <option value="{{ $item->name }}" @if ($userRole && $userRole->name === $item->name) selected @endif>{{ $item->name }}</option>
                                                    @endforeach
                                                </select>
                                                @error('role')
                                                <span class="error" style="color: red;">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>


                                        <div class="form-group">
                                            <div class="d-flex justify-content-evenly">
                                                <button type="submit" class="btn btn-primary waves-effect waves-light">
                                                    Submit
                                                </button>
                                                <!-- <button type="reset" class="btn btn-warning waves-effect waves-light">
                                                Reset
                                            </button> -->
                                                <a href="{{ route('user-management.users') }}" class="btn btn-secondary waves-effect m-l-5">
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
            </div>
        </div>
        <!-- DataTables JS -->
        @include('links.js.datatable.datatable-js')
        <script src="assets/plugins/dropzone/dist/dropzone.js"></script>
        @endsection