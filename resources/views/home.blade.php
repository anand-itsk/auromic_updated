@extends('layouts.app')
@section('content')
    <style>

    </style>
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
                        <div class="col-lg-3 mt-2">
                            <div class="card">
                                <div class="card-body d-flex justify-content-between align-items-center">
                                    <div>
                                        <h4 class="fs-19 mt-0">New Order</h4>
                                        <h4 class="cost-text m-0">{{ $order_count }}</h4>
                                    </div>
                                    <div class="card-rigth-icon card-box2-blue">
                                        <i class="dripicons-briefcase"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 mt-2">
                            <div class="card">
                                <div class="card-body d-flex justify-content-between align-items-center">
                                    <div>
                                        <h4 class="fs-19 mt-0">Master Company</h4>
                                        <h4 class="cost-text m-0">{{ $master_company_count }}</h4>

                                    </div>
                                    <div class="card-rigth-icon  card-box2-pink">
                                        <i class="dripicons-briefcase"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 mt-2">
                            <div class="card">
                                <div class="card-body d-flex justify-content-between align-items-center">
                                    <div>
                                        <h4 class="fs-19 mt-0">Client Company</h4>
                                        <h4 class="cost-text m-0">{{ $client_company_count }}</h4>
                                    </div>
                                    <div class="card-rigth-icon card-box2-green">
                                        <i class="dripicons-briefcase"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 mt-2">
                            <div class="card">
                                <div class="card-body d-flex justify-content-between align-items-center">
                                    <div>
                                        <h4 class="fs-19 mt-0">Sub-client Company</h4>
                                        <h4 class="cost-text m-0">{{ $subclient_company_count }}</h4>
                                    </div>
                                    <div class="card-rigth-icon card-box2-violet">
                                        <i class="dripicons-briefcase"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end page title end breadcrumb -->

            <div class="row mt-2">
                <div class="col-12 col-sm-12 col-md-12 col-lg-4  mt-3 ">
                    <div class="card">
                        <h4 class="fs-19 mt-0 px-3 pt-4">Total Records</h4>
                        <div class="card-body content-overflow px-0 pb-0 pt-0 mb-3"id="style-4">

                            <ul class="list-group list-group-flush">
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    Employee Counts
                                    <span class="badge badge-primary badge-pill">{{ $employee }}</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    Companies Count
                                    <span class="badge badge-primary badge-pill">{{ $company }}</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    Product Counts
                                    <span class="badge badge-primary badge-pill">{{ $product_model }}</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    Order Counts
                                    <span class="badge badge-primary badge-pill">{{ $order_count }}</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    Job Giving without DC
                                    <span class="badge badge-primary badge-pill">{{ $jobGivingCountWithoutDcId }}</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    Job Giving with DC
                                    <span class="badge badge-primary badge-pill">{{ $jobGivingCountWithDcId }}</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    Job Received
                                    <span class="badge badge-primary badge-pill">{{ $job_received }}</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    Job Reallocation
                                    <span class="badge badge-primary badge-pill">{{ $job_reallocation }}</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    Direct Job Giving
                                    <span class="badge badge-primary badge-pill">{{ $direct_job_giving }}</span>
                                </li>

                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    Direct Job Received
                                    <span class="badge badge-primary badge-pill">{{ $direct_job_received }}</span>
                                </li>

                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-12 col-md-12 col-lg-8 mt-3">
                    <div class="card">
                        <h4 class="fs-19 mt-0 px-3 pt-4">Company Records</h4>
                        <div class="card-body content-overflow mb-3">
                            <table class="table table-bordered table-hover">
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

                                        <td>{{ $master_company_count }}</td>
                                        <td>{{ $employee_count_master }}</td>
                                    </tr>
                                    <tr>
                                        <td>Client Company</td>
                                        <td>{{ $client_company_count }}</td>
                                        <td>{{ $employee_count_client }}</td>
                                    </tr>
                                    <tr>
                                        <td>Sub-client Company</td>
                                        <td>{{ $subclient_company_count }}</td>
                                        <td>{{ $employee_count_subclient }}</td>
                                    </tr>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end row -->

            {{-- chart Starts  --}}
            {{-- <div class="row mt-4">
                <div class="col-xl-6">
                    <div class="card m-b-30">
                        <div class="card-body">
                            <h4 class="m-0 mb-2 header-title">Order Details</h4>
                            <ul class="list-inline widget-chart m-0 text-center">
                                <li class="list-inline-item">
                                    <h5 class="m-0"><b>3654</b></h5>
                                    <p class="text-muted mb-0">Marketplace</p>
                                </li>
                                <li class="list-inline-item">
                                    <h5 class="m-0"><b>954</b></h5>
                                    <p class="text-muted mb-0">Last week</p>
                                </li>
                                <li class="list-inline-item">
                                    <h5 class="m-0"><b>8462</b></h5>
                                    <p class="text-muted mb-0">Last Month</p>
                                </li>
                            </ul>
                            <div>
                                <canvas id="barChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div> <!-- end col -->

                <div class="col-xl-6">
                    <div class="card m-b-30">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <h4 class="mt-0 header-title ">Recent Employees</h4>
                                <p><a href="{{ route('master.employees.index') }}">View more</a></p>
                            </div>

                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th scope="col">ID</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Mobile Number</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($recentEmployees as $employee)
                                        <tr>
                                            <td>{{ $employee->id }}</td>
                                            <td>{{ $employee->employee_name }}</td>
                                            <td>{{ $employee->mobile }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div> <!-- end col -->
            </div> --}}
            {{-- chart Ends  --}}

            {{-- Job Giving Chart  starts --}}
            {{-- <div class="row">
                <div class="col-xl-4">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card m-b-30">
                                <div class="card-body">
                                    <h4 class="mt-0 header-title mb-4">Job Giving</h4>
                                    <div class="d-flex justify-content-center align-items-center">
                                        <canvas id="myChart" style="width:300px !important;height:300px"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> --}}
            {{-- Job Giving Chart  starts --}}

        </div>
        <!-- end container -->
    </div>

    <script src="{{ asset('assets/js/chartjs.js') }}"></script>
    <script>
        var DEFAULT_DATASET_SIZE = 7,
            addedCount = 0,
            color = Chart.helpers.color;

        var months = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];


        var chartColors = {
            red: 'rgb(255, 99, 132)',
            orange: 'rgb(255, 159, 64)',
            yellow: 'rgb(255, 205, 86)',
            green: 'rgb(75, 192, 192)',
            blue: 'rgb(54, 162, 235)',
            purple: 'rgb(153, 102, 255)',
            grey: 'rgb(231,233,237)'
        };

        function randomScalingFactor() {
            return Math.round(Math.random() * 100);
        }

        var barData = {
            labels: months, // Use the 'months' array here
            datasets: [{
                label: 'Dataset 1',
                backgroundColor: color(chartColors.red).alpha(0.5).rgbString(),
                borderColor: chartColors.red,
                borderWidth: 1,
                data: [
                    randomScalingFactor(),
                    randomScalingFactor(),
                    randomScalingFactor(),
                    randomScalingFactor(),
                    randomScalingFactor(),
                    randomScalingFactor(),
                    randomScalingFactor(),
                    randomScalingFactor(),
                    randomScalingFactor(),
                    randomScalingFactor(),
                    randomScalingFactor(),
                    randomScalingFactor()
                ]
            }, {
                label: 'Dataset 2',
                backgroundColor: color(chartColors.blue).alpha(0.5).rgbString(),
                borderColor: chartColors.blue,
                borderWidth: 1,
                data: [
                    randomScalingFactor(),
                    randomScalingFactor(),
                    randomScalingFactor(),
                    randomScalingFactor(),
                    randomScalingFactor(),
                    randomScalingFactor(),
                    randomScalingFactor(),
                    randomScalingFactor(),
                    randomScalingFactor(),
                    randomScalingFactor(),
                    randomScalingFactor(),
                    randomScalingFactor()
                ]
            }]

        };
        var index = 11;
        var ctx = document.getElementById("barChart").getContext("2d");
        var myNewChartB = new Chart(ctx, {
            type: 'bar',
            data: barData,
            options: {
                responsive: true,
                maintainAspectRation: true,
                legend: {
                    position: 'top',
                },
                // title: {
                //     display: true,
                //     text: 'Bar Chart'
                // }
            }
        });
    </script>

    <script>
        var ctx = document.getElementById("myChart").getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: ["M", "T", "W", "T", "F", "S", "S"],
                datasets: [{
                    backgroundColor: [
                        "#2ecc71",
                        "#3498db",
                        "#95a5a6",
                        "#9b59b6",
                        "#f1c40f",
                        "#e74c3c",
                        "#34495e"
                    ],
                    data: [12, 19, 3, 17, 28, 24, 7]
                }]
            }
        });
    </script>

    <script></script>
@endsection
