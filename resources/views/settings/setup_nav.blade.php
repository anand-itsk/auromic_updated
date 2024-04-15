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

                             <li class="nav-item"><a
                            class="nav-link {{ request()->is('user-management/permission_group') ? 'active' : '' }}"
                            href="{{ route('user-management.permission_group') }}">Permission Group</a></li>

                            <li class="nav-item"><a
                            class="nav-link {{ request()->is('user-management/permission_control') ? 'active' : '' }}"
                            href="{{ route('user-management.permission_control') }}">Permission Control</a></li>
                    <!-- More sub-items here -->
                </ul>
            </li>

            <li class="nav-item">
                <a class="nav-link dropdown-toggle {{ request()->is('common*') ? 'active ' : '' }}" href="#submenu2"
                    data-toggle="collapse" aria-expanded="true">Common</a>
                <ul class="collapse list-unstyled {{ request()->is('common*') ? 'show' : '' }}" id="submenu2"
                    data-parent="#sidebarMenu">
                    <li class="nav-item"><a class="nav-link {{ request()->is('common/country*') ? 'show' : '' }}"
                            href="{{ route('common.countries') }}">Countries</a></li>
                    <li class="nav-item"><a class="nav-link {{ request()->is('common/state*') ? 'show' : '' }}"
                            href="{{ route('common.states') }}">States</a></li>
                    <li class="nav-item"><a class="nav-link {{ request()->is('common/district*') ? 'show' : '' }}"
                            href="{{ route('common.districts') }}">Districts</a></li>
                    <li class="nav-item"><a class="nav-link {{ request()->is('common/religion*') ? 'show' : '' }}"
                            href="{{ route('common.religions') }}">Religion</a></li>
                    <li class="nav-item"><a class="nav-link {{ request()->is('common/caste*') ? 'show' : '' }}"
                            href="{{ route('common.castes') }}">Caste</a></li>
                    <li class="nav-item"><a class="nav-link {{ request()->is('common/nationality*') ? 'show' : '' }}"
                            href="{{ route('common.nationalities') }}">Nationality</a></li>
                    <!-- More sub-items here -->
                </ul>
            </li>

            <li class="nav-item">
                <a class="nav-link dropdown-toggle {{ request()->is('specified*') ? 'active' : '' }}" href="#submenu3"
                    data-toggle="collapse" aria-expanded="true">Specified</a>
                <ul class="collapse list-unstyled {{ request()->is('specified*') ? 'show' : '' }}" id="submenu3"
                    data-parent="#sidebarMenu">
                    <li class="nav-item"><a
                            class="nav-link {{ request()->is('specified/company_type*') ? 'show' : '' }}"
                            href="{{ route('specified.company_types') }}">Company Types</a></li>
                    <li class="nav-item"><a
                            class="nav-link {{ request()->is('specified/resigning_reason*') ? 'show' : '' }}"
                            href="{{ route('specified.resigning_reasons') }}">Resigning Reasons</a></li>
                    <li class="nav-item"><a
                            class="nav-link {{ request()->is('specified/local_office*') ? 'show' : '' }}"
                            href="{{ route('specified.local_offices') }}">Local offices</a></li>
                    <li class="nav-item"><a
                            class="nav-link {{ request()->is('specified/esi_dispensary*') ? 'show' : '' }}"
                            href="{{ route('specified.esi_dispensaries') }}">ESI Dispensary</a></li>
                    <!-- More sub-items here -->
                </ul>
            </li>
            <!-- Add more items here -->
            <li class="nav-item">
                <a class="nav-link dropdown-toggle {{ request()->is('product-models*') ? 'active' : '' }}"
                    href="#submenu4" data-toggle="collapse" aria-expanded="true">Products/Models</a>
                <ul class="collapse list-unstyled {{ request()->is('product-models*') ? 'show' : '' }}" id="submenu4"
                    data-parent="#sidebarMenu">
                    <li class="nav-item"><a
                            class="nav-link {{ request()->is('product-models/raw_material_type*') ? 'show' : '' }}"
                            href="{{ route('product-models.raw_material_types') }}">Raw Material Type</a></li>
                    <li class="nav-item"><a
                            class="nav-link {{ request()->is('product-models/raw_materials*') ? 'show' : '' }}"
                            href="{{ route('product-models.raw_materials') }}">Raw Material</a></li>
                    <li class="nav-item"><a
                            class="nav-link {{ request()->is('product-models/products*') ? 'show' : '' }}"
                            href="{{ route('product-models.products') }}">Product</a></li>
                    <li class="nav-item"><a
                            class="nav-link {{ request()->is('product-models/product_size*') ? 'show' : '' }}"
                            href="{{ route('product-models.product_sizes') }}">Product Size</a></li>
                    <li class="nav-item"><a
                            class="nav-link {{ request()->is('product-models/product_color*') ? 'show' : '' }}"
                            href="{{ route('product-models.product_colors') }}">Product Color</a></li>
                    <li class="nav-item"><a
                            class="nav-link {{ request()->is('product-models/order_status*') ? 'show' : '' }}"
                            href="{{ route('product-models.order_statuses') }}">Order Status</a></li>
                    <!-- More sub-items here -->
                </ul>
            </li>
        </ul>
    </div>
</nav>
