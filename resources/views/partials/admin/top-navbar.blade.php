<nav class="navbar navbar-expand navbar-light navbar-bg">
    <a class="sidebar-toggle js-sidebar-toggle">
        <i class="hamburger align-self-center"></i>
    </a>

    <div class="navbar-collapse collapse">
        <ul class="navbar-nav navbar-align">

            <li class="nav-item dropdown">
                <a class="nav-icon dropdown-toggle d-inline-block d-sm-none" href="#" data-bs-toggle="dropdown">
                    <i class="align-middle" data-feather="settings"></i>
                </a>

                <a class="nav-link dropdown-toggle d-none d-sm-inline-block" href="#" data-bs-toggle="dropdown">
                    <img src="{{ asset('template/img/avatars/avatar.jpg') }}" class="avatar img-fluid rounded me-1"
                        alt="Charles Hall" />
                    <span class="text-dark">{{ Auth::user()->name }}</span>
                </a>
                <div class="dropdown-menu dropdown-menu-end">
                    <a class="dropdown-item" href="pages-profile.html"><i class="align-middle me-1"
                            data-feather="user"></i>
                        Profile</a>
                    <div class="dropdown-divider"></div>
                    <button type="button" class="dropdown-item" data-bs-toggle="modal"
                        data-bs-target="#logoutModal">
                        Logout
                    </button>
                </div>
            </li>
        </ul>
    </div>
</nav>
