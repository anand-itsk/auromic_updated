<style>
    a.nav-link.dropdown-toggle.active {
        background: #007bffad;
        border-radius: 5px 5px 0px 0px;
        color: #fff;
    }

    .list-unstyled.collapse.show {
        background: #007bff1c !important;
        border-radius: 0px 0px 5px 5px;
    }

    a.nav-link.show {
        color: #fff;
        background: #007bff75;
    }
</style>
<nav id="sidebarMenu" class="">
    <div class="sidebar-sticky pt-3">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link dropdown-toggle {{ request()->is('user-management*') ? 'active' : '' }}"
                    href="#submenu1" data-toggle="collapse" aria-expanded="true">User Management</a>
                <ul class="collapse list-unstyled {{ request()->is('user-management*') ? 'show' : '' }}" id="submenu1"
                    data-parent="#sidebarMenu">
                    <li class="nav-item"><a class="nav-link {{ request()->is('user-management/users') ? 'show' : '' }}"
                            href="{{ route('user-management.users') }}">Users</a></li>
                    <li class="nav-item"><a
                            class="nav-link {{ request()->is('user-management/permissions') ? 'active' : '' }}"
                            href="{{ route('user-management.permissions') }}">Roles & Permissions</a></li>
                    <!-- More sub-items here -->
                </ul>
            </li>

            <li class="nav-item">
                <a class="nav-link dropdown-toggle {{ request()->is('common*') ? 'active' : '' }}" href="#submenu2"
                    data-toggle="collapse" aria-expanded="true">Common</a>
                <ul class="collapse list-unstyled {{ request()->is('common*') ? 'show' : '' }}" id="submenu2"
                    data-parent="#sidebarMenu">
                    <li class="nav-item"><a class="nav-link {{ request()->is('common/country') ? 'show' : '' }}"
                            href="{{ route('common.countries') }}">Countries</a></li>
                    <li class="nav-item"><a class="nav-link {{ request()->is('common/states') ? 'active' : '' }}"
                            href="{{ route('common.states') }}">States</a></li>
                    <!-- More sub-items here -->
                </ul>
            </li>

            <li class="nav-item">
                <a class="nav-link dropdown-toggle {{ request()->is('specified*') ? 'active' : '' }}" href="#submenu3"
                    data-toggle="collapse" aria-expanded="true">Specified</a>
                <ul class="collapse list-unstyled {{ request()->is('specified*') ? 'show' : '' }}" id="submenu3"
                    data-parent="#sidebarMenu">
                    <li class="nav-item"><a
                            class="nav-link {{ request()->is('specified/company_types') ? 'show' : '' }}"
                            href="{{ route('specified.company_types') }}">Company Types</a></li>
                    <li class="nav-item"><a
                            class="nav-link {{ request()->is('specified/resigning_reasons') ? 'active' : '' }}"
                            href="{{ route('specified.resigning_reasons') }}">Resigning</a></li>
                    <!-- More sub-items here -->
                </ul>
            </li>
            <!-- Add more items here -->
        </ul>
    </div>
</nav>
