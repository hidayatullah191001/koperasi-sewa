<div class="left-side-menu">
    <div class="h-100" data-simplebar>

        <!-- User box -->
        <div class="user-box text-center">
            @if (Auth::user()->photo_profile == 'default.png')
                <img src="{{ asset('assets/images/default.png') }}" alt="{{ Auth::user()->name }}"
                    class="rounded-circle avatar-md">
            @else
                <img style="object-fit: cover" src="{{ asset('storage/' . Auth::user()->photo_profile) }}" alt="{{ Auth::user()->name }}"
                    class="rounded-circle avatar-md">
            @endif
            <div class="dropdown">
                <a href="javascript: void(0);" class="text-dark dropdown-toggle h5 mt-2 mb-1 d-block"
                    data-bs-toggle="dropdown">{{ Auth::user()->name }}</a>
            </div>
            <p class="text-muted">{{ Auth::user()->role->name }}</p>
        </div>

        <!--- Sidemenu -->
        <div id="sidebar-menu">

            <ul id="side-menu">

                @if (Auth::user()->hasRole('SUADM'))
                    <li class="menu-title">Super Admin</li>

                    <li>
                        <a href="{{ route('superadmin') }}">
                            <i data-feather="airplay"></i>
                            <span> Dashboard </span>
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('superadmin-user-management') }}">
                            <i data-feather="users"></i>
                            <span> User Management </span>
                        </a>
                    </li>
                @endif

                @if (Auth::user()->hasRole('ADM') || Auth::user()->hasRole('SUADM'))
                    <li class="menu-title">Admin</li>

                    @if (Auth::user()->hasRole('ADM'))
                        <li>
                            <a href="{{ route('admin') }}">
                                <i data-feather="airplay"></i>
                                <span> Dashboard </span>
                            </a>
                        </li>
                    @endif

                    <li>
                        <a href="#sidebarMaster" data-bs-toggle="collapse"
                            {{ request()->is('admin/route*') || request()->is('admin/vehicle*') || request()->is('admin/driver*') ? 'aria-expanded="true"' : '' }}
                            class>
                            <i data-feather="codepen"></i>
                            {{-- <span class="badge bg-success rounded-pill float-end">4</span> --}}
                            <span> Master </span>
                        </a>
                        <div class="collapse {{ request()->is('admin/route*') || request()->is('admin/vehicle*') || request()->is('admin/driver*') ? 'show' : '' }}"
                            id="sidebarMaster" style>
                            <ul class="nav-second-level">
                                <li class="{{ request()->is('admin/driver*') ? 'menuitem-active' : '' }}">
                                    <a href="{{ route('driver.index') }}">Driver</a>
                                </li>
                                <li class="{{ request()->is('admin/vehicle*') ? 'menuitem-active' : '' }}">
                                    <a href="{{ route('vehicle.index') }}">Vehicle</a>
                                </li>
                                <li class="{{ request()->is('admin/route*') ? 'menuitem-active' : '' }}">
                                    <a href="{{ route('route.index') }}">Route</a>
                                </li>

                                <li class="{{ request()->is('admin/city*') ? 'menuitem-active' : '' }}">
                                    <a href="{{ route('city.index') }}">City</a>
                                </li>
                            </ul>
                        </div>
                    </li>


                    <li>
                        <a href="#sidebarDashboards" data-bs-toggle="collapse"
                            {{ request()->is('admin/customer*') || request()->is('admin/transaction*') ? 'aria-expanded="true"' : '' }}>
                            <i data-feather="user-check"></i>
                            {{-- <span class="badge bg-success rounded-pill float-end">4</span> --}}
                            <span> Customer </span>
                        </a>
                        <div class="collapse  {{ request()->is('admin/customer*') || request()->is('admin/transaction*') ? 'show' : '' }}"
                            id="sidebarDashboards">
                            <ul class="nav-second-level">
                                <li class="{{ request()->is('admin/customer*') ? 'menuitem-active' : '' }}">
                                    <a href="{{ route('customer.index') }}">Ticket Customer</a>
                                </li>
                                <li class="{{ request()->is('admin/transaction*') ? 'menuitem-active' : '' }}">
                                    <a href="{{ route('transaction.index') }}">Transaction</a>
                                </li>
                            </ul>
                        </div>
                    </li>

                @endif


                <li class="menu-title">Settings</li>

                <li>
                    <a href="{{ route('setting-profile') }}">
                        <i data-feather="user"></i>
                        <span> My Profile </span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('setting-password') }}">
                        <i data-feather="key"></i>
                        <span> Change Password  </span>
                    </a>
                </li>

            </ul>

        </div>
        <!-- End Sidebar -->

        <div class="clearfix"></div>

    </div>
    <!-- Sidebar -left -->

</div>
