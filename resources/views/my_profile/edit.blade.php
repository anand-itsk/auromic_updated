@extends('layouts.app')
<!-- DataTables CSS -->
@section('content')
    <!-- Add Select2 CSS -->
    @include('links.css.select2.select2')
    @include('links.css.wizard-form.wizard-form')

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
                                            <div class="container">
                                                <div class="picture-container">
                                                    <div class="picture">
                                                        @if (!empty($photoPath))
                                                            <img src="{{ asset('storage/' . $photoPath) }}"
                                                                class="picture-src" id="wizardPicturePreview"
                                                                title="">
                                                        @else
                                                            <img src="" class="picture-src"
                                                                id="wizardPicturePreview" title=""
                                                                style="display: none;">
                                                        @endif
                                                        <input type="file" name="employee_profile" id="wizard-picture"
                                                            class="">
                                                    </div>
                                                    <h6 class="">Choose Picture</h6>
                                                    <p style="color: red;">500x500</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="p-2 mt-1">
                                            <h4 class="card-title m-0">
                                                <input type="text" class="form-control" placeholder="Name"
                                                    value="{{ $user->name }}">
                                            </h4>
                                            <h5 class="m-0">Admin</h5>
                                            <p class="card-text mt-3">Some quick example text to build on the card title and
                                                make
                                                up the bulk of the card's content.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-1">
                                    <a href="{{ route('my-profile.edit') }}"
                                        class="btn btn-primary waves-effect waves-light">Save</a>
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
                                        <span class="mandatory">EMAIL</span>
                                        <input type="email" class="form-control" value="{{ $user->email }}">
                                    </div>
                                </div>

                                <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-6">
                                    <div class="user-info">
                                        <span>COUNTRY</span>
                                        <h5>India</h5>
                                    </div>
                                </div>

                                <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-6">
                                    <div class="user-info">
                                        <span>CREATED ON</span>
                                        <h5>20/10/2020</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- end col -->
        </div>
    </div>

    @include('links.js.select2.select2')
    <script>
        $("#wizard-picture").change(function() {
            readURL(this);
        });

        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('#wizardPicturePreview').attr('src', e.target.result).fadeIn('slow');
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
@endsection
