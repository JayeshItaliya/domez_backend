<header>
    <div class="right-side-wrapper">
        <div class="logo">
            <a href="#">
                <img src="{{ Helper::image_path('preloader.gif') }}" height="50" alt="">
                <img src="{{ Helper::image_path('logo_dark.png') }}" width="80" alt="">
            </a>
        </div>
        <div class="toggle-icon-wrapper">
            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-menu-2" width="20px"
                height="20px" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none"
                stroke-linecap="round" stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                <line x1="4" y1="6" x2="20" y2="6"></line>
                <line x1="4" y1="12" x2="20" y2="12"></line>
                <line x1="4" y1="18" x2="20" y2="18"></line>
            </svg>
        </div>
    </div>
    <div class="d-flex justify-content-between" style="width: inherit;">
        <div class="search-box">
            <form data-bs-toggle="search" data-bs-display="static" aria-expanded="true">
                <div class="search-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-search" width="20px"
                        height="20px" viewBox="0 0 24 24" stroke-width="1.5" stroke="var(--bs-secondary)"
                        fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                        <circle cx="10" cy="10" r="7"></circle>
                        <line x1="21" y1="21" x2="15" y2="15"></line>
                    </svg>
                </div>
                <input type="search" name="search" id="" class="form-control form-control-lg"
                    placeholder="Search Here...">
            </form>
        </div>
        <ul class="nav-icons">
            {{-- Only use for development purpose --}}
            @if (in_array(Auth::user()->typ, [1, 2]))
                <li class="dropdown">
                    <a href="{{ URL::to('admin/login-dev') }}"
                        class="btn btn-primary">{{ Auth::user()->type == 1 ? 'Login as Dome Owner' : 'Login as Admin' }}</a>
                </li>
            @endif
            @if (Auth::user()->type == 2)
                <li class="dropdown ms-3">
                    <a href="{{ URL::to('admin/login-emp') }}" class="btn btn-primary">Login as Employee</a>
                </li>
            @endif
            {{-- Only use for development purpose --}}
            <li class="dropdown">
                <a href="#" class="nav-item currency-icon" role="button" data-bs-toggle="dropdown"
                    aria-expanded="false">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-currency-dollar"
                        width="20" height="20" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="var(--bs-secondary)" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M16.7 8a3 3 0 0 0 -2.7 -2h-4a3 3 0 0 0 0 6h4a3 3 0 0 1 0 6h-4a3 3 0 0 1 -2.7 -2" />
                        <path d="M12 3v3m0 12v3" />
                    </svg>
                </a>
                <ul class="dropdown-menu box-shadow border-0 my-3">
                    <li><a class="dropdown-item" href="#">USD - <small>(US Dollar)</small></a></li>
                    <li><a class="dropdown-item" href="#">CAD - <small>(Canadian Dollar)</small></a></li>
                </ul>
            </li>
            <li class="dropdown">
                <a href="#" class="nav-item language-icon" role="button" data-bs-toggle="dropdown"
                    aria-expanded="false">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-language"
                        width="20" height="20" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="var(--bs-primary)" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M4 5h7" />
                        <path d="M9 3v2c0 4.418 -2.239 8 -5 8" />
                        <path d="M5 9c-.003 2.144 2.952 3.908 6.7 4" />
                        <path d="M12 20l4 -9l4 9" />
                        <path d="M19.1 18h-6.2" />
                    </svg>
                </a>
                <ul class="dropdown-menu box-shadow border-0 my-3">
                    <li><a class="dropdown-item" href="#">English <small>(US)</small></a></li>
                    <li><a class="dropdown-item" href="#">français <small>(French)</small></a></li>
                </ul>
            </li>
            <li class="dropdown">
                <a href="#" class="nav-item notification-icon" role="button" data-bs-toggle="dropdown"
                    aria-expanded="false">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-bell" width="20"
                        height="20" viewBox="0 0 24 24" stroke-width="1.5" stroke="var(--bs-secondary)"
                        fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path
                            d="M10 5a2 2 0 0 1 4 0a7 7 0 0 1 4 6v3a4 4 0 0 0 2 3h-16a4 4 0 0 0 2 -3v-3a7 7 0 0 1 4 -6" />
                        <path d="M9 17v1a3 3 0 0 0 6 0v-1" />
                    </svg>
                </a>
                <ul class="dropdown-menu box-shadow border-0 my-3">
                    <li class="dropdown-item">
                        <div class="d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center pe-5">
                                <h6 class="me-3 fs-7">All Notification</h6>
                                <span class="badge text-bg-warning text-white">01</span>
                            </div>
                            <a href="#" class="text-primary text-decoration-underline fs-7 ps-5">Mark as all
                                read</a>
                        </div>
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li class="dropwdown-item notifications">
                        <div class="notification-avatar">
                            <img src="{{ Helper::image_path('default.png') }}" alt="" width="40"
                                height="40" class="me-3">
                            <div class="notification-header">
                                <p class="fs-7">John Doe</p>
                                <span class="fs-7 text-muted">2 min ago</span>
                            </div>
                        </div>
                        <div class="notification-body">
                        </div>
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                </ul>
            </li>
            <li class="dropdown">
                <a href="#" class="nav-item profile-icon py-2" role="button" data-bs-toggle="dropdown"
                    aria-expanded="false">
                    <img src="{{ Helper::image_path(Auth::user()->image) }}">
                </a>
                <ul class="dropdown-menu box-shadow border-0 my-3">
                    <li class="white-space-nowrap px-3">
                        <p><strong>Good Morning,</strong> {{ Auth::user()->name }}</p>
                        <small class="text-muted">{{ Auth::user()->type == 1 ? 'Admin' : 'Dome Owner' }}</small>
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li class="dropdown-item">
                        <a class="d-flex align-items-center px-0" href="#">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-settings me-2"
                                width="20" height="20" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="#2c3e50" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path
                                    d="M10.325 4.317c.426 -1.756 2.924 -1.756 3.35 0a1.724 1.724 0 0 0 2.573 1.066c1.543 -.94 3.31 .826 2.37 2.37a1.724 1.724 0 0 0 1.065 2.572c1.756 .426 1.756 2.924 0 3.35a1.724 1.724 0 0 0 -1.066 2.573c.94 1.543 -.826 3.31 -2.37 2.37a1.724 1.724 0 0 0 -2.572 1.065c-.426 1.756 -2.924 1.756 -3.35 0a1.724 1.724 0 0 0 -2.573 -1.066c-1.543 .94 -3.31 -.826 -2.37 -2.37a1.724 1.724 0 0 0 -1.065 -2.572c-1.756 -.426 -1.756 -2.924 0 -3.35a1.724 1.724 0 0 0 1.066 -2.573c-.94 -1.543 .826 -3.31 2.37 -2.37c1 .608 2.296 .07 2.572 -1.065z" />
                                <circle cx="12" cy="12" r="3" />
                            </svg>
                            <p class="text-dark">Account Settings</p>
                        </a>
                    </li>
                    <li class="dropdown-item">
                        <a class="d-flex align-items-center px-0" onclick="logout('{{ URL::to('logout') }}')">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-logout me-2"
                                width="20" height="20" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="#2c3e50" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path
                                    d="M14 8v-2a2 2 0 0 0 -2 -2h-7a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h7a2 2 0 0 0 2 -2v-2" />
                                <path d="M7 12h14l-3 -3m0 6l3 -3" />
                            </svg>
                            <p class="text-dark">Sign Out</p>
                        </a>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
    {{-- <div class="header-wrapper">
    </div> --}}
</header>
