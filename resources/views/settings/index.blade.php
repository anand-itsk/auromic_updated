@extends('layouts.app')
@section('title', 'Setting')
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
                                        <a class="text-muted" href="{{ route('user-management.users') }}">Users     ({{ $user_count }})</a>
                                    </div>
                                    <div class="link-list">
                                        <a class="text-muted"
                                            href="{{ route('user-management.permissions') }}">Permissions</a>
                                    </div>
                                    <div class="link-list">
                                        <a class="text-muted"
                                            href="{{ route('user-management.permission_group') }}">Permissions Group</a>
                                    </div>
                                     <div class="link-list">
                                        <a class="text-muted"
                                            href="{{ route('user-management.permission_control') }}">Permissions control</a>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                            <div class="card m-b-30 h-100">

                                <div class="card-body">
                                    <h4 class="mt-0 extra-medium-font">Common</h4>

                                    <div class="link-list">
                                        <a class="text-muted" href="{{ route('common.countries') }}">Country ({{$country_count}})</a>
                                    </div>
                                    <div class="link-list">
                                        <a class="text-muted" href="{{ route('common.states') }}">State ({{$state_count}})</a>
                                    </div>
                                    <div class="link-list">
                                        <a class="text-muted" href="{{ route('common.districts') }}">Districts ({{$districts_count}})</a>
                                    </div>
                                    <div class="link-list">
                                        <a class="text-muted" href="{{ route('common.religions') }}">Religion ({{$religion_count}})</a>
                                    </div>
                                    <div class="link-list">
                                        <a class="text-muted" href="{{ route('common.castes') }}">Caste ({{$caste_count}})</a>
                                    </div>
                                    <div class="link-list">
                                        <a class="text-muted" href="{{ route('common.nationalities') }}">Nationality ({{$nationality_count}})</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                            <div class="card m-b-30 h-100">

                                <div class="card-body">
                                    <h4 class="mt-0 extra-medium-font">Specified</h4>
                                    <div class="link-list">
                                        <a class="text-muted" href="{{ route('specified.company_types') }}">Company Type ({{$company_type_count}})</a>
                                    </div>
                                    <div class="link-list">
                                        <a class="text-muted"
                                            href="{{ route('specified.resigning_reasons') }}">Resigning ({{$resigning_reason_count}})</a>
                                    </div>
                                    <div class="link-list">
                                        <a class="text-muted" href="{{ route('specified.local_offices') }}">Local
                                            Offices ({{$local_offices_count}})</a>
                                    </div>
                                    <div class="link-list">
                                        <a class="text-muted" href="{{ route('specified.esi_dispensaries') }}">ESI
                                            Dispensary ({{$esi_dispensary_count}})</a>
                                    </div>
                                    <div class="link-list">
                                        <a class="text-muted" href="{{ route('specified.esi_dispensaries') }}">
                                            Payment Mode ({{$payment_mode_count}})</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                            <div class="card m-b-30 h-100">

                                <div class="card-body">
                                    <h4 class="mt-0 extra-medium-font">Products/Models</h4>
                                    <div class="link-list">
                                        <a class="text-muted m-b-0" href="{{ route('product-models.raw_material_types') }}">Raw
                                            Material Type ({{$raw_material_type_count}})</a>
                                    </div>
                                    <div class="link-list">
                                        <a class="text-muted m-b-0" href="{{ route('product-models.raw_materials') }}">Raw
                                            Material ({{$raw_material_count}})</a>
                                    </div>
                                    <div class="link-list">
                                        <a class="text-muted m-b-0" href="{{ route('product-models.products') }}">Product ({{$product_count}})</a>
                                    </div>
                                    <div class="link-list">
                                        <a class="text-muted m-b-0" href="{{ route('product-models.product_sizes') }}">Product
                                            Size ({{$product_size_count}})</a>
                                    </div>
                                    <div class="link-list">
                                        <a class="text-muted m-b-0" href="{{ route('product-models.product_colors') }}">Product
                                            Color ({{$product_color_count}})</a>
                                    </div>
                                    <div class="link-list">
                                        <a class="text-muted m-b-0" href="{{ route('product-models.order_statuses') }}">Order
                                            Status ({{$order_status_count}})</a>
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
