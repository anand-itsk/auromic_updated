@extends('layouts.app')

@section('content')
    <div class="wrapper">
        <div class="container">

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
                        <h4 class="page-title">Setup</h4>
                    </div>
                    <div class="row extra-small-font">
                        <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                            <div class="card m-b-30 h-100">

                                <div class="card-body">
                                    <h4 class="mt-0 extra-medium-font"> User Management</h4>
                                    <div class="link-list">
                                        <a class="text-muted" href="{{ route('users') }}">Users</a>
                                    </div>
                                    <div class="link-list">
                                        <a class="text-muted" href="{{ route('permissions') }}">Permissions</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                            <div class="card m-b-30 h-100">

                                <div class="card-body">
                                    <h4 class="mt-0 extra-medium-font">Common</h4>

                                    <div class="link-list">
                                        <a class="text-muted" href="{{ route('countries') }}">Country</a>
                                    </div>
                                    <div class="link-list">
                                        <a class="text-muted" href="{{ route('states') }}">State</a>
                                    </div>
                                    <div class="link-list">
                                        <a class="text-muted" href="{{ route('districts') }}">Districts</a>
                                    </div>
                                    <div class="link-list">
                                        <a class="text-muted" href="{{ route('religions') }}">Religion</a>
                                    </div>
                                    <div class="link-list">
                                        <a class="text-muted" href="{{ route('castes') }}">Caste</a>
                                    </div>
                                    <div class="link-list">
                                        <a class="text-muted" href="{{ route('nationalities') }}">Nationality</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                            <div class="card m-b-30 h-100">

                                <div class="card-body">
                                    <h4 class="mt-0 extra-medium-font">Specified</h4>
                                    <div class="link-list">
                                        <a class="text-muted" href="{{ route('company_types') }}">Company Type</a>
                                    </div>
                                    <div class="link-list">
                                        <a class="text-muted" href="{{ route('resigning_reasons') }}">Resigning</a>
                                    </div>
                                    <div class="link-list">
                                        <a class="text-muted" href="{{ route('local_offices') }}">Local Offices</a>
                                    </div>
                                    <div class="link-list">
                                        <a class="text-muted" href="{{ route('esi_dispensaries') }}">ESI
                                            Dispensary</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                            <div class="card m-b-30 h-100">

                                <div class="card-body">
                                    <h4 class="mt-0 extra-medium-font">Products/Models</h4>
                                    <div class="link-list">
                                        <a class="text-muted m-b-0" href="{{ route('raw_material_types') }}">Raw
                                            Material Type</a>
                                    </div>
                                    <div class="link-list">
                                        <a class="text-muted m-b-0" href="{{ route('raw_materials') }}">Raw
                                            Material</a>
                                    </div>
                                    <div class="link-list">
                                        <a class="text-muted m-b-0" href="{{ route('products') }}">Product</a>
                                    </div>
                                    <div class="link-list">
                                        <a class="text-muted m-b-0" href="{{ route('product_sizes') }}">Product
                                            Size</a>
                                    </div>
                                    <div class="link-list">
                                        <a class="text-muted m-b-0" href="{{ route('product_colors') }}">Product
                                            Color</a>
                                    </div>
                                    <div class="link-list">
                                        <a class="text-muted m-b-0" href="{{ route('order_statuses') }}">Order
                                            Status</a>
                                    </div>
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
