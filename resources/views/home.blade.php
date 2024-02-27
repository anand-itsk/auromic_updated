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

                        <div class="col-lg-3">
                            <div class="card">
                                <div class="card-body d-flex justify-content-between align-items-center">
                                    <div>
                                        <h4 class="fs-19 mt-0">New Order</h4>
                                        <h4 class="cost-text m-0">7</h4>
                                    </div>
                                    <div class="card-rigth-icon card-box2-blue">
                                        <i class="dripicons-briefcase"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="card">
                                <div class="card-body d-flex justify-content-between align-items-center">
                                    <div>
                                        <h4 class="fs-19 mt-0">Client Company</h4>
                                        <h4 class="cost-text m-0">7</h4>
                                    </div>
                                    <div class="card-rigth-icon  card-box2-pink">
                                        <i class="dripicons-briefcase"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="card">
                                <div class="card-body d-flex justify-content-between align-items-center">
                                    <div>
                                        <h4 class="fs-19 mt-0">Sub-client Company</h4>
                                        <h4 class="cost-text m-0">7</h4>
                                    </div>
                                    <div class="card-rigth-icon card-box2-green">
                                        <i class="dripicons-briefcase"></i>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-3">
                            <div class="card">
                                <div class="card-body d-flex justify-content-between align-items-center">
                                    <div>
                                        <h4 class="fs-19 mt-0">Sub-client Company</h4>
                                        <h4 class="cost-text m-0">7</h4>
                                    </div>
                                    <div class="card-rigth-icon card-box2-green">
                                        <i class="dripicons-briefcase"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- second Row Starts --}}
                    {{-- <div class="row mt-3">

                        <div class="col-lg-3">
                            <div class="card">
                                <div class="card-body d-flex justify-content-between align-items-center">
                                    <div>
                                        <h4 class="fs-19 mt-0">Employee Count</h4>
                                        <h4 class="cost-text m-0">7</h4>
                                    </div>
                                    <div class="card-rigth-icon card-box2-blue">
                                        <i class="dripicons-user"></i>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-3">
                            <div class="card">
                                <div class="card-body d-flex justify-content-between align-items-center">
                                    <div>
                                        <h4 class="fs-19 mt-0">Customer Count</h4>
                                        <h4 class="cost-text m-0">7</h4>
                                    </div>
                                    <div class="card-rigth-icon card-box2-pink">
                                        <i class="dripicons-user"></i>

                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-3">
                            <div class="card">
                                <div class="card-body d-flex justify-content-between align-items-center">
                                    <div>
                                        <h4 class="fs-19 mt-0">Product Count</h4>
                                        <h4 class="cost-text m-0">7</h4>
                                    </div>
                                    <div class="card-rigth-icon card-box2-green">
                                        <i class="dripicons-weight"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="card">
                                <div class="card-body d-flex justify-content-between align-items-center">
                                    <div>
                                        <h4 class="fs-19 mt-0">Order Count</h4>
                                        <h4 class="cost-text m-0">7</h4>
                                    </div>
                                    <div class="card-rigth-icon card-box2-violet">
                                        <i class="dripicons-briefcase"></i>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div> --}}
                    {{-- second Row Ends --}}
                    {{-- test Ends --}}
                </div>
            </div>
            <!-- end page title end breadcrumb -->

            <div class="row mt-3">
                <div class="col-12 col-sm-12 col-md-12 col-lg-4">
                    <div class="card">
                        <h4 class="fs-19 mt-0 px-3 pt-4">Total Records</h4>
                        <div class="card-body content-overflow px-0 pb-0 pt-0 mb-3"id="style-4">

                            <ul class="list-group list-group-flush">
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    Employee Counts
                                    <span class="badge badge-primary badge-pill">14</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    Companies Count
                                    <span class="badge badge-primary badge-pill">20</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    Product Counts
                                    <span class="badge badge-primary badge-pill">11</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    Order Counts
                                    <span class="badge badge-primary badge-pill">100</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    Job Giving without DC
                                    <span class="badge badge-primary badge-pill">18</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    Job Giving with DC
                                    <span class="badge badge-primary badge-pill">18</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    Job Received
                                    <span class="badge badge-primary badge-pill">18</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    Job Reallocation
                                    <span class="badge badge-primary badge-pill">18</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    Direct Job Giving
                                    <span class="badge badge-primary badge-pill">18</span>
                                </li>

                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    Direct Job Received
                                    <span class="badge badge-primary badge-pill">18</span>
                                </li>

                            </ul>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-sm-12 col-md-12 col-lg-8 mt-0 mt-md-0 mt-lg-0 mt-sm-3">
                    <div class="card">
                        <h4 class="fs-19 mt-0 px-3 pt-4">Company Counts</h4>
                        <div class="card-body content-overflow mb-3">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th scope="col">Company Type</th>
                                        <th scope="col">Company Counts
                                        </th>
                                        <th scope="col">Employee Counts</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Master Company</td>
                                        <td>600</td>
                                        <td>100</td>
                                    </tr>
                                    <tr>
                                        <td>Client Company</td>
                                        <td>300</td>
                                        <td>100</td>
                                    </tr>
                                    <tr>
                                        <td>Sub-client Company</td>
                                        <td>100</td>
                                        <td>200</td>
                                    </tr>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>


            </div>
            <!-- end row -->



            {{-- chart Starts  --}}
            <div class="row mt-4">
                <div class="col-xl-6">
                    <div class="card m-b-30">
                        <div class="card-body">
                            <h4 class="mt-0 header-title">Order Details</h4>
                            <ul class="list-inline widget-chart m-t-20 m-b-15 text-center">
                                <li class="list-inline-item">
                                    <h4 class=""><b>3654</b></h4>
                                    <p class="text-muted">Marketplace</p>
                                </li>
                                <li class="list-inline-item">
                                    <h4 class=""><b>954</b></h4>
                                    <p class="text-muted">Last week</p>
                                </li>
                                <li class="list-inline-item">
                                    <h4 class=""><b>8462</b></h4>
                                    <p class="text-muted">Last Month</p>
                                </li>
                            </ul>

                            <div id="morris-bar-example"
                                style="height: 300px; position: relative; -webkit-tap-highlight-color: rgba(0, 0, 0, 0);">
                                <svg height="300" version="1.1" width="516.5" xmlns="http://www.w3.org/2000/svg"
                                    xmlns:xlink="http://www.w3.org/1999/xlink"
                                    style="overflow: hidden; position: relative;">
                                    <desc style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">Created with Raphaël 2.1.2
                                    </desc>
                                    <defs style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></defs><text
                                        x="32.84765625" y="261" text-anchor="end" font-family="sans-serif"
                                        font-size="12px" stroke="none" fill="#888888"
                                        style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: end; font-family: sans-serif; font-size: 12px; font-weight: normal;"
                                        font-weight="normal">
                                        <tspan dy="4" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">0
                                        </tspan>
                                    </text>
                                    <path fill="none" stroke="#eef0f2" d="M45.34765625,261H491.5" stroke-width="0.5"
                                        style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></path><text x="32.84765625"
                                        y="202" text-anchor="end" font-family="sans-serif" font-size="12px"
                                        stroke="none" fill="#888888"
                                        style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: end; font-family: sans-serif; font-size: 12px; font-weight: normal;"
                                        font-weight="normal">
                                        <tspan dy="4" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">25
                                        </tspan>
                                    </text>
                                    <path fill="none" stroke="#eef0f2" d="M45.34765625,202H491.5" stroke-width="0.5"
                                        style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></path><text x="32.84765625"
                                        y="143" text-anchor="end" font-family="sans-serif" font-size="12px"
                                        stroke="none" fill="#888888"
                                        style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: end; font-family: sans-serif; font-size: 12px; font-weight: normal;"
                                        font-weight="normal">
                                        <tspan dy="4" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">50
                                        </tspan>
                                    </text>
                                    <path fill="none" stroke="#eef0f2" d="M45.34765625,143H491.5" stroke-width="0.5"
                                        style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></path><text x="32.84765625"
                                        y="84" text-anchor="end" font-family="sans-serif" font-size="12px"
                                        stroke="none" fill="#888888"
                                        style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: end; font-family: sans-serif; font-size: 12px; font-weight: normal;"
                                        font-weight="normal">
                                        <tspan dy="4" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">75
                                        </tspan>
                                    </text>
                                    <path fill="none" stroke="#eef0f2" d="M45.34765625,84H491.5" stroke-width="0.5"
                                        style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></path><text x="32.84765625"
                                        y="25" text-anchor="end" font-family="sans-serif" font-size="12px"
                                        stroke="none" fill="#888888"
                                        style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: end; font-family: sans-serif; font-size: 12px; font-weight: normal;"
                                        font-weight="normal">
                                        <tspan dy="4" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">100
                                        </tspan>
                                    </text>
                                    <path fill="none" stroke="#eef0f2" d="M45.34765625,25H491.5" stroke-width="0.5"
                                        style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></path><text
                                        x="463.615478515625" y="273.5" text-anchor="middle" font-family="sans-serif"
                                        font-size="12px" stroke="none" fill="#888888"
                                        style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: middle; font-family: sans-serif; font-size: 12px; font-weight: normal;"
                                        font-weight="normal" transform="matrix(1,0,0,1,0,7)">
                                        <tspan dy="4" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">2016
                                        </tspan>
                                    </text><text x="352.077392578125" y="273.5" text-anchor="middle"
                                        font-family="sans-serif" font-size="12px" stroke="none" fill="#888888"
                                        style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: middle; font-family: sans-serif; font-size: 12px; font-weight: normal;"
                                        font-weight="normal" transform="matrix(1,0,0,1,0,7)">
                                        <tspan dy="4" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">2014
                                        </tspan>
                                    </text><text x="240.539306640625" y="273.5" text-anchor="middle"
                                        font-family="sans-serif" font-size="12px" stroke="none" fill="#888888"
                                        style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: middle; font-family: sans-serif; font-size: 12px; font-weight: normal;"
                                        font-weight="normal" transform="matrix(1,0,0,1,0,7)">
                                        <tspan dy="4" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">2012
                                        </tspan>
                                    </text><text x="129.001220703125" y="273.5" text-anchor="middle"
                                        font-family="sans-serif" font-size="12px" stroke="none" fill="#888888"
                                        style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: middle; font-family: sans-serif; font-size: 12px; font-weight: normal;"
                                        font-weight="normal" transform="matrix(1,0,0,1,0,7)">
                                        <tspan dy="4" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">2010
                                        </tspan>
                                    </text>
                                    <rect x="62.078369140625" y="25" width="9.65380859375" height="236" rx="0"
                                        ry="0" fill="#508aeb" stroke="none" fill-opacity="1"
                                        style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); fill-opacity: 1;"></rect>
                                    <rect x="74.732177734375" y="48.60000000000002" width="9.65380859375"
                                        height="212.39999999999998" rx="0" ry="0" fill="#fcc24c"
                                        stroke="none" fill-opacity="1"
                                        style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); fill-opacity: 1;"></rect>
                                    <rect x="117.847412109375" y="84" width="9.65380859375" height="177" rx="0"
                                        ry="0" fill="#508aeb" stroke="none" fill-opacity="1"
                                        style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); fill-opacity: 1;"></rect>
                                    <rect x="130.501220703125" y="107.6" width="9.65380859375" height="153.4"
                                        rx="0" ry="0" fill="#fcc24c" stroke="none" fill-opacity="1"
                                        style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); fill-opacity: 1;"></rect>
                                    <rect x="173.616455078125" y="143" width="9.65380859375" height="118"
                                        rx="0" ry="0" fill="#508aeb" stroke="none" fill-opacity="1"
                                        style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); fill-opacity: 1;"></rect>
                                    <rect x="186.270263671875" y="166.60000000000002" width="9.65380859375"
                                        height="94.39999999999998" rx="0" ry="0" fill="#fcc24c"
                                        stroke="none" fill-opacity="1"
                                        style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); fill-opacity: 1;"></rect>
                                    <rect x="229.385498046875" y="84" width="9.65380859375" height="177" rx="0"
                                        ry="0" fill="#508aeb" stroke="none" fill-opacity="1"
                                        style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); fill-opacity: 1;"></rect>
                                    <rect x="242.039306640625" y="107.6" width="9.65380859375" height="153.4"
                                        rx="0" ry="0" fill="#fcc24c" stroke="none" fill-opacity="1"
                                        style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); fill-opacity: 1;"></rect>
                                    <rect x="285.154541015625" y="143" width="9.65380859375" height="118"
                                        rx="0" ry="0" fill="#508aeb" stroke="none" fill-opacity="1"
                                        style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); fill-opacity: 1;"></rect>
                                    <rect x="297.808349609375" y="166.60000000000002" width="9.65380859375"
                                        height="94.39999999999998" rx="0" ry="0" fill="#fcc24c"
                                        stroke="none" fill-opacity="1"
                                        style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); fill-opacity: 1;"></rect>
                                    <rect x="340.923583984375" y="84" width="9.65380859375" height="177" rx="0"
                                        ry="0" fill="#508aeb" stroke="none" fill-opacity="1"
                                        style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); fill-opacity: 1;"></rect>
                                    <rect x="353.577392578125" y="107.6" width="9.65380859375" height="153.4"
                                        rx="0" ry="0" fill="#fcc24c" stroke="none" fill-opacity="1"
                                        style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); fill-opacity: 1;"></rect>
                                    <rect x="396.692626953125" y="25" width="9.65380859375" height="236" rx="0"
                                        ry="0" fill="#508aeb" stroke="none" fill-opacity="1"
                                        style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); fill-opacity: 1;"></rect>
                                    <rect x="409.346435546875" y="48.60000000000002" width="9.65380859375"
                                        height="212.39999999999998" rx="0" ry="0" fill="#fcc24c"
                                        stroke="none" fill-opacity="1"
                                        style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); fill-opacity: 1;"></rect>
                                    <rect x="452.461669921875" y="48.60000000000002" width="9.65380859375"
                                        height="212.39999999999998" rx="0" ry="0" fill="#508aeb"
                                        stroke="none" fill-opacity="1"
                                        style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); fill-opacity: 1;"></rect>
                                    <rect x="465.115478515625" y="84" width="9.65380859375" height="177" rx="0"
                                        ry="0" fill="#fcc24c" stroke="none" fill-opacity="1"
                                        style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); fill-opacity: 1;"></rect>
                                </svg>
                                <div class="morris-hover morris-default-style"
                                    style="left: 21.1619px; top: 104px; display: none;">
                                    <div class="morris-hover-row-label">2009</div>
                                    <div class="morris-hover-point" style="color: #508aeb">
                                        Series A:
                                        100
                                    </div>
                                    <div class="morris-hover-point" style="color: #fcc24c">
                                        Series B:
                                        90
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div> <!-- end col -->

                <div class="col-xl-6">
                    <div class="card m-b-30">
                        <div class="card-body">

                            <h4 class="mt-0 header-title">Line Chart</h4>

                            <ul class="list-inline widget-chart m-t-20 m-b-15 text-center">
                                <li class="list-inline-item">
                                    <h4 class=""><b>3654</b></h4>
                                    <p class="text-muted">Marketplace</p>
                                </li>
                                <li class="list-inline-item">
                                    <h4 class=""><b>954</b></h4>
                                    <p class="text-muted">Last week</p>
                                </li>
                                <li class="list-inline-item">
                                    <h4 class=""><b>8462</b></h4>
                                    <p class="text-muted">Last Month</p>
                                </li>
                            </ul>

                            <div id="morris-line-example"
                                style="height: 300px; position: relative; -webkit-tap-highlight-color: rgba(0, 0, 0, 0);">
                                <svg height="300" version="1.1" width="516.5" xmlns="http://www.w3.org/2000/svg"
                                    xmlns:xlink="http://www.w3.org/1999/xlink"
                                    style="overflow: hidden; position: relative; left: -0.5px;">
                                    <desc style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">Created with Raphaël 2.1.2
                                    </desc>
                                    <defs style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></defs><text
                                        x="32.84765625" y="261" text-anchor="end" font-family="sans-serif"
                                        font-size="12px" stroke="none" fill="#888888"
                                        style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: end; font-family: sans-serif; font-size: 12px; font-weight: normal;"
                                        font-weight="normal">
                                        <tspan dy="4" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">0
                                        </tspan>
                                    </text>
                                    <path fill="none" stroke="#eef0f2" d="M45.34765625,261H491.5" stroke-width="0.5"
                                        style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></path><text x="32.84765625"
                                        y="202" text-anchor="end" font-family="sans-serif" font-size="12px"
                                        stroke="none" fill="#888888"
                                        style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: end; font-family: sans-serif; font-size: 12px; font-weight: normal;"
                                        font-weight="normal">
                                        <tspan dy="4" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">25
                                        </tspan>
                                    </text>
                                    <path fill="none" stroke="#eef0f2" d="M45.34765625,202H491.5" stroke-width="0.5"
                                        style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></path><text x="32.84765625"
                                        y="143" text-anchor="end" font-family="sans-serif" font-size="12px"
                                        stroke="none" fill="#888888"
                                        style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: end; font-family: sans-serif; font-size: 12px; font-weight: normal;"
                                        font-weight="normal">
                                        <tspan dy="4" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">50
                                        </tspan>
                                    </text>
                                    <path fill="none" stroke="#eef0f2" d="M45.34765625,143H491.5" stroke-width="0.5"
                                        style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></path><text x="32.84765625"
                                        y="84" text-anchor="end" font-family="sans-serif" font-size="12px"
                                        stroke="none" fill="#888888"
                                        style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: end; font-family: sans-serif; font-size: 12px; font-weight: normal;"
                                        font-weight="normal">
                                        <tspan dy="4" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">75
                                        </tspan>
                                    </text>
                                    <path fill="none" stroke="#eef0f2" d="M45.34765625,84H491.5" stroke-width="0.5"
                                        style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></path><text x="32.84765625"
                                        y="25" text-anchor="end" font-family="sans-serif" font-size="12px"
                                        stroke="none" fill="#888888"
                                        style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: end; font-family: sans-serif; font-size: 12px; font-weight: normal;"
                                        font-weight="normal">
                                        <tspan dy="4" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">100
                                        </tspan>
                                    </text>
                                    <path fill="none" stroke="#eef0f2" d="M45.34765625,25H491.5" stroke-width="0.5"
                                        style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></path><text
                                        x="491.49999999999994" y="273.5" text-anchor="middle" font-family="sans-serif"
                                        font-size="12px" stroke="none" fill="#888888"
                                        style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: middle; font-family: sans-serif; font-size: 12px; font-weight: normal;"
                                        font-weight="normal" transform="matrix(1,0,0,1,0,7)">
                                        <tspan dy="4" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">2015
                                        </tspan>
                                    </text><text x="417.17521429997714" y="273.5" text-anchor="middle"
                                        font-family="sans-serif" font-size="12px" stroke="none" fill="#888888"
                                        style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: middle; font-family: sans-serif; font-size: 12px; font-weight: normal;"
                                        font-weight="normal" transform="matrix(1,0,0,1,0,7)">
                                        <tspan dy="4" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">2014
                                        </tspan>
                                    </text><text x="342.85042859995434" y="273.5" text-anchor="middle"
                                        font-family="sans-serif" font-size="12px" stroke="none" fill="#888888"
                                        style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: middle; font-family: sans-serif; font-size: 12px; font-weight: normal;"
                                        font-weight="normal" transform="matrix(1,0,0,1,0,7)">
                                        <tspan dy="4" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">2013
                                        </tspan>
                                    </text><text x="268.32201335006846" y="273.5" text-anchor="middle"
                                        font-family="sans-serif" font-size="12px" stroke="none" fill="#888888"
                                        style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: middle; font-family: sans-serif; font-size: 12px; font-weight: normal;"
                                        font-weight="normal" transform="matrix(1,0,0,1,0,7)">
                                        <tspan dy="4" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">2012
                                        </tspan>
                                    </text><text x="193.99722765004563" y="273.5" text-anchor="middle"
                                        font-family="sans-serif" font-size="12px" stroke="none" fill="#888888"
                                        style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: middle; font-family: sans-serif; font-size: 12px; font-weight: normal;"
                                        font-weight="normal" transform="matrix(1,0,0,1,0,7)">
                                        <tspan dy="4" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">2011
                                        </tspan>
                                    </text><text x="119.67244195002282" y="273.5" text-anchor="middle"
                                        font-family="sans-serif" font-size="12px" stroke="none" fill="#888888"
                                        style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: middle; font-family: sans-serif; font-size: 12px; font-weight: normal;"
                                        font-weight="normal" transform="matrix(1,0,0,1,0,7)">
                                        <tspan dy="4" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">2010
                                        </tspan>
                                    </text><text x="45.34765625" y="273.5" text-anchor="middle" font-family="sans-serif"
                                        font-size="12px" stroke="none" fill="#888888"
                                        style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: middle; font-family: sans-serif; font-size: 12px; font-weight: normal;"
                                        font-weight="normal" transform="matrix(1,0,0,1,0,7)">
                                        <tspan dy="4" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">2009
                                        </tspan>
                                    </text>
                                    <path fill="none" stroke="#fcc24c"
                                        d="M45.34765625,48.60000000000002C63.9288526750057,63.350000000000016,101.09124552501711,92.85,119.67244195002282,107.6C138.25363837502852,122.35,175.41603122503992,166.60000000000002,193.99722765004563,166.60000000000002C212.57842407505134,166.60000000000002,249.74081692506275,107.6,268.32201335006846,107.6C286.95411716253994,107.6,324.21832478748286,166.60000000000002,342.85042859995434,166.60000000000002C361.43162502496006,166.60000000000002,398.5940178749714,122.35,417.17521429997714,107.6C435.75641072498286,92.85,472.91880357499423,63.350000000000016,491.49999999999994,48.60000000000002"
                                        stroke-width="3" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></path>
                                    <path fill="none" stroke="#508aeb"
                                        d="M45.34765625,25C63.9288526750057,39.75,101.09124552501711,69.25,119.67244195002282,84C138.25363837502852,98.75,175.41603122503992,143,193.99722765004563,143C212.57842407505134,143,249.74081692506275,84,268.32201335006846,84C286.95411716253994,84,324.21832478748286,143,342.85042859995434,143C361.43162502496006,143,398.5940178749714,98.75,417.17521429997714,84C435.75641072498286,69.25,472.91880357499423,39.75,491.49999999999994,25"
                                        stroke-width="3" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></path>
                                    <circle cx="45.34765625" cy="48.60000000000002" r="4" fill="#fcc24c"
                                        stroke="#ffffff" stroke-width="1"
                                        style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle>
                                    <circle cx="119.67244195002282" cy="107.6" r="4" fill="#fcc24c" stroke="#ffffff"
                                        stroke-width="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle>
                                    <circle cx="193.99722765004563" cy="166.60000000000002" r="4" fill="#fcc24c"
                                        stroke="#ffffff" stroke-width="1"
                                        style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle>
                                    <circle cx="268.32201335006846" cy="107.6" r="4" fill="#fcc24c" stroke="#ffffff"
                                        stroke-width="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle>
                                    <circle cx="342.85042859995434" cy="166.60000000000002" r="4" fill="#fcc24c"
                                        stroke="#ffffff" stroke-width="1"
                                        style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle>
                                    <circle cx="417.17521429997714" cy="107.6" r="4" fill="#fcc24c" stroke="#ffffff"
                                        stroke-width="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle>
                                    <circle cx="491.49999999999994" cy="48.60000000000002" r="4" fill="#fcc24c"
                                        stroke="#ffffff" stroke-width="1"
                                        style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle>
                                    <circle cx="45.34765625" cy="25" r="4" fill="#508aeb" stroke="#ffffff"
                                        stroke-width="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle>
                                    <circle cx="119.67244195002282" cy="84" r="4" fill="#508aeb" stroke="#ffffff"
                                        stroke-width="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle>
                                    <circle cx="193.99722765004563" cy="143" r="4" fill="#508aeb" stroke="#ffffff"
                                        stroke-width="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle>
                                    <circle cx="268.32201335006846" cy="84" r="4" fill="#508aeb" stroke="#ffffff"
                                        stroke-width="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle>
                                    <circle cx="342.85042859995434" cy="143" r="4" fill="#508aeb" stroke="#ffffff"
                                        stroke-width="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle>
                                    <circle cx="417.17521429997714" cy="84" r="4" fill="#508aeb" stroke="#ffffff"
                                        stroke-width="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle>
                                    <circle cx="491.49999999999994" cy="25" r="4" fill="#508aeb" stroke="#ffffff"
                                        stroke-width="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle>
                                </svg>
                                <div class="morris-hover morris-default-style"
                                    style="left: 0px; top: 35px; display: none;">
                                    <div class="morris-hover-row-label">2009</div>
                                    <div class="morris-hover-point" style="color: #508aeb">
                                        Series A:
                                        100
                                    </div>
                                    <div class="morris-hover-point" style="color: #fcc24c">
                                        Series B:
                                        90
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div> <!-- end col -->
            </div>
            {{-- chart Ends  --}}

            <div class="row">
                <div class="col-xl-4">
                    <div class="card m-b-30">
                        <div class="card-body">
                            <h4 class="mt-0 header-title mb-4">Monthly Earning</h4>
                            <div class="">

                                <div class="row align-items-center mb-5">
                                    <div class="col-md-6">
                                        <div class="pl-3">
                                            <h3>$6451</h3>
                                            <h6>Monthly Earning</h6>
                                            <p class="text-muted">Sed ut perspiciatis unde omnis</p>
                                            <a href="#" class="text-primary">Learn more...</a>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="text-center">
                                            <span class="peity-pie"
                                                data-peity="{ &quot;fill&quot;: [&quot;#508aeb&quot;, &quot;#f2f2f2&quot;]}"
                                                data-width="84" data-height="84" style="display: none;">6/8</span><svg
                                                class="peity" height="84" width="84">
                                                <path d="M 42 0 A 42 42 0 1 1 0 42.00000000000001 L 42 42" data-value="6"
                                                    fill="#508aeb"></path>
                                                <path d="M 0 42.00000000000001 A 42 42 0 0 1 41.99999999999999 0 L 42 42"
                                                    data-value="2" fill="#f2f2f2"></path>
                                            </svg>
                                        </div>
                                    </div>
                                </div>
                                <div class="row text-center">
                                    <div class="col-6">
                                        <div>
                                            <div class="mb-4">
                                                <span class="peity-donut"
                                                    data-peity="{ &quot;fill&quot;: [&quot;#508aeb&quot;, &quot;#f2f2f2&quot;], &quot;innerRadius&quot;: 22, &quot;radius&quot;: 32 }"
                                                    data-width="60" data-height="60"
                                                    style="display: none;">2,4</span><svg class="peity" height="60"
                                                    width="60">
                                                    <path
                                                        d="M 30.000000000000004 0 A 30 30 0 0 1 55.98076211353316 44.99999999999999 L 49.05255888325765 41 A 22 22 0 0 0 30 8"
                                                        data-value="2" fill="#508aeb"></path>
                                                    <path
                                                        d="M 55.98076211353316 44.99999999999999 A 30 30 0 1 1 29.999999999999993 0 L 29.999999999999996 8 A 22 22 0 1 0 49.05255888325765 41"
                                                        data-value="4" fill="#f2f2f2"></path>
                                                </svg>
                                            </div>
                                            <h4>42%</h4>
                                            <p class="mb-0 text-muted">Online Earning</p>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div>
                                            <div class="mb-4">
                                                <span class="peity-donut"
                                                    data-peity="{ &quot;fill&quot;: [&quot;#508aeb&quot;, &quot;#f2f2f2&quot;], &quot;innerRadius&quot;: 22, &quot;radius&quot;: 32 }"
                                                    data-width="60" data-height="60"
                                                    style="display: none;">8,4</span><svg class="peity" height="60"
                                                    width="60">
                                                    <path
                                                        d="M 30.000000000000004 0 A 30 30 0 1 1 4.019237886466847 45.000000000000014 L 10.947441116742354 41.00000000000001 A 22 22 0 1 0 30 8"
                                                        data-value="8" fill="#508aeb"></path>
                                                    <path
                                                        d="M 4.019237886466847 45.000000000000014 A 30 30 0 0 1 29.999999999999993 0 L 29.999999999999996 8 A 22 22 0 0 0 10.947441116742354 41.00000000000001"
                                                        data-value="4" fill="#f2f2f2"></path>
                                                </svg>
                                            </div>
                                            <h4>58%</h4>
                                            <p class="text-muted mb-0">Offline Earning</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card m-b-30 blog-wid">
                        <div class="card-body">
                            <div class="float-left p-1 mr-3">
                                <div class="text-center bg-primary rounded p-3">
                                    <p class="text-white-50 mb-4">October</p>
                                    <h2 class="text-white mb-0">24</h2>
                                </div>
                            </div>
                            <div class="post-details p-2">
                                <h6 class="mt-0"><a href="#" class="text-dark">It will be as simple as
                                        Occidental</a></h6>
                                <p class="text-muted">Everyone realizes why a new common language would be desirable.</p>
                                <p class="mb-0">By <a href="#" class="text-primary">Daniel Sons</a></p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-4">
                    <div class="card m-b-30">
                        <div class="card-body">
                            <h4 class="mt-0 header-title mb-4">Recent Activity Feed</h4>
                            <ul class="list-unstyled activity-list">
                                <li class="activity-item">
                                    <span class="activity-date">12 Oct</span>
                                    <span class="activity-text">Responded to need “Volunteer Activities”</span>
                                    <p class="text-muted mt-2">Everyone realizes why a new common language would be
                                        desirable common words.</p>
                                </li>
                                <li class="activity-item">
                                    <span class="activity-date">13 Oct</span>
                                    <span class="activity-text">Uploaded this Images</span>
                                    <p class="text-muted mt-2">Their separate existence is a myth</p>
                                    <div>
                                        <a href="#" class="activity-item-img"><img
                                                src="assets/images/small/img-1.jpg" alt=""
                                                class="rounded mb-2"></a>
                                        <a href="#" class="activity-item-img"><img
                                                src="assets/images/small/img-2.jpg" alt=""
                                                class="rounded mb-2"></a>
                                    </div>
                                </li>
                                <li class="activity-item">
                                    <span class="activity-date">14 Oct</span>
                                    <span class="activity-text">Uploaded this File</span>
                                    <p class="text-muted mt-2 mb-4">The new common language will be more simple and regular
                                        their pronunciation.</p>
                                    <div>
                                        <a href="#" class="text-muted">
                                            <i class="ion-ios7-folder h1 p-3 bg-light rounded"></i>
                                            <p class="mt-2 mb-0">background.psd</p>
                                        </a>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="card bg-primary m-b-30 text-white weather-box">
                                <div class="card-body">
                                    <div class="text-center">
                                        <div>
                                            <canvas id="rain" width="56" height="56"></canvas>
                                        </div>
                                        <div>
                                            <h3>28° c</h3>
                                            <h6>Heavy rain</h6>
                                            <h4 class="mt-4">New York</h4>
                                        </div>
                                    </div>
                                    <div class="weather-icon">
                                        <i class="mdi mdi-weather-pouring"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="card bg-warning m-b-30 text-white weather-box">
                                <div class="card-body">
                                    <div class="text-center">
                                        <div>
                                            <canvas id="partly-cloudy-day" width="56" height="56"></canvas>
                                        </div>
                                        <div>
                                            <h3>32° c</h3>
                                            <h6>Partly cloudy</h6>
                                            <h4 class="mt-4">California</h4>
                                        </div>
                                    </div>
                                    <div class="weather-icon">
                                        <i class="mdi mdi-weather-partlycloudy"></i>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card m-b-30">
                                <div class="card-body">
                                    <h4 class="mt-0 header-title mb-4">Sales Analytics</h4>

                                    <div id="morris-donut-example" class="morris-charts" style="height: 265px">

                                        <svg height="265" version="1.1" width="401"
                                            xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                            style="overflow: hidden; position: relative; top: -0.015625px;">
                                            <desc style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">Created with
                                                Raphaël 2.1.2</desc>
                                            <defs style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></defs>
                                            <path fill="none" stroke="#54cc96"
                                                d="M200.5,214.16666666666669A81.66666666666667,81.66666666666667,0,0,0,258.26917297721667,190.2249261409044"
                                                stroke-width="2" opacity="0"
                                                style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); opacity: 0;"></path>
                                            <path fill="#54cc96" stroke="#ffffff"
                                                d="M200.5,217.16666666666669A84.66666666666667,84.66666666666667,0,0,0,260.391305862094,192.34543363179475L283.6168713243627,215.55321005987264A117.5,117.5,0,0,1,200.5,250Z"
                                                stroke-width="3" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">
                                            </path>
                                            <path fill="none" stroke="#508aeb"
                                                d="M258.26917297721667,190.2249261409044A81.66666666666667,81.66666666666667,0,0,0,180.97960701778317,53.200575649855665"
                                                stroke-width="2" opacity="1"
                                                style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); opacity: 1;"></path>
                                            <path fill="#508aeb" stroke="#ffffff"
                                                d="M260.391305862094,192.34543363179475A84.66666666666667,84.66666666666667,0,0,0,180.26253135721194,50.28753557168709L171.21941052667478,13.550863474783498A122.5,122.5,0,0,1,287.153759465825,219.08738921135657Z"
                                                stroke-width="3" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">
                                            </path>
                                            <path fill="none" stroke="#ff5560"
                                                d="M180.97960701778317,53.200575649855665A81.66666666666667,81.66666666666667,0,0,0,118.98331808519046,127.55277713821106"
                                                stroke-width="2" opacity="0"
                                                style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); opacity: 0;"></path>
                                            <path fill="#ff5560" stroke="#ffffff"
                                                d="M180.26253135721194,50.28753557168709A84.66666666666667,84.66666666666667,0,0,0,115.98882772913623,127.37104242083922L83.21579438787607,125.38205690293631A117.5,117.5,0,0,1,172.41453662762683,18.40593027173111Z"
                                                stroke-width="3" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">
                                            </path>
                                            <path fill="none" stroke="#fcc24c"
                                                d="M118.98331808519046,127.55277713821106A81.66666666666667,81.66666666666667,0,0,0,200.47434366041773,214.16666263657822"
                                                stroke-width="2" opacity="0"
                                                style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); opacity: 0;"></path>
                                            <path fill="#fcc24c" stroke="#ffffff"
                                                d="M115.98882772913623,127.37104242083922A84.66666666666667,84.66666666666667,0,0,0,200.47340118263716,217.1666624885342L200.46308628692753,249.99999420160748A117.5,117.5,0,0,1,83.21579438787607,125.38205690293631Z"
                                                stroke-width="3" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">
                                            </path><text x="200.5" y="122.5" text-anchor="middle"
                                                font-family="&quot;Arial&quot;" font-size="15px" stroke="none"
                                                fill="#000000"
                                                style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: middle; font-family: Arial; font-size: 15px; font-weight: 800;"
                                                font-weight="800" transform="matrix(1.6333,0,0,1.6333,-127.0419,-85.5)"
                                                stroke-width="0.6122448979591836">
                                                <tspan dy="4.5"
                                                    style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">Ethereum</tspan>
                                            </text><text x="200.5" y="142.5" text-anchor="middle"
                                                font-family="&quot;Arial&quot;" font-size="14px" stroke="none"
                                                fill="#000000"
                                                style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: middle; font-family: Arial; font-size: 14px;"
                                                transform="matrix(1.1836,0,0,1.1836,-36.8272,-24.0483)"
                                                stroke-width="0.8448979591836734">
                                                <tspan dy="4.5"
                                                    style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">42</tspan>
                                            </text>
                                        </svg>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- Testing Ends --}}

        </div>
        <!-- end container -->
    </div>
@endsection
