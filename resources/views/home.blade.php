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
                                <li class="breadcrumb-item active">Dashboard</li>
                            </ol>
                        </div>
                        <h4 class="page-title">Dashboard</h4>

                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card m-b-30">
                                <div class="card-body">

                                    <h4 class="mt-0 header-title"> You are logged in!</h4>
                                    <p class="text-muted m-b-0 font-14">The Dashboard page is under developement.</p>

                                    {{-- <div class="">
                                        <div class="alert alert-success" role="alert">
                                            You are logged in!
                                        </div>
                                    </div> --}}
                                </div>
                            </div>
                        </div>


                    </div>
                </div>
            </div>
            <!-- end page title end breadcrumb -->


            <!-- end row -->
        </div> <!-- end container -->
    </div>
@endsection
