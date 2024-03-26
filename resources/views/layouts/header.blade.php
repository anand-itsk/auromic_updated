<header id="topnav">
    <div class="topbar-main">
        <div class="container-fluid">

            <!-- Logo container-->
            <div class="logo">
                <!-- Image Logo -->
                <a href="{{ route('home') }}" class="logo">
                    <img src="{{ asset('assets/images/logo-sm.png') }}" alt="" height="32" class="logo-small">
                    <img src="{{ asset('assets/images/logo.png') }}" alt="" height="20" class="logo-large">
                </a>

            </div>
            <!-- End Logo container-->


            <div class="menu-extras topbar-custom">


                <ul class="list-inline float-right mb-0">
                    <!-- Search -->
                    {{-- <li class="list-inline-item dropdown notification-list d-none d-sm-inline-block">
                        <form role="search" class="app-search">
                            <div class="form-group mb-0">
                                <input type="text" class="form-control" placeholder="Search..">
                                <button type="submit"><i class="fa fa-search"></i></button>
                            </div>
                        </form>
                    </li> --}}
                    <!-- Messages-->
                    {{-- <li class="list-inline-item dropdown notification-list">
                        <a class="nav-link dropdown-toggle arrow-none waves-effect" data-toggle="dropdown"
                            href="#" role="button" aria-haspopup="false" aria-expanded="false">
                            <i class="mdi mdi-email-outline noti-icon"></i>
                            <span class="badge badge-danger badge-pill noti-icon-badge">5</span>
                        </a>

                        <div
                            class="dropdown-menu dropdown-menu-right dropdown-arrow dropdown-menu-animated dropdown-menu-lg">
                            <!-- item-->
                            <div class="dropdown-item noti-title">
                                <span class="badge badge-danger float-right">367</span>
                                <h5>Messages</h5>
                            </div>

                            <div class="slimscroll" style="max-height: 230px;">
                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item notify-item">
                                    <div class="notify-icon"><img src="assets/images/users/user-2.jpg" alt="user-img"
                                            class="img-fluid rounded-circle" /> </div>
                                    <p class="notify-details"><b>Charles M. Jones</b><span class="text-muted">Dummy text
                                            of the printing and typesetting industry.</span></p>
                                </a>

                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item notify-item">
                                    <div class="notify-icon"><img src="assets/images/users/user-3.jpg" alt="user-img"
                                            class="img-fluid rounded-circle" /> </div>
                                    <p class="notify-details"><b>Thomas J. Mimms</b><span class="text-muted">You have 87
                                            unread messages</span></p>
                                </a>

                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item notify-item">
                                    <div class="notify-icon"><img src="assets/images/users/user-4.jpg" alt="user-img"
                                            class="img-fluid rounded-circle" /> </div>
                                    <p class="notify-details">Luis M. Konrad<span class="text-muted">It is a long
                                            established fact that a reader will</span></p>
                                </a>

                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item notify-item">
                                    <div class="notify-icon"><img src="assets/images/users/user-5.jpg" alt="user-img"
                                            class="img-fluid rounded-circle" /> </div>
                                    <p class="notify-details"><b>Kendall E. Walker</b><span class="text-muted">Dummy
                                            text of the printing and typesetting industry.</span></p>
                                </a>

                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item notify-item">
                                    <div class="notify-icon"><img src="assets/images/users/user-6.jpg" alt="user-img"
                                            class="img-fluid rounded-circle" /> </div>
                                    <p class="notify-details"><b>David M. Ryan</b><span class="text-muted">You have 87
                                            unread messages</span></p>
                                </a>
                            </div>

                            <!-- All-->
                            <a href="javascript:void(0);" class="dropdown-item notify-all">
                                View All
                            </a>

                        </div>
                    </li> --}}
                    <!-- notification-->
                    {{-- <li class="list-inline-item dropdown notification-list">
                        <a class="nav-link dropdown-toggle arrow-none waves-effect" data-toggle="dropdown"
                            href="#" role="button" aria-haspopup="false" aria-expanded="false">
                            <i class="mdi mdi-bell-outline noti-icon"></i>
                            <span class="badge badge-success badge-pill noti-icon-badge">3</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-animated dropdown-menu-lg">
                            <!-- item-->
                            <div class="dropdown-item noti-title">
                                <span class="badge badge-danger float-right">84</span>
                                <h5>Notification</h5>
                            </div>

                            <div class="slimscroll" style="max-height: 230px;">

                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item notify-item">
                                    <div class="notify-icon bg-primary"><i class="mdi mdi-cart-outline"></i></div>
                                    <p class="notify-details">Your order is placed<span class="text-muted">Dummy text
                                            of the printing and typesetting industry.</span></p>
                                </a>

                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item notify-item">
                                    <div class="notify-icon bg-success"><i class="mdi mdi-message"></i></div>
                                    <p class="notify-details">New Message received<span class="text-muted">You have 87
                                            unread messages</span></p>
                                </a>

                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item notify-item">
                                    <div class="notify-icon bg-warning"><i class="mdi mdi-martini"></i></div>
                                    <p class="notify-details">Your item is shipped<span class="text-muted">It is a
                                            long established fact that a reader will</span></p>
                                </a>
                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item notify-item">
                                    <div class="notify-icon bg-danger"><i class="mdi mdi-message"></i></div>
                                    <p class="notify-details">New Message received<span class="text-muted">You have 87
                                            unread messages</span></p>
                                </a>

                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item notify-item">
                                    <div class="notify-icon bg-info"><i class="mdi mdi-martini"></i></div>
                                    <p class="notify-details">Your item is shipped<span class="text-muted">It is a
                                            long established fact that a reader will</span></p>
                                </a>
                            </div>

                            <!-- All-->
                            <a href="javascript:void(0);" class="dropdown-item notify-all">
                                View All
                            </a>

                        </div>

                    </li> --}}
                    <!-- User-->
                    <li class="list-inline-item text-white">
                        <div>
                            @guest
                                <p class="text-capitalize">Welcome, Guest</p>
                            @else
                                <p class="text-capitalize">Welcome, {{ Auth::user()->name }}</p>
                            @endguest
                        </div>
                    </li>
                    <li class="list-inline-item dropdown notification-list">
                        <a class="nav-link dropdown-toggle arrow-none waves-effect nav-user" data-toggle="dropdown"
                            href="#" role="button" aria-haspopup="false" aria-expanded="false">
                            <!-- <img src="{{ asset('assets/images/users/user-1.jpg') }}" alt="user"
                                class="rounded-circle"> -->

                                 @if (!empty($user->profile_image))
                                        <img src="{{ asset('/storage/' . $user->profile_image) }}"   class="rounded-circle" alt="Profile Image" style="width: 50px; height: 50px;">
                                        @else
                                        <img class="profile-image rounded-circle" src="{{ asset('assets/images/no-profile.png') }}"  class="rounded-circle"  alt="No Profile Image">
                                        @endif
                        </a>
                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-animated profile-dropdown ">
                            <a class="dropdown-item" href="{{ route('my-profile') }}"><i
                                    class="mdi mdi-account-circle m-r-5 text-muted"></i> Profile</a>
                            <a class="dropdown-item" href="{{ route('master.settings') }}"><i
                                    class="mdi mdi-settings m-r-5 text-muted"></i> Settings</a>
                            <a class="dropdown-item" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                <i class="mdi mdi-logout m-r-5 text-muted"></i>
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>

                    </li>
                    <li class="menu-item list-inline-item">
                        <!-- Mobile menu toggle-->
                        <a class="navbar-toggle nav-link">
                            <div class="lines">
                                <span></span>
                                <span></span>
                                <span></span>
                            </div>
                        </a>
                        <!-- End mobile menu toggle-->
                    </li>

                </ul>
            </div>
            <!-- end menu-extras -->

            <div class="clearfix"></div>

        </div> <!-- end container -->
    </div>
    <!-- end topbar-main -->

    <!-- MENU Start -->
    <div class="navbar-custom">
        <div class="container-fluid">
            <div id="navigation">
                <!-- Navigation Menu-->
                <ul class="navigation-menu">

                    <li class="has-submenu">
                        <a href="{{ route('home') }}"><i class="dripicons-meter"></i>Dashboard</a>
                    </li>

                    <li class="has-submenu">
                        <a href="#"><i class="dripicons-view-thumb"></i>Profile</a>
                        <ul class="submenu">
                            <li>
                                <a href="{{ route('profile.masters.index') }}">Master Company</a>
                            </li>
                            <li>
                                <a href="{{ route('profile.clients.index') }}">Client Company</a>
                            </li>
                            <li>
                                <a href="{{ route('profile.sub_clients.index') }}">Sub-client Company</a>
                            </li>
                            <li>
                                <a href="{{ route('profile.bank_details.index') }}">Bank Details</a>
                            </li>



                        </ul>
                    </li>

                    {{-- Master --}}
                    <li class="has-submenu">
                        <a href="#"><i class="dripicons-briefcase"></i>Master</a>
                        <ul class="submenu">
                            <li>
                                <a href="{{ route('master.customers.index') }}">Customers</a>
                            </li>
                            <li>
                                <a href="{{ route('master.employees.index') }}">Employees</a>
                            </li>
                            <li>
                                <a href="{{ route('master.product_model.index') }}">Product Model</a>
                            </li>
                            <li>
                                <a href="{{ route('master.order_detail.index') }}">Order Details</a>
                            </li>
                            <li>
                                <a href="{{ route('master.incentives.index') }}">Incentive</a>
                            </li>
                            <li>
                                <a href="{{ route('master.finishing_product.index') }}">Finishing Product</a>
                            </li>


                        </ul>
                    </li>

                    {{-- Job Allocation --}}
                    <li class="has-submenu">
                        <a href="#"><i class="dripicons-briefcase"></i>Job Allocation</a>
                        <ul class="submenu">
                            <li>
                                <a href="{{ route('job_allocation.delivery_challan.index') }}">Delivery Challan</a>
                            </li>
                            <li>
                                <a href="{{ route('job_allocation.job_giving.index') }}">Job Giving</a>
                            </li>
                            <li>
                                <a href="{{ route('job_allocation.job_received.index') }}">Job Received</a>
                            </li>
                            <li>
                                <a href="{{ route('job_allocation.job_reallocation.index') }}">Job Reallocation</a>
                            </li>
                            <li>
                                <a href="{{ route('job_allocation.direct_job_giving.index') }}">Direct Job Giving</a>
                            </li>

                            <li>
                                <a href="{{ route('job_allocation.direct_job_received.index') }}">Direct Job
                                    Received</a>
                            </li>



                        </ul>
                    </li>
                    {{--Report--}}
                     <li class="has-submenu">
                        <a href="#"><i class="dripicons-briefcase"></i>Report</a>
                        <ul class="submenu">
                            <li>
                                <a href="{{ route('report.daily_given_report_cw.index') }}">Daily given Report (CW)</a>
                            </li>
                        
                        </ul>
                    </li>
                </ul>
                <!-- End navigation menu -->
            </div> <!-- end #navigation -->
        </div> <!-- end container -->
    </div> <!-- end navbar-custom -->
</header>
