@extends('layouts.app')

@section('content')
    <div class="wrapper">
        <div class="container-fluid">

            <!-- Page-Title -->
            <div class="row">
                <div class="col-sm-12">
                    <div class="page-title-box">
                        <div class="btn-group float-right">
                            <ol class="breadcrumb hide-phone p-0 m-0">
                                <li class="breadcrumb-item"><a href="#">Auromics</a></li>
                                <li class="breadcrumb-item active">Settings</li>
                            </ol>
                        </div>
                        <h4 class="page-title">Masters</h4>

                    </div>
                    <div class="row">
                        <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                            <div class="card m-b-30">

                                <div class="card-body">
                                    <h4 class="mt-0 header-title"> User Management</h4>
                                    <a class="text-muted m-b-0 font-14" href="{{ route('users') }}">Users</a>
                                    {{-- <br>
                                    <a class="text-muted m-b-0 font-14" href="{{ route('roles') }}">Roles</a> --}}
                                    <br>
                                    <a class="text-muted m-b-0 font-14" href="{{ route('permissions') }}">Permissions</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                            <div class="card m-b-30">

                                <div class="card-body">
                                    <h4 class="mt-0 header-title">Common</h4>
                                    <a class="text-muted m-b-0 font-14" href="{{route('countries')}}">Country</a>
                                    <br>
                                    <a class="text-muted m-b-0 font-14" href="{{route('states')}}">State</a> 
                                    <br>
                                    <a class="text-muted m-b-0 font-14" href="{{route('districts')}}">Districts</a>
                                    <br>
                                    <a class="text-muted m-b-0 font-14" href="{{route('religions')}}">Religion</a>
                                    <br>
                                    <a class="text-muted m-b-0 font-14" href="{{route('castes')}}">Caste</a>
                                     <br>
                                    <a class="text-muted m-b-0 font-14" href="{{route('nationalities')}}">Nationality</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                            <div class="card m-b-30">

                                <div class="card-body">
                                    <h4 class="mt-0 header-title">Specified</h4>
                                    <a class="text-muted m-b-0 font-14" href="{{route('company_types')}}">Company Type for (companies)</a>
                                    <br>
                                    <a class="text-muted m-b-0 font-14" href="{{route('resigning_reasons')}}">Resigning Reason for (employee.personal)</a> 
                                    <br>
                                    <a class="text-muted m-b-0 font-14" href="{{route('local_offices')}}">Local Offices for (employee.finance)</a>
                                    <br>
                                    <a class="text-muted m-b-0 font-14" href="{{route('esi_dispensaries')}}">ESI Dispensary for (employee.finance)</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                            <div class="card m-b-30">

                                <div class="card-body">
                                    <h4 class="mt-0 header-title">Products-Models-Master</h4>
                                    <a class="text-muted m-b-0 font-14" href="{{route('raw_material_types')}}">Raw Material Type</a>
                                    <br>
                                    <a class="text-muted m-b-0 font-14" href="{{route('raw_materials')}}">Raw Material</a> 
                                    <br>
                                    <a class="text-muted m-b-0 font-14" href="{{route('products')}}">Product</a>
                                    <br>
                                    <a class="text-muted m-b-0 font-14" href="{{route('product_sizes')}}">Product Size</a>
                                    <br>
                                    <a class="text-muted m-b-0 font-14" href="{{route('product_colors')}}">Product Color</a>
                                     <br>
                                    <a class="text-muted m-b-0 font-14" href="{{route('order_statuses')}}">Order Status</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
            <!-- end page title end breadcrumb -->
        </div> <!-- end container -->
    </div>
@endsection
