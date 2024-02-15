<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
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
                            class="nav-link {{ request()->is('user-management/permissions   ') ? 'active' : '' }}"
                            href="{{ route('user-management.permissions') }}">Roles & Permissions</a></li>
                    <!-- More sub-items here -->
                </ul>
            </li>

            <li class="nav-item">
                <a class="nav-link dropdown-toggle {{ request()->is('common*') ? 'active' : '' }}" href="#submenu1"
                    data-toggle="collapse" aria-expanded="true">Common</a>
                <ul class="collapse list-unstyled {{ request()->is('common*') ? 'show' : '' }}" id="submenu1"
                    data-parent="#sidebarMenu">
                    <li class="nav-item"><a class="nav-link {{ request()->is('common/countries') ? 'show' : '' }}"
                            href="{{ route('common.countries') }}">Countries</a></li>
                    <li class="nav-item"><a class="nav-link {{ request()->is('common/states') ? 'active' : '' }}"
                            href="{{ route('common.states') }}">States</a></li>
                    <!-- More sub-items here -->
                </ul>
            </li>
            <!-- Add more items here -->
        </ul>
    </div>
</nav>
