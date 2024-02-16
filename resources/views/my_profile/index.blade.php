@extends('layouts.app')
<!-- DataTables CSS -->


@section('content')
    <style>
        .profile-image {
            width: 100px;
            /* Adjust the size as needed */
            height: 100px;
            /* Adjust the size as needed */
            object-fit: cover;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
        }
    </style>
    <div class="wrapper">
        <div class="container">
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
                                <li class="breadcrumb-item active">My Profile</li>
                            </ol>
                        </div>
                        <h4 class="page-title">My Profile</h4>
                    </div>

                </div>
            </div>

            <div class="row">
                <div class="col-md-12">

                    <!-- User -->
                    <div class="card m-b-30">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-11">
                                    <div class="d-flex">
                                        <div class="p-2">
                                            @if (!empty($user->profile_image))
                                               <img src="{{ asset('/storage/' . $user->profile_image) }}" alt="Profile Image" style="width: 200px; height: 200px;">
                                            @else
                                                <img class="profile-image rounded-circle"
                                                    src="{{ asset('assets/images/no-profile.png') }}"
                                                    alt="No Profile Image">
                                            @endif
                                        </div>
                                        <div class="p-2 mt-1">
                                            <h4 class="card-title m-0">{{ $user->name }}</h4>
                                            <h5 class="m-0">Admin</h5>
                                            <p class="card-text mt-3">Some quick example text to build on the card title and
                                                make
                                                up the bulk of the card's content.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-1">
                                    <a href="{{ route('my-profile.edit') }}"
                                        class="btn btn-primary waves-effect waves-light">Edit</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- User Information -->
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
            </div><!-- end col -->
        </div>
    </div>
    <!-- DataTables JS -->
    @include('links.js.datatable.datatable-js')
@endsection
